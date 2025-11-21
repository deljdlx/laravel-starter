import { SchemaState } from './SchemaState.js';
import { DrawflowManager } from './DrawflowManager.js';
import { FieldEditor } from './FieldEditor.js';
import { UIRenderer } from './UIRenderer.js';

/**
 * SchemaEditor - Main class that coordinates all schema editor components
 */
export class SchemaEditor {
    constructor() {
        this.schemaState = new SchemaState();
        this.drawflowManager = null;
        this.fieldEditor = null;
        this.uiRenderer = null;
    }

    /**
     * Initialize the schema editor
     */
    initialize() {
        // Initialize Drawflow manager
        this.drawflowManager = new DrawflowManager('drawflow', this.schemaState);
        if (!this.drawflowManager.initialize()) {
            console.error('Failed to initialize Drawflow manager');
            return;
        }

        // Initialize field editor
        this.fieldEditor = new FieldEditor(
            this.schemaState,
            () => this.onFieldSaved()
        );

        // Initialize UI renderer
        this.uiRenderer = new UIRenderer(
            this.schemaState,
            this.fieldEditor,
            () => this.deleteSelectedModel()
        );

        // Setup event handlers
        this.setupEventHandlers();

        // Initial render
        this.uiRenderer.renderAll();

        console.log('Schema Editor initialized successfully');
    }

    /**
     * Setup event handlers
     */
    setupEventHandlers() {
        // Add Model button
        const addModelBtn = document.getElementById('add-model-btn');
        if (addModelBtn) {
            addModelBtn.removeEventListener('click', () => this.addModel());
            addModelBtn.addEventListener('click', () => this.addModel());
        }

        // Drawflow event handlers
        this.drawflowManager.on('nodeSelected', (model) => {
            this.schemaState.selectModel(model);
            this.uiRenderer.renderPropertiesPanel();
        });

        this.drawflowManager.on('nodeUnselected', () => {
            // Optionally clear selection
        });

        this.drawflowManager.on('nodeRemoved', () => {
            this.uiRenderer.renderAll();
        });

        // UI Renderer callback for model property changes
        this.uiRenderer.onModelPropertyChange(() => {
            this.updateNodeVisual(this.schemaState.selectedModel);
            this.uiRenderer.renderJSON();
        });

        // Setup global window functions for onclick handlers
        this.setupGlobalHandlers();
    }

    /**
     * Setup global window handlers for inline onclick attributes
     */
    setupGlobalHandlers() {
        window.editField = (index) => {
            if (!this.schemaState.selectedModel) return;
            this.fieldEditor.show(index);
        };

        window.deleteField = (index) => {
            if (!this.schemaState.selectedModel) return;
            if (confirm(`Delete field "${this.schemaState.selectedModel.fields[index].name}"?`)) {
                this.schemaState.selectedModel.fields.splice(index, 1);
                this.updateNodeVisual(this.schemaState.selectedModel);
                this.uiRenderer.renderPropertiesPanel();
                this.uiRenderer.renderJSON();
            }
        };
    }

    /**
     * Add a new model
     */
    addModel() {
        const modelData = {
            nodeId: this.schemaState.getNextNodeId(),
            modelName: `Model${this.schemaState.models.length + 1}`,
            tableName: `model${this.schemaState.models.length + 1}s`,
            fields: [],
            relations: []
        };

        this.schemaState.addModel(modelData);

        // Create Drawflow node
        const html = this.drawflowManager.generateNodeHTML(modelData);
        this.drawflowManager.createNode(modelData, html);

        // Select the new model
        this.schemaState.selectModel(modelData);

        this.uiRenderer.renderAll();
    }

    /**
     * Delete the selected model
     */
    deleteSelectedModel() {
        if (!this.schemaState.selectedModel) return;

        this.drawflowManager.removeNode(this.schemaState.selectedModel);
        this.schemaState.removeModel(this.schemaState.selectedModel.nodeId);

        this.uiRenderer.renderAll();
    }

    /**
     * Update node visual representation
     * @param {Object} modelData - Model data
     */
    updateNodeVisual(modelData) {
        const html = this.drawflowManager.generateNodeHTML(modelData);
        this.drawflowManager.updateNodeVisual(modelData, html);
    }

    /**
     * Callback for when a field is saved
     */
    onFieldSaved() {
        this.updateNodeVisual(this.schemaState.selectedModel);
        this.uiRenderer.renderPropertiesPanel();
        this.uiRenderer.renderJSON();
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        const editor = new SchemaEditor();
        editor.initialize();
    });
} else {
    const editor = new SchemaEditor();
    editor.initialize();
}
