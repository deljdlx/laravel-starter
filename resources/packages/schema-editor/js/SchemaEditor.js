import { SchemaModel } from './models/SchemaModel.js';
import { SchemaEditorController } from './controllers/SchemaEditorController.js';
import { DrawflowAdapter } from './views/DrawflowAdapter.js';
import { NodeView } from './views/NodeView.js';
import { PropertiesPanelView } from './views/PropertiesPanelView.js';
import { JsonPanelView } from './views/JsonPanelView.js';
import { FieldEditorView } from './views/FieldEditorView.js';

/**
 * SchemaEditor - Entry point that bootstraps the MVC architecture
 * 
 * Architecture:
 * - Model: SchemaModel - handles all data state and emits events on changes
 * - Views: Separate view classes that handle only DOM rendering
 *   - DrawflowAdapter: Manages Drawflow library interactions
 *   - NodeView: Renders node HTML content
 *   - PropertiesPanelView: Renders the properties panel
 *   - JsonPanelView: Renders the JSON debug panel
 *   - FieldEditorView: Renders the field editor form
 * - Controllers: Handle user interactions and coordinate between Model and Views
 *   - SchemaEditorController: Main application controller
 *   - FieldController: Handles field-related operations
 */
export class SchemaEditor {
    constructor() {
        this._model = null;
        this._controller = null;
    }

    /**
     * Initialize the schema editor MVC components
     */
    initialize() {
        // Create Model
        this._model = new SchemaModel();

        // Create Views
        const views = {
            drawflowAdapter: new DrawflowAdapter('drawflow'),
            nodeView: new NodeView(),
            propertiesPanelView: new PropertiesPanelView('properties-panel'),
            jsonPanelView: new JsonPanelView('json-debug-panel'),
            fieldEditorView: new FieldEditorView('field-editor-container')
        };

        // Create Controller
        this._controller = new SchemaEditorController(this._model, views);

        // Initialize controller (which initializes all components)
        this._controller.initialize();

        console.log('Schema Editor (MVC) initialized successfully');
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
