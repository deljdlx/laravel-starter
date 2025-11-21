/**
 * FieldEditor - Manages field creation and editing
 */
export class FieldEditor {
    constructor(schemaState, onFieldSaved) {
        this.schemaState = schemaState;
        this.onFieldSaved = onFieldSaved;
    }

    /**
     * Show field editor for adding or editing a field
     * @param {number|null} fieldIndex - Index of field to edit, or null for new field
     */
    show(fieldIndex = null) {
        const isEditing = fieldIndex !== null;
        const fieldData = isEditing
            ? this.schemaState.selectedModel.fields[fieldIndex]
            : {
                name: '',
                type: 'string',
                nullable: false,
                default: null,
                index: 'none'
            };

        this.schemaState.editingField = fieldIndex;

        const fieldEditorHTML = this.generateEditorHTML(fieldData, isEditing);

        const fieldEditorContainer = document.getElementById('field-editor-container');
        if (fieldEditorContainer) {
            fieldEditorContainer.innerHTML = fieldEditorHTML;

            // Focus on name input
            setTimeout(() => {
                document.getElementById('field-name-input')?.focus();
            }, 100);

            this.setupEventListeners(isEditing, fieldIndex);
        }
    }

    /**
     * Generate HTML for field editor
     * @param {Object} fieldData - Field data
     * @param {boolean} isEditing - Whether we're editing or creating
     * @returns {string} HTML string
     */
    generateEditorHTML(fieldData, isEditing) {
        return `
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
                    <label>Index Type</label>
                    <select id="field-index-input">
                        <option value="none" ${(!fieldData.index || fieldData.index === 'none' || fieldData.index === false) ? 'selected' : ''}>No index</option>
                        <option value="index" ${(fieldData.index === 'index' || fieldData.index === true) ? 'selected' : ''}>Index</option>
                        <option value="unique" ${fieldData.index === 'unique' ? 'selected' : ''}>Unique</option>
                    </select>
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
    }

    /**
     * Setup event listeners for the editor
     * @param {boolean} isEditing - Whether we're editing or creating
     * @param {number|null} fieldIndex - Index of field being edited
     */
    setupEventListeners(isEditing, fieldIndex) {
        // Save button handler
        const saveBtn = document.getElementById('save-field-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => {
                this.saveField(isEditing, fieldIndex);
            });
        }

        // Cancel button handler
        const cancelBtn = document.getElementById('cancel-field-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                this.hide();
            });
        }
    }

    /**
     * Save the field
     * @param {boolean} isEditing - Whether we're editing or creating
     * @param {number|null} fieldIndex - Index of field being edited
     */
    saveField(isEditing, fieldIndex) {
        const name = document.getElementById('field-name-input').value.trim();
        const type = document.getElementById('field-type-input').value;
        const nullable = document.getElementById('field-nullable-input').checked;
        const index = document.getElementById('field-index-input').value;
        const defaultValue = document.getElementById('field-default-input').value.trim() || null;

        if (!name) {
            alert('Field name is required');
            return;
        }

        const field = {
            name: name,
            type: type,
            nullable: nullable,
            index: index,
            default: defaultValue
        };

        if (isEditing) {
            // Update existing field
            this.schemaState.selectedModel.fields[fieldIndex] = field;
        } else {
            // Add new field
            this.schemaState.selectedModel.fields.push(field);
        }

        this.schemaState.editingField = null;
        this.hide();

        if (this.onFieldSaved) {
            this.onFieldSaved();
        }
    }

    /**
     * Hide the field editor
     */
    hide() {
        this.schemaState.editingField = null;
        const fieldEditorContainer = document.getElementById('field-editor-container');
        if (fieldEditorContainer) {
            fieldEditorContainer.innerHTML = '';
        }
    }
}
