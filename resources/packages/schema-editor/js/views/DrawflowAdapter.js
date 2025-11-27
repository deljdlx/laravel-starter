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
 * - connectionClicked: when a connection is clicked, payload: { sourceNodeId, targetNodeId }
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
        this._setupConnectionClickListener();

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
     * Setup click event listeners on connection paths (SVG)
     * Allows users to click on existing connections to edit them
     */
    _setupConnectionClickListener() {
        // Use event delegation on the container to handle clicks on connection paths
        this._container.addEventListener('click', (event) => {
            const target = event.target;
            
            // Check if the clicked element is a connection path (SVG path element)
            if (target.classList.contains('main-path')) {
                // Get the parent connection element
                const connectionElement = target.closest('.connection');
                if (connectionElement) {
                    const connectionInfo = this._parseConnectionElement(connectionElement);
                    if (connectionInfo) {
                        const sourceNodeId = this.getNodeIdFromDrawflowId(connectionInfo.outputNodeId);
                        const targetNodeId = this.getNodeIdFromDrawflowId(connectionInfo.inputNodeId);
                        
                        if (sourceNodeId !== null && targetNodeId !== null) {
                            this.emit('connectionClicked', {
                                sourceNodeId,
                                targetNodeId
                            });
                        }
                    }
                }
            }
        });
    }

    /**
     * Parse connection element to extract source and target node IDs
     * @param {Element} connectionElement - The connection DOM element
     * @returns {Object|null} Object with outputNodeId and inputNodeId or null
     */
    _parseConnectionElement(connectionElement) {
        // Drawflow connection elements have classes like:
        // "connection node_in_node-2 node_out_node-1 output_1 input_1"
        // SVG elements use className.baseVal (SVGAnimatedString), while regular
        // HTML elements use className (string). We check baseVal first for SVG.
        const classList = connectionElement.className.baseVal || connectionElement.className;
        
        // Extract node IDs from class names
        const nodeInMatch = classList.match(/node_in_node-(\d+)/);
        const nodeOutMatch = classList.match(/node_out_node-(\d+)/);
        
        if (nodeInMatch && nodeOutMatch) {
            return {
                inputNodeId: parseInt(nodeInMatch[1], 10),
                outputNodeId: parseInt(nodeOutMatch[1], 10)
            };
        }
        
        return null;
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

    /**
     * Update cardinality labels on a connection between two nodes
     * @param {number} sourceNodeId - Source node ID (our internal ID)
     * @param {number} targetNodeId - Target node ID (our internal ID)
     * @param {string} sourceCardinality - Cardinality label for source end
     * @param {string} targetCardinality - Cardinality label for target end
     */
    updateConnectionCardinalities(sourceNodeId, targetNodeId, sourceCardinality, targetCardinality) {
        const sourceDrawflowId = this._findDrawflowIdByNodeId(sourceNodeId);
        const targetDrawflowId = this._findDrawflowIdByNodeId(targetNodeId);

        if (!sourceDrawflowId || !targetDrawflowId) {
            return;
        }

        // Find the connection element using class names
        const connectionSelector = `.connection.node_out_node-${sourceDrawflowId}.node_in_node-${targetDrawflowId}`;
        const connectionElement = this._container.querySelector(connectionSelector);

        if (!connectionElement) {
            return;
        }

        // Remove existing labels if any
        this._removeCardinalityLabels(connectionElement);

        // Get the SVG path element
        const pathElement = connectionElement.querySelector('.main-path');
        if (!pathElement) {
            return;
        }

        // Add new cardinality labels
        this._addCardinalityLabels(connectionElement, pathElement, sourceCardinality, targetCardinality);
    }

    /**
     * Remove existing cardinality labels from a connection
     * @param {Element} connectionElement - The connection SVG element
     */
    _removeCardinalityLabels(connectionElement) {
        const existingLabels = connectionElement.querySelectorAll('.cardinality-label');
        existingLabels.forEach(label => label.remove());
    }

    /**
     * Add cardinality labels to a connection SVG
     * @param {SVGElement} connectionElement - The connection SVG element
     * @param {SVGPathElement} pathElement - The path element of the connection
     * @param {string} sourceCardinality - Cardinality for source end
     * @param {string} targetCardinality - Cardinality for target end
     */
    _addCardinalityLabels(connectionElement, pathElement, sourceCardinality, targetCardinality) {
        // Get path points to position labels
        const pathLength = pathElement.getTotalLength();

        // Position labels at 15% and 85% of path length for better visibility
        // Use minimum offset of 20px and maximum of 40px from endpoints
        const sourceOffset = Math.min(40, Math.max(20, pathLength * 0.15));
        const targetOffset = Math.min(40, Math.max(20, pathLength * 0.15));

        // Get positions near the start and end of the path
        const sourcePoint = pathElement.getPointAtLength(sourceOffset);
        const targetPoint = pathElement.getPointAtLength(pathLength - targetOffset);

        // Add vertical offset to position labels above the line
        const verticalOffset = -15;

        // Create source cardinality label
        const sourceLabel = this._createCardinalityLabel(
            sourceCardinality,
            sourcePoint.x,
            sourcePoint.y + verticalOffset,
            'source'
        );
        connectionElement.appendChild(sourceLabel);

        // Create target cardinality label
        const targetLabel = this._createCardinalityLabel(
            targetCardinality,
            targetPoint.x,
            targetPoint.y + verticalOffset,
            'target'
        );
        connectionElement.appendChild(targetLabel);
    }

    /**
     * Create an SVG text element for cardinality label
     * @param {string} text - The cardinality text
     * @param {number} x - X position
     * @param {number} y - Y position
     * @param {string} position - 'source' or 'target' for styling
     * @returns {SVGGElement} The label group element
     */
    _createCardinalityLabel(text, x, y, position) {
        const svgNS = 'http://www.w3.org/2000/svg';

        // Create a group to hold background and text
        const group = document.createElementNS(svgNS, 'g');
        group.setAttribute('class', `cardinality-label cardinality-${position}`);

        // Create background rectangle for better readability
        const bg = document.createElementNS(svgNS, 'rect');
        bg.setAttribute('class', 'cardinality-bg');
        bg.setAttribute('rx', '3');
        bg.setAttribute('ry', '3');

        // Create text element
        const textEl = document.createElementNS(svgNS, 'text');
        textEl.setAttribute('x', x);
        textEl.setAttribute('y', y);
        textEl.setAttribute('class', 'cardinality-text');
        textEl.setAttribute('text-anchor', 'middle');
        textEl.setAttribute('dominant-baseline', 'middle');
        textEl.textContent = text;

        group.appendChild(bg);
        group.appendChild(textEl);

        // Position the background after text is added (need to measure text)
        // Use requestAnimationFrame to ensure text is rendered
        requestAnimationFrame(() => {
            const bbox = textEl.getBBox();
            const padding = 4;
            bg.setAttribute('x', bbox.x - padding);
            bg.setAttribute('y', bbox.y - padding);
            bg.setAttribute('width', bbox.width + padding * 2);
            bg.setAttribute('height', bbox.height + padding * 2);
        });

        return group;
    }

    /**
     * Remove cardinality labels for a connection between two nodes
     * @param {number} sourceNodeId - Source node ID
     * @param {number} targetNodeId - Target node ID
     */
    removeConnectionCardinalityLabels(sourceNodeId, targetNodeId) {
        const sourceDrawflowId = this._findDrawflowIdByNodeId(sourceNodeId);
        const targetDrawflowId = this._findDrawflowIdByNodeId(targetNodeId);

        if (!sourceDrawflowId || !targetDrawflowId) {
            return;
        }

        const connectionSelector = `.connection.node_out_node-${sourceDrawflowId}.node_in_node-${targetDrawflowId}`;
        const connectionElement = this._container.querySelector(connectionSelector);

        if (connectionElement) {
            this._removeCardinalityLabels(connectionElement);
        }
    }
}
