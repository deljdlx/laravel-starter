import Drawflow from 'drawflow';
import 'drawflow/dist/drawflow.min.css';

// Schema state management
const schemaState = {
    models: [],
    selectedModel: null,
    nodeIdCounter: 1
};

// Initialize Drawflow
let editor = null;
let drawflowContainer = null;

/**
 * Initialize the schema editor
 */
function initSchemaEditor() {
    const container = document.getElementById('drawflow');
    if (!container) {
        console.error('Drawflow container not found');
        return;
    }
    
    drawflowContainer = container;
    editor = new Drawflow(container);
    editor.reroute = true;
    editor.start();
    
    // Set up event listeners
    setupEventListeners();
    
    // Initial render
    renderUI();
}

/**
 * Setup event listeners for UI interactions
 */
function setupEventListeners() {
    // Add Model button
    const addModelBtn = document.getElementById('add-model-btn');
    if (addModelBtn) {
        addModelBtn.addEventListener('click', addModel);
    }
    
    // Add Field button
    const addFieldBtn = document.getElementById('add-field-btn');
    if (addFieldBtn) {
        addFieldBtn.addEventListener('click', () => {
            if (schemaState.selectedModel) {
                showFieldEditor();
            }
        });
    }
    
    // Delete Model button
    const deleteModelBtn = document.getElementById('delete-model-btn');
    if (deleteModelBtn) {
        deleteModelBtn.addEventListener('click', deleteSelectedModel);
    }
    
    // Model name input
    const modelNameInput = document.getElementById('model-name-input');
    if (modelNameInput) {
        modelNameInput.addEventListener('input', (e) => {
            if (schemaState.selectedModel) {
                schemaState.selectedModel.modelName = e.target.value;
                updateNodeVisual(schemaState.selectedModel);
                renderJSON();
            }
        });
    }
    
    // Table name input
    const tableNameInput = document.getElementById('table-name-input');
    if (tableNameInput) {
        tableNameInput.addEventListener('input', (e) => {
            if (schemaState.selectedModel) {
                schemaState.selectedModel.tableName = e.target.value;
                renderJSON();
            }
        });
    }
    
    // Drawflow node selection
    editor.on('nodeSelected', (id) => {
        const nodeId = parseInt(id);
        const model = schemaState.models.find(m => m.nodeId === nodeId);
        if (model) {
            selectModel(model);
        }
    });
    
    // Drawflow node removal
    editor.on('nodeRemoved', (id) => {
        const nodeId = parseInt(id);
        const modelIndex = schemaState.models.findIndex(m => m.nodeId === nodeId);
        if (modelIndex !== -1) {
            schemaState.models.splice(modelIndex, 1);
            if (schemaState.selectedModel && schemaState.selectedModel.nodeId === nodeId) {
                schemaState.selectedModel = null;
            }
            renderUI();
        }
    });
}

/**
 * Add a new model
 */
function addModel() {
    const modelData = {
        nodeId: schemaState.nodeIdCounter++,
        modelName: `Model${schemaState.models.length + 1}`,
        tableName: `model${schemaState.models.length + 1}s`,
        fields: [],
        relations: []
    };
    
    schemaState.models.push(modelData);
    
    // Create Drawflow node
    createDrawflowNode(modelData);
    
    // Select the new model
    selectModel(modelData);
    
    renderUI();
}

/**
 * Create a Drawflow node for a model
 */
function createDrawflowNode(modelData) {
    const html = generateNodeHTML(modelData);
    
    const posX = 50 + (schemaState.models.length - 1) * 250;
    const posY = 50 + Math.floor((schemaState.models.length - 1) / 3) * 200;
    
    editor.addNode(
        `model_${modelData.nodeId}`,
        1, // inputs
        1, // outputs
        posX,
        posY,
        'model-node',
        {},
        html
    );
    
    modelData.nodeId = editor.nodeId;
}

/**
 * Generate HTML for a model node
 */
function generateNodeHTML(modelData) {
    let fieldsHTML = '';
    
    if (modelData.fields && modelData.fields.length > 0) {
        fieldsHTML = modelData.fields.map(field => {
            const nullable = field.nullable ? '<span class="nullable-indicator">?</span>' : '';
            return `
                <div class="field-item">
                    <span class="field-name">${field.name}</span>
                    <span class="field-type-badge">${field.type}</span>
                    ${nullable}
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

/**
 * Update node visual representation
 */
function updateNodeVisual(modelData) {
    const html = generateNodeHTML(modelData);
    editor.updateNodeDataFromId(modelData.nodeId, {});
    
    // Update the node's HTML content
    const nodeElement = document.querySelector(`#node-${modelData.nodeId} .drawflow_content_node`);
    if (nodeElement) {
        nodeElement.innerHTML = html;
    }
}

/**
 * Select a model
 */
function selectModel(model) {
    schemaState.selectedModel = model;
    renderPropertiesPanel();
}

/**
 * Delete the selected model
 */
function deleteSelectedModel() {
    if (!schemaState.selectedModel) return;
    
    editor.removeNodeId(`node-${schemaState.selectedModel.nodeId}`);
    
    const index = schemaState.models.findIndex(m => m.nodeId === schemaState.selectedModel.nodeId);
    if (index !== -1) {
        schemaState.models.splice(index, 1);
    }
    
    schemaState.selectedModel = null;
    renderUI();
}

/**
 * Show field editor
 */
function showFieldEditor() {
    const fieldData = {
        name: '',
        type: 'string',
        nullable: false,
        default: null
    };
    
    const fieldEditorHTML = `
        <div class="field-editor-form">
            <input type="text" id="field-name" placeholder="Field name" class="form-control mb-2" value="${fieldData.name}">
            <select id="field-type" class="form-select mb-2">
                <option value="string" ${fieldData.type === 'string' ? 'selected' : ''}>string</option>
                <option value="text" ${fieldData.type === 'text' ? 'selected' : ''}>text</option>
                <option value="integer" ${fieldData.type === 'integer' ? 'selected' : ''}>integer</option>
                <option value="boolean" ${fieldData.type === 'boolean' ? 'selected' : ''}>boolean</option>
                <option value="float" ${fieldData.type === 'float' ? 'selected' : ''}>float</option>
                <option value="date" ${fieldData.type === 'date' ? 'selected' : ''}>date</option>
                <option value="datetime" ${fieldData.type === 'datetime' ? 'selected' : ''}>datetime</option>
            </select>
            <label class="form-check mb-2">
                <input type="checkbox" id="field-nullable" class="form-check-input" ${fieldData.nullable ? 'checked' : ''}>
                <span class="form-check-label">Nullable</span>
            </label>
            <input type="text" id="field-default" placeholder="Default value" class="form-control mb-2" value="${fieldData.default || ''}">
            <button id="save-field-btn" class="btn btn-primary">💾 Save Field</button>
        </div>
    `;
    
    const fieldEditorContainer = document.getElementById('field-editor-container');
    if (fieldEditorContainer) {
        fieldEditorContainer.innerHTML = fieldEditorHTML;
        
        // Add save handler
        const saveBtn = document.getElementById('save-field-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => {
                const field = {
                    name: document.getElementById('field-name').value,
                    type: document.getElementById('field-type').value,
                    nullable: document.getElementById('field-nullable').checked,
                    default: document.getElementById('field-default').value || null
                };
                
                if (field.name) {
                    schemaState.selectedModel.fields.push(field);
                    updateNodeVisual(schemaState.selectedModel);
                    renderPropertiesPanel();
                    renderJSON();
                    fieldEditorContainer.innerHTML = '';
                }
            });
        }
    }
}

/**
 * Render the properties panel
 */
function renderPropertiesPanel() {
    const panel = document.getElementById('properties-panel');
    if (!panel) return;
    
    if (!schemaState.selectedModel) {
        panel.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <p class="empty-title">Select a model to view and edit its properties</p>
            </div>
        `;
        return;
    }
    
    const model = schemaState.selectedModel;
    
    let fieldsHTML = '';
    if (model.fields && model.fields.length > 0) {
        fieldsHTML = model.fields.map((field, index) => {
            const nullable = field.nullable ? '?' : '';
            return `
                <div class="field-row">
                    <span>${field.name}: ${field.type}${nullable}</span>
                    <div class="field-actions">
                        <button class="btn btn-sm btn-icon" onclick="editField(${index})" title="Edit">✏️</button>
                        <button class="btn btn-sm btn-icon btn-danger" onclick="deleteField(${index})" title="Delete">🗑️</button>
                    </div>
                </div>
            `;
        }).join('');
    }
    
    panel.innerHTML = `
        <h3>MODEL INFORMATION</h3>
        <div class="mb-3">
            <label>Model Name</label>
            <input type="text" id="model-name-input" class="form-control" value="${model.modelName}">
        </div>
        <div class="mb-3">
            <label>Table Name</label>
            <input type="text" id="table-name-input" class="form-control" value="${model.tableName}">
        </div>
        
        <h3 class="mt-4">FIELDS</h3>
        <button id="add-field-btn" class="btn btn-primary btn-sm mb-2">➕ Add Field</button>
        <div id="field-editor-container"></div>
        <div class="fields-list">${fieldsHTML || '<p>No fields</p>'}</div>
        
        <button id="delete-model-btn" class="btn btn-danger mt-4">🗑️ Delete Model</button>
    `;
    
    // Re-setup event listeners for the new content
    setupEventListeners();
}

/**
 * Render the JSON debug panel
 */
function renderJSON() {
    const jsonPanel = document.getElementById('json-debug-panel');
    if (!jsonPanel) return;
    
    const schema = {
        models: schemaState.models.map(m => ({
            name: m.modelName,
            table: m.tableName,
            fields: m.fields,
            relations: m.relations
        }))
    };
    
    jsonPanel.textContent = JSON.stringify(schema, null, 2);
}

/**
 * Render the entire UI
 */
function renderUI() {
    renderPropertiesPanel();
    renderJSON();
}

// Make functions globally available for onclick handlers
window.editField = function(index) {
    if (!schemaState.selectedModel) return;
    // TODO: Implement field editing
    console.log('Edit field:', index);
};

window.deleteField = function(index) {
    if (!schemaState.selectedModel) return;
    schemaState.selectedModel.fields.splice(index, 1);
    updateNodeVisual(schemaState.selectedModel);
    renderPropertiesPanel();
    renderJSON();
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSchemaEditor);
} else {
    initSchemaEditor();
}
