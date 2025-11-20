import Drawflow from 'drawflow';
import 'drawflow/dist/drawflow.min.css';

// Schema state management
const schemaState = {
    models: [],
    selectedModel: null,
    nodeIdCounter: 1,
    editingField: null
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
    editor.reroute_fix_curvature = true;
    editor.curvature = 0.5;
    editor.start();
    
    // Set up event listeners
    setupEventListeners();
    
    // Initial render
    renderUI();
    
    console.log('Schema Editor initialized with Drawflow');
}

/**
 * Setup event listeners for UI interactions
 */
function setupEventListeners() {
    // Add Model button
    const addModelBtn = document.getElementById('add-model-btn');
    if (addModelBtn) {
        addModelBtn.removeEventListener('click', addModel); // Remove old listener
        addModelBtn.addEventListener('click', addModel);
    }
    
    // Drawflow node selection
    editor.on('nodeSelected', (id) => {
        // Drawflow uses its own internal ID system
        // We need to find the model by checking the node's name attribute
        const nodeData = editor.getNodeFromId(id);
        if (nodeData && nodeData.name) {
            // Extract our nodeId from the node name (format: "model_X")
            const match = nodeData.name.match(/model_(\d+)/);
            if (match) {
                const ourNodeId = parseInt(match[1]);
                const model = schemaState.models.find(m => m.nodeId === ourNodeId);
                if (model) {
                    selectModel(model);
                }
            }
        }
    });
    
    // Drawflow node unselected
    editor.on('nodeUnselected', () => {
        // Optionally clear selection
    });
    
    // Drawflow node removal
    editor.on('nodeRemoved', (id) => {
        // Find model by checking all nodes to match Drawflow's internal ID
        const nodeData = editor.getNodeFromId(id);
        if (nodeData && nodeData.name) {
            const match = nodeData.name.match(/model_(\d+)/);
            if (match) {
                const ourNodeId = parseInt(match[1]);
                const modelIndex = schemaState.models.findIndex(m => m.nodeId === ourNodeId);
                if (modelIndex !== -1) {
                    schemaState.models.splice(modelIndex, 1);
                    if (schemaState.selectedModel && schemaState.selectedModel.nodeId === ourNodeId) {
                        schemaState.selectedModel = null;
                    }
                    renderUI();
                }
            }
        }
    });
}

/**
 * Setup property panel event listeners (called after rendering properties)
 */
function setupPropertyPanelListeners() {
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
    
    // Store the original nodeId before adding
    const originalNodeId = modelData.nodeId;
    
    editor.addNode(
        `model_${originalNodeId}`,
        1, // inputs
        1, // outputs
        posX,
        posY,
        'model-node',
        {},
        html
    );
    
    // IMPORTANT: Keep the original nodeId, don't overwrite it
    // The Drawflow library assigns editor.nodeId after adding, but we use our own counter
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
    
    // Find the Drawflow node ID by searching for our model name
    const drawflowData = editor.export();
    let drawflowNodeId = null;
    
    for (const [id, node] of Object.entries(drawflowData.drawflow.Home.data)) {
        if (node.name === `model_${modelData.nodeId}`) {
            drawflowNodeId = id;
            break;
        }
    }
    
    if (drawflowNodeId) {
        // Update the node's HTML content directly
        const nodeElement = document.querySelector(`#node-${drawflowNodeId} .drawflow_content_node`);
        if (nodeElement) {
            nodeElement.innerHTML = html;
        }
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
    
    // Find the Drawflow node ID
    const drawflowData = editor.export();
    let drawflowNodeId = null;
    
    for (const [id, node] of Object.entries(drawflowData.drawflow.Home.data)) {
        if (node.name === `model_${schemaState.selectedModel.nodeId}`) {
            drawflowNodeId = id;
            break;
        }
    }
    
    if (drawflowNodeId) {
        editor.removeNodeId(`node-${drawflowNodeId}`);
    }
    
    const index = schemaState.models.findIndex(m => m.nodeId === schemaState.selectedModel.nodeId);
    if (index !== -1) {
        schemaState.models.splice(index, 1);
    }
    
    schemaState.selectedModel = null;
    renderUI();
}

/**
 * Show field editor (for adding new field or editing existing)
 */
function showFieldEditor(fieldIndex = null) {
    const isEditing = fieldIndex !== null;
    const fieldData = isEditing 
        ? schemaState.selectedModel.fields[fieldIndex]
        : {
            name: '',
            type: 'string',
            nullable: false,
            default: null
        };
    
    schemaState.editingField = fieldIndex;
    
    const fieldEditorHTML = `
        <div class="field-editor-form" style="background: #f8fafc; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
            <div class="property-field">
                <label>Field Name</label>
                <input type="text" id="field-name-input" placeholder="e.g., email" value="${fieldData.name}" />
            </div>
            <div class="property-field">
                <label>Field Type</label>
                <select id="field-type-input">
                    <option value="string" ${fieldData.type === 'string' ? 'selected' : ''}>string</option>
                    <option value="text" ${fieldData.type === 'text' ? 'selected' : ''}>text</option>
                    <option value="integer" ${fieldData.type === 'integer' ? 'selected' : ''}>integer</option>
                    <option value="boolean" ${fieldData.type === 'boolean' ? 'selected' : ''}>boolean</option>
                    <option value="float" ${fieldData.type === 'float' ? 'selected' : ''}>float</option>
                    <option value="date" ${fieldData.type === 'date' ? 'selected' : ''}>date</option>
                    <option value="datetime" ${fieldData.type === 'datetime' ? 'selected' : ''}>datetime</option>
                </select>
            </div>
            <div class="property-field">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" id="field-nullable-input" ${fieldData.nullable ? 'checked' : ''} style="width: auto; margin-right: 0.5rem;" />
                    Nullable
                </label>
            </div>
            <div class="property-field">
                <label>Default Value</label>
                <input type="text" id="field-default-input" placeholder="null" value="${fieldData.default || ''}" />
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button id="save-field-btn" class="btn btn-primary btn-sm">💾 ${isEditing ? 'Update' : 'Save'} Field</button>
                <button id="cancel-field-btn" class="btn btn-secondary btn-sm">Cancel</button>
            </div>
        </div>
    `;
    
    const fieldEditorContainer = document.getElementById('field-editor-container');
    if (fieldEditorContainer) {
        fieldEditorContainer.innerHTML = fieldEditorHTML;
        
        // Focus on name input
        setTimeout(() => {
            document.getElementById('field-name-input')?.focus();
        }, 100);
        
        // Save button handler
        const saveBtn = document.getElementById('save-field-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => {
                const name = document.getElementById('field-name-input').value.trim();
                const type = document.getElementById('field-type-input').value;
                const nullable = document.getElementById('field-nullable-input').checked;
                const defaultValue = document.getElementById('field-default-input').value.trim() || null;
                
                if (!name) {
                    alert('Field name is required');
                    return;
                }
                
                const field = {
                    name: name,
                    type: type,
                    nullable: nullable,
                    default: defaultValue
                };
                
                if (isEditing) {
                    // Update existing field
                    schemaState.selectedModel.fields[fieldIndex] = field;
                } else {
                    // Add new field
                    schemaState.selectedModel.fields.push(field);
                }
                
                schemaState.editingField = null;
                updateNodeVisual(schemaState.selectedModel);
                renderPropertiesPanel();
                renderJSON();
            });
        }
        
        // Cancel button handler
        const cancelBtn = document.getElementById('cancel-field-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                schemaState.editingField = null;
                fieldEditorContainer.innerHTML = '';
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
                <div class="empty-state-icon">📦</div>
                <div>Select a model to view and edit its properties</div>
            </div>
        `;
        return;
    }
    
    const model = schemaState.selectedModel;
    
    let fieldsHTML = '';
    if (model.fields && model.fields.length > 0) {
        fieldsHTML = model.fields.map((field, index) => {
            const nullable = field.nullable ? '<span style="color: #f59e0b; margin-left: 0.25rem;">?</span>' : '';
            return `
                <div class="field-item" style="display: flex; align-items: center; padding: 0.75rem; border-bottom: 1px solid #e2e8f0; background: white;">
                    <div class="field-info" style="flex: 1;">
                        <div class="field-name" style="font-weight: 600; font-size: 0.875rem; color: #1e293b; font-family: 'Courier New', monospace;">
                            ${field.name}
                        </div>
                        <div class="field-type" style="font-size: 0.75rem; color: #64748b;">
                            ${field.type}${nullable}
                        </div>
                    </div>
                    <div class="field-actions" style="display: flex; gap: 0.25rem;">
                        <button class="btn btn-icon btn-sm" onclick="window.editField(${index})" title="Edit" style="background: #f1f5f9; border: 1px solid #e2e8f0;">✏️</button>
                        <button class="btn btn-icon btn-sm" onclick="window.deleteField(${index})" title="Delete" style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626;">🗑️</button>
                    </div>
                </div>
            `;
        }).join('');
    } else {
        fieldsHTML = '<div style="padding: 1.5rem; text-align: center; color: #94a3b8; font-style: italic; font-size: 0.875rem;">No fields yet</div>';
    }
    
    panel.innerHTML = `
        <div class="property-section">
            <div class="property-section-title">MODEL INFORMATION</div>
            <div class="property-field">
                <label>Model Name</label>
                <input type="text" id="model-name-input" value="${model.modelName}" />
            </div>
            <div class="property-field">
                <label>Table Name</label>
                <input type="text" id="table-name-input" value="${model.tableName}" />
            </div>
        </div>
        
        <div class="property-section">
            <div class="property-section-title">FIELDS</div>
            <button id="add-field-btn" class="btn btn-primary btn-sm" style="width: 100%; margin-bottom: 1rem;">
                ➕ Add Field
            </button>
            <div id="field-editor-container"></div>
            <div class="fields-list" style="border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden;">
                ${fieldsHTML}
            </div>
        </div>
        
        <div class="property-section">
            <button id="delete-model-btn" class="btn btn-danger" style="width: 100%;">
                🗑️ Delete Model
            </button>
        </div>
    `;
    
    // Setup event listeners for the new content
    setupPropertyPanelListeners();
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
    showFieldEditor(index);
};

window.deleteField = function(index) {
    if (!schemaState.selectedModel) return;
    if (confirm(`Delete field "${schemaState.selectedModel.fields[index].name}"?`)) {
        schemaState.selectedModel.fields.splice(index, 1);
        updateNodeVisual(schemaState.selectedModel);
        renderPropertiesPanel();
        renderJSON();
    }
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSchemaEditor);
} else {
    initSchemaEditor();
}
