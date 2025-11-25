/**
 * FieldController - Handles field-related user interactions
 * Pure controller - coordinates between Model and Views
 */
export class FieldController {
    /**
     * @param {SchemaModel} model - The schema model
     * @param {FieldEditorView} fieldEditorView - The field editor view
     */
    constructor(model, fieldEditorView) {
        this._model = model;
        this._fieldEditorView = fieldEditorView;
        this._isEditing = false;

        this._setupViewListeners();
    }

    /**
     * Setup listeners for view events
     */
    _setupViewListeners() {
        this._fieldEditorView.on('save', (data) => this._handleSave(data.fieldData));
        this._fieldEditorView.on('cancel', () => this._handleCancel());
    }

    /**
     * Show the field editor for adding a new field
     */
    showAddField() {
        if (!this._model.selectedModel) {
            return;
        }

        this._isEditing = false;
        this._model.editingFieldIndex = null;
        const fieldData = this._model.getFieldDataForEdit(null);
        this._fieldEditorView.render(fieldData, false);
    }

    /**
     * Show the field editor for editing an existing field
     * @param {number} fieldIndex - Index of the field to edit
     */
    showEditField(fieldIndex) {
        if (!this._model.selectedModel) {
            return;
        }

        this._isEditing = true;
        this._model.editingFieldIndex = fieldIndex;
        const fieldData = this._model.getFieldDataForEdit(fieldIndex);
        this._fieldEditorView.render(fieldData, true);
    }

    /**
     * Handle save from field editor view
     * @param {Object} fieldData - Field data from form
     */
    _handleSave(fieldData) {
        if (!this._model.selectedModel) {
            return;
        }

        const nodeId = this._model.selectedModel.nodeId;

        if (this._isEditing && this._model.editingFieldIndex !== null) {
            this._model.updateField(nodeId, this._model.editingFieldIndex, fieldData);
        } else {
            this._model.addField(nodeId, fieldData);
        }

        this._model.editingFieldIndex = null;
        this._fieldEditorView.hide();
    }

    /**
     * Handle cancel from field editor view
     */
    _handleCancel() {
        this._model.editingFieldIndex = null;
        this._fieldEditorView.hide();
    }

    /**
     * Delete a field
     * @param {number} fieldIndex - Index of the field to delete
     * @returns {boolean} True if field was deleted
     */
    deleteField(fieldIndex) {
        if (!this._model.selectedModel) {
            return false;
        }

        const field = this._model.selectedModel.fields[fieldIndex];
        if (!field) {
            return false;
        }

        if (confirm(`Delete field "${field.name}"?`)) {
            this._model.removeField(this._model.selectedModel.nodeId, fieldIndex);
            return true;
        }

        return false;
    }
}
