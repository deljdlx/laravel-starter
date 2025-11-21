import Drawflow from 'drawflow';
import 'drawflow/dist/drawflow.min.css';

/**
 * DrawflowManager - Manages the Drawflow editor instance
 */
export class DrawflowManager {
    constructor(containerId, schemaState) {
        this.containerId = containerId;
        this.schemaState = schemaState;
        this.editor = null;
        this.container = null;
        this.eventHandlers = {
            nodeSelected: null,
            nodeUnselected: null,
            nodeRemoved: null
        };
    }

    /**
     * Initialize the Drawflow editor
     * @returns {boolean} True if initialized successfully
     */
    initialize() {
        this.container = document.getElementById(this.containerId);
        if (!this.container) {
            console.error('Drawflow container not found');
            return false;
        }

        this.editor = new Drawflow(this.container);
        this.editor.reroute = true;
        this.editor.reroute_fix_curvature = true;
        this.editor.curvature = 0.5;
        this.editor.start();

        this.setupInternalEventListeners();

        console.log('Schema Editor initialized with Drawflow');
        return true;
    }

    /**
     * Setup internal Drawflow event listeners
     */
    setupInternalEventListeners() {
        // Drawflow node selection
        this.editor.on('nodeSelected', (id) => {
            const nodeData = this.editor.getNodeFromId(id);
            if (nodeData && nodeData.name) {
                const match = nodeData.name.match(/model_(\d+)/);
                if (match) {
                    const ourNodeId = parseInt(match[1]);
                    const model = this.schemaState.findModelByNodeId(ourNodeId);
                    if (model && this.eventHandlers.nodeSelected) {
                        this.eventHandlers.nodeSelected(model);
                    }
                }
            }
        });

        // Drawflow node unselected
        this.editor.on('nodeUnselected', () => {
            if (this.eventHandlers.nodeUnselected) {
                this.eventHandlers.nodeUnselected();
            }
        });

        // Drawflow node removal
        this.editor.on('nodeRemoved', (id) => {
            const nodeData = this.editor.getNodeFromId(id);
            if (nodeData && nodeData.name) {
                const match = nodeData.name.match(/model_(\d+)/);
                if (match) {
                    const ourNodeId = parseInt(match[1]);
                    this.schemaState.removeModel(ourNodeId);
                    if (this.eventHandlers.nodeRemoved) {
                        this.eventHandlers.nodeRemoved();
                    }
                }
            }
        });
    }

    /**
     * Register event handler
     * @param {string} event - Event name (nodeSelected, nodeUnselected, nodeRemoved)
     * @param {Function} handler - Event handler function
     */
    on(event, handler) {
        if (this.eventHandlers.hasOwnProperty(event)) {
            this.eventHandlers[event] = handler;
        }
    }

    /**
     * Create a Drawflow node for a model
     * @param {Object} modelData - Model data
     * @param {string} html - HTML content for the node
     */
    createNode(modelData, html) {
        const posX = 50 + (this.schemaState.models.length - 1) * 250;
        const posY = 50 + Math.floor((this.schemaState.models.length - 1) / 3) * 200;

        this.editor.addNode(
            `model_${modelData.nodeId}`,
            1, // inputs
            1, // outputs
            posX,
            posY,
            'model-node',
            {},
            html
        );
    }

    /**
     * Update node visual representation
     * @param {Object} modelData - Model data
     * @param {string} html - New HTML content
     */
    updateNodeVisual(modelData, html) {
        const drawflowData = this.editor.export();
        let drawflowNodeId = null;

        for (const [id, node] of Object.entries(drawflowData.drawflow.Home.data)) {
            if (node.name === `model_${modelData.nodeId}`) {
                drawflowNodeId = id;
                break;
            }
        }

        if (drawflowNodeId) {
            const nodeElement = document.querySelector(`#node-${drawflowNodeId} .drawflow_content_node`);
            if (nodeElement) {
                nodeElement.innerHTML = html;
            }
        }
    }

    /**
     * Remove a node by model data
     * @param {Object} modelData - Model data
     */
    removeNode(modelData) {
        const drawflowData = this.editor.export();
        let drawflowNodeId = null;

        for (const [id, node] of Object.entries(drawflowData.drawflow.Home.data)) {
            if (node.name === `model_${modelData.nodeId}`) {
                drawflowNodeId = id;
                break;
            }
        }

        if (drawflowNodeId) {
            this.editor.removeNodeId(`node-${drawflowNodeId}`);
        }
    }

    /**
     * Generate HTML for a model node
     * @param {Object} modelData - Model data
     * @returns {string} HTML string
     */
    generateNodeHTML(modelData) {
        let fieldsHTML = '';

        if (modelData.fields && modelData.fields.length > 0) {
            fieldsHTML = modelData.fields.map(field => {
                const nullable = field.nullable ? '<span class="nullable-indicator">?</span>' : '';
                const indexed = field.index ? '<span class="index-indicator" title="Indexed">🔍</span>' : '';
                return `
                    <div class="field-item">
                        <span class="field-name">${field.name}</span>
                        <span class="field-type-badge">${field.type}</span>
                        ${nullable}
                        ${indexed}
                    </div>
                `;
            }).join('');
        } else {
            fieldsHTML = '<div class="no-fields">No fields</div>';
        }

        return `
            <div class="model-node-content">
                <div class="model-header">
                    <strong>${modelData.modelName}</strong>
                </div>
                <div class="model-body">
                    ${fieldsHTML}
                </div>
            </div>
        `;
    }
}
