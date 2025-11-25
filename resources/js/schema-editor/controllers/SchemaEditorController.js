import { FieldController } from './FieldController.js';

/**
 * SchemaEditorController - Main controller coordinating all components
 * Handles the initialization and orchestration of MVC components
 */
export class SchemaEditorController {
    /**
     * @param {SchemaModel} model - The schema model
     * @param {Object} views - Object containing all view instances
     * @param {DrawflowAdapter} views.drawflowAdapter - The Drawflow adapter
     * @param {NodeView} views.nodeView - The node view
     * @param {PropertiesPanelView} views.propertiesPanelView - The properties panel view
     * @param {JsonPanelView} views.jsonPanelView - The JSON panel view
     * @param {FieldEditorView} views.fieldEditorView - The field editor view
     */
    constructor(model, views) {
        this._model = model;
        this._drawflowAdapter = views.drawflowAdapter;
        this._nodeView = views.nodeView;
        this._propertiesPanelView = views.propertiesPanelView;
        this._jsonPanelView = views.jsonPanelView;
        this._fieldEditorView = views.fieldEditorView;

        this._fieldController = null;
    }

    /**
     * Initialize the controller and setup all event handlers
     */
    initialize() {
        // Initialize Drawflow
        if (!this._drawflowAdapter.initialize()) {
            console.error('Failed to initialize Drawflow adapter');
            return;
        }

        // Initialize field controller
        this._fieldController = new FieldController(
            this._model,
            this._fieldEditorView
        );

        // Setup all event handlers
        this._setupModelListeners();
        this._setupViewListeners();
        this._setupDOMListeners();

        // Initial render
        this._renderAll();

        console.log('Schema Editor Controller initialized successfully');
    }

    /**
     * Setup listeners for model events
     */
    _setupModelListeners() {
        // Model updated - refresh node visual and properties panel
        this._model.on('modelUpdated', (model) => {
            const html = this._nodeView.render(model);
            this._drawflowAdapter.updateNodeContent(model.nodeId, html);
            // Re-render properties panel to show updated fields
            if (this._model.selectedModel && this._model.selectedModel.nodeId === model.nodeId) {
                this._propertiesPanelView.render(this._model.selectedModel);
            }
        });

        // Model selected - refresh properties panel
        this._model.on('modelSelected', () => {
            this._propertiesPanelView.render(this._model.selectedModel);
        });

        // Schema changed - refresh JSON panel
        this._model.on('schemaChanged', (schema) => {
            this._jsonPanelView.render(schema);
        });

        // Model removed - refresh properties panel
        this._model.on('modelRemoved', () => {
            this._propertiesPanelView.render(this._model.selectedModel);
        });
    }

    /**
     * Setup listeners for view events
     */
    _setupViewListeners() {
        // Drawflow events
        this._drawflowAdapter.on('nodeSelected', ({ nodeId }) => {
            const model = this._model.findModelByNodeId(nodeId);
            if (model) {
                this._model.selectModel(model);
            }
        });

        this._drawflowAdapter.on('nodeUnselected', () => {
            // Optionally clear selection
        });

        this._drawflowAdapter.on('nodeRemoved', ({ nodeId }) => {
            // Node was removed via Drawflow UI - sync with model
            if (nodeId !== undefined) {
                this._model.removeModel(nodeId);
            }
        });

        // Properties panel events
        this._propertiesPanelView.on('addFieldClick', () => {
            this._fieldController.showAddField();
        });

        this._propertiesPanelView.on('deleteModelClick', () => {
            this._deleteSelectedModel();
        });

        this._propertiesPanelView.on('modelNameChange', ({ value }) => {
            if (this._model.selectedModel) {
                this._model.updateModelProperties(this._model.selectedModel.nodeId, {
                    modelName: value
                });
            }
        });

        this._propertiesPanelView.on('tableNameChange', ({ value }) => {
            if (this._model.selectedModel) {
                this._model.updateModelProperties(this._model.selectedModel.nodeId, {
                    tableName: value
                });
            }
        });

        this._propertiesPanelView.on('editFieldClick', ({ index }) => {
            this._fieldController.showEditField(index);
        });

        this._propertiesPanelView.on('deleteFieldClick', ({ index }) => {
            this._fieldController.deleteField(index);
        });
    }

    /**
     * Setup DOM event listeners
     */
    _setupDOMListeners() {
        // Add Model button
        const addModelBtn = document.getElementById('add-model-btn');
        if (addModelBtn) {
            addModelBtn.addEventListener('click', () => this._addModel());
        }
    }

    /**
     * Add a new model
     */
    _addModel() {
        const modelData = this._model.createModelData();
        this._model.addModel(modelData);

        // Create Drawflow node
        const html = this._nodeView.render(modelData);
        const position = this._drawflowAdapter.calculateNodePosition(this._model.models.length);
        this._drawflowAdapter.createNode(modelData.nodeId, html, position.x, position.y);

        // Select the new model
        this._model.selectModel(modelData);
    }

    /**
     * Delete the selected model
     */
    _deleteSelectedModel() {
        if (!this._model.selectedModel) {
            return;
        }

        const nodeId = this._model.selectedModel.nodeId;
        this._drawflowAdapter.removeNode(nodeId);
        this._model.removeModel(nodeId);
    }

    /**
     * Render all UI components
     */
    _renderAll() {
        this._propertiesPanelView.render(this._model.selectedModel);
        this._jsonPanelView.render(this._model.toJSON());
    }
}
