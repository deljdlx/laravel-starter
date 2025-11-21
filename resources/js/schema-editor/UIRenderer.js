/**
 * UIRenderer - Handles rendering of UI panels
 */
export class UIRenderer {
    constructor(schemaState, fieldEditor, onDeleteModel) {
        this.schemaState = schemaState;
        this.fieldEditor = fieldEditor;
        this.onDeleteModel = onDeleteModel;
    }

    /**
     * Render the properties panel
     */
    renderPropertiesPanel() {
        const panel = document.getElementById('properties-panel');
        if (!panel) return;

        if (!this.schemaState.selectedModel) {
            panel.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <div>Select a model to view and edit its properties</div>
                </div>
            `;
            return;
        }

        const model = this.schemaState.selectedModel;

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

        this.setupPropertyPanelListeners();
    }

    /**
     * Setup property panel event listeners
     */
    setupPropertyPanelListeners() {
        // Add Field button
        const addFieldBtn = document.getElementById('add-field-btn');
        if (addFieldBtn) {
            addFieldBtn.addEventListener('click', () => {
                if (this.schemaState.selectedModel) {
                    this.fieldEditor.show();
                }
            });
        }

        // Delete Model button
        const deleteModelBtn = document.getElementById('delete-model-btn');
        if (deleteModelBtn) {
            deleteModelBtn.addEventListener('click', () => {
                if (this.onDeleteModel) {
                    this.onDeleteModel();
                }
            });
        }

        // Model name input
        const modelNameInput = document.getElementById('model-name-input');
        if (modelNameInput) {
            modelNameInput.addEventListener('input', (e) => {
                if (this.schemaState.selectedModel) {
                    this.schemaState.selectedModel.modelName = e.target.value;
                    // Trigger update through callback
                    if (this.onModelPropertyChanged) {
                        this.onModelPropertyChanged();
                    }
                }
            });
        }

        // Table name input
        const tableNameInput = document.getElementById('table-name-input');
        if (tableNameInput) {
            tableNameInput.addEventListener('input', (e) => {
                if (this.schemaState.selectedModel) {
                    this.schemaState.selectedModel.tableName = e.target.value;
                    this.renderJSON();
                }
            });
        }
    }

    /**
     * Set callback for model property changes
     * @param {Function} callback - Callback function
     */
    onModelPropertyChange(callback) {
        this.onModelPropertyChanged = callback;
    }

    /**
     * Render the JSON debug panel
     */
    renderJSON() {
        const jsonPanel = document.getElementById('json-debug-panel');
        if (!jsonPanel) return;

        const schema = this.schemaState.toJSON();
        jsonPanel.textContent = JSON.stringify(schema, null, 2);
    }

    /**
     * Render all UI components
     */
    renderAll() {
        this.renderPropertiesPanel();
        this.renderJSON();
    }
}
