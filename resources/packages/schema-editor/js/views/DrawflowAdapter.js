import Drawflow from 'drawflow';
import 'drawflow/dist/drawflow.min.css';
import { EventEmitter } from '../utils/EventEmitter.js';

/**
 * DrawflowAdapter - Adapter for the Drawflow library
 * Handles only Drawflow-specific operations, no business logic
 * 
 * Events emitted:
 * - nodeSelected: when a node is selected, payload: { drawflowId, nodeId }
 * - nodeUnselected: when a node is unselected
 * - nodeRemoved: when a node is removed, payload: { nodeId }
 */
export class DrawflowAdapter extends EventEmitter {
    /**
     * @param {string} containerId - ID of the Drawflow container element
     */
    constructor(containerId) {
        super();
        this._containerId = containerId;
        this._editor = null;
        this._container = null;
        this._nodeIdMap = new Map(); // Maps drawflowId -> nodeId
    }

    /**
     * Initialize the Drawflow editor
     * @returns {boolean} True if initialized successfully
     */
    initialize() {
        this._container = document.getElementById(this._containerId);
        if (!this._container) {
            console.error('Drawflow container not found');
            return false;
        }

        this._editor = new Drawflow(this._container);
        this._editor.reroute = true;
        this._editor.reroute_fix_curvature = true;
        this._editor.curvature = 0.5;
        this._editor.start();

        this._setupDrawflowListeners();

        console.log('Drawflow adapter initialized');
        return true;
    }

    /**
     * Setup internal Drawflow event listeners
     */
    _setupDrawflowListeners() {
        this._editor.on('nodeSelected', (drawflowId) => {
            const nodeData = this._editor.getNodeFromId(drawflowId);
            if (nodeData && nodeData.name) {
                const match = nodeData.name.match(/model_(\d+)/);
                if (match) {
                    const nodeId = parseInt(match[1], 10);
                    this.emit('nodeSelected', { drawflowId, nodeId });
                }
            }
        });

        this._editor.on('nodeUnselected', () => {
            this.emit('nodeUnselected');
        });

        this._editor.on('nodeRemoved', (drawflowId) => {
            // Get nodeId from our map before it's removed
            const nodeId = this._nodeIdMap.get(String(drawflowId));
            this._nodeIdMap.delete(String(drawflowId));
            if (nodeId !== undefined) {
                this.emit('nodeRemoved', { drawflowId, nodeId });
            }
        });

        // Listen for connection created events
        this._editor.on('connectionCreated', (connection) => {
            const outputNodeId = this.getNodeIdFromDrawflowId(connection.output_id);
            const inputNodeId = this.getNodeIdFromDrawflowId(connection.input_id);
            
            if (outputNodeId !== null && inputNodeId !== null) {
                this.emit('connectionCreated', {
                    sourceNodeId: outputNodeId,
                    targetNodeId: inputNodeId,
                    connectionId: this._generateConnectionId(connection)
                });
            }
        });

        // Listen for connection removed events
        this._editor.on('connectionRemoved', (connection) => {
            const outputNodeId = this.getNodeIdFromDrawflowId(connection.output_id);
            const inputNodeId = this.getNodeIdFromDrawflowId(connection.input_id);
            
            if (outputNodeId !== null && inputNodeId !== null) {
                this.emit('connectionRemoved', {
                    sourceNodeId: outputNodeId,
                    targetNodeId: inputNodeId,
                    connectionId: this._generateConnectionId(connection)
                });
            }
        });
    }

    /**
     * Generate a unique connection ID from a Drawflow connection object
     * @param {Object} connection - Drawflow connection object
     * @returns {string} Unique connection ID
     */
    _generateConnectionId(connection) {
        return JSON.stringify({
            outputId: connection.output_id,
            outputClass: connection.output_class,
            inputId: connection.input_id,
            inputClass: connection.input_class
        });
    }

    /**
     * Create a new node in Drawflow
     * @param {number} nodeId - Our internal node ID
     * @param {string} html - HTML content for the node
     * @param {number} posX - X position
     * @param {number} posY - Y position
     * @returns {number} Drawflow node ID
     */
    createNode(nodeId, html, posX, posY) {
        const drawflowId = this._editor.addNode(
            `model_${nodeId}`,
            1, // inputs
            1, // outputs
            posX,
            posY,
            'model-node',
            {},
            html
        );
        // Track the mapping for later removal handling
        this._nodeIdMap.set(String(drawflowId), nodeId);
        return drawflowId;
    }

    /**
     * Calculate position for a new node
     * @param {number} modelCount - Current number of models
     * @returns {Object} Position with x and y properties
     */
    calculateNodePosition(modelCount) {
        return {
            x: 50 + (modelCount - 1) * 250,
            y: 50 + Math.floor((modelCount - 1) / 3) * 200
        };
    }

    /**
     * Update the visual content of a node
     * @param {number} nodeId - Our internal node ID
     * @param {string} html - New HTML content
     */
    updateNodeContent(nodeId, html) {
        const drawflowId = this._findDrawflowIdByNodeId(nodeId);
        if (drawflowId) {
            const nodeElement = document.querySelector(`#node-${drawflowId} .drawflow_content_node`);
            if (nodeElement) {
                nodeElement.innerHTML = html;
            }
        }
    }

    /**
     * Remove a node from Drawflow
     * @param {number} nodeId - Our internal node ID
     */
    removeNode(nodeId) {
        const drawflowId = this._findDrawflowIdByNodeId(nodeId);
        if (drawflowId) {
            this._editor.removeNodeId(`node-${drawflowId}`);
        }
    }

    /**
     * Find Drawflow node ID by our internal node ID
     * @param {number} nodeId - Our internal node ID
     * @returns {string|null} Drawflow node ID or null
     */
    _findDrawflowIdByNodeId(nodeId) {
        const drawflowData = this._editor.export();
        for (const [id, node] of Object.entries(drawflowData.drawflow.Home.data)) {
            if (node.name === `model_${nodeId}`) {
                return id;
            }
        }
        return null;
    }

    /**
     * Get node ID from Drawflow node name
     * @param {number} drawflowId - Drawflow node ID
     * @returns {number|null} Our internal node ID or null
     */
    getNodeIdFromDrawflowId(drawflowId) {
        const nodeData = this._editor.getNodeFromId(drawflowId);
        if (nodeData && nodeData.name) {
            const match = nodeData.name.match(/model_(\d+)/);
            if (match) {
                return parseInt(match[1], 10);
            }
        }
        return null;
    }

    /**
     * Remove connection between two nodes by our internal node IDs
     * @param {number} sourceNodeId - Source node ID
     * @param {number} targetNodeId - Target node ID
     */
    removeConnectionBetweenNodes(sourceNodeId, targetNodeId) {
        const sourceDrawflowId = this._findDrawflowIdByNodeId(sourceNodeId);
        const targetDrawflowId = this._findDrawflowIdByNodeId(targetNodeId);
        
        if (!sourceDrawflowId || !targetDrawflowId) {
            return;
        }

        // Get the connections from the source node
        const drawflowData = this._editor.export();
        const sourceNode = drawflowData.drawflow.Home.data[sourceDrawflowId];
        
        if (sourceNode && sourceNode.outputs) {
            for (const [outputKey, output] of Object.entries(sourceNode.outputs)) {
                if (output.connections) {
                    for (const conn of output.connections) {
                        if (conn.node === targetDrawflowId) {
                            // Remove this connection
                            this._editor.removeSingleConnection(
                                sourceDrawflowId,
                                targetDrawflowId,
                                outputKey,
                                conn.output
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * Export Drawflow data
     * @returns {Object} Drawflow export data
     */
    export() {
        return this._editor.export();
    }
}
