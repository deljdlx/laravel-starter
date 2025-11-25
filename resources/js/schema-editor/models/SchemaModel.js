import { EventEmitter } from '../utils/EventEmitter.js';

/**
 * SchemaModel - Data model for the schema editor
 * Handles all data state and emits events when data changes
 * 
 * Events emitted:
 * - modelAdded: when a model is added
 * - modelRemoved: when a model is removed
 * - modelSelected: when a model is selected
 * - modelUpdated: when a model's properties are updated
 * - fieldAdded: when a field is added to a model
 * - fieldUpdated: when a field is updated
 * - fieldRemoved: when a field is removed
 * - schemaChanged: when any schema data changes
 */
export class SchemaModel extends EventEmitter {
    constructor() {
        super();
        this._models = [];
        this._selectedModel = null;
        this._nodeIdCounter = 1;
        this._editingFieldIndex = null;
    }

    /**
     * Get all models
     * @returns {Array} Array of model objects
     */
    get models() {
        return this._models;
    }

    /**
     * Get the currently selected model
     * @returns {Object|null} Selected model or null
     */
    get selectedModel() {
        return this._selectedModel;
    }

    /**
     * Get the index of the field being edited
     * @returns {number|null} Field index or null
     */
    get editingFieldIndex() {
        return this._editingFieldIndex;
    }

    /**
     * Set the index of the field being edited
     * @param {number|null} index - Field index or null
     */
    set editingFieldIndex(index) {
        this._editingFieldIndex = index;
    }

    /**
     * Get the next available node ID
     * @returns {number} Next node ID
     */
    getNextNodeId() {
        return this._nodeIdCounter++;
    }

    /**
     * Add a new model
     * @param {Object} modelData - Model data with nodeId, modelName, tableName, fields, relations
     * @returns {Object} The added model
     */
    addModel(modelData) {
        this._models.push(modelData);
        this.emit('modelAdded', modelData);
        this.emit('schemaChanged', this.toJSON());
        return modelData;
    }

    /**
     * Remove a model by node ID
     * @param {number} nodeId - Node ID to remove
     * @returns {boolean} True if model was removed
     */
    removeModel(nodeId) {
        const index = this._models.findIndex(m => m.nodeId === nodeId);
        if (index !== -1) {
            const removedModel = this._models.splice(index, 1)[0];
            if (this._selectedModel && this._selectedModel.nodeId === nodeId) {
                this._selectedModel = null;
                this.emit('modelSelected', null);
            }
            this.emit('modelRemoved', removedModel);
            this.emit('schemaChanged', this.toJSON());
            return true;
        }
        return false;
    }

    /**
     * Find a model by its node ID
     * @param {number} nodeId - Node ID to search for
     * @returns {Object|null} The model or null
     */
    findModelByNodeId(nodeId) {
        return this._models.find(m => m.nodeId === nodeId) || null;
    }

    /**
     * Select a model
     * @param {Object|null} model - Model to select or null to clear selection
     */
    selectModel(model) {
        this._selectedModel = model;
        this._editingFieldIndex = null;
        this.emit('modelSelected', model);
    }

    /**
     * Clear the selected model
     */
    clearSelection() {
        this.selectModel(null);
    }

    /**
     * Update model properties
     * @param {number} nodeId - Node ID of the model to update
     * @param {Object} properties - Properties to update (modelName, tableName)
     */
    updateModelProperties(nodeId, properties) {
        const model = this.findModelByNodeId(nodeId);
        if (model) {
            Object.assign(model, properties);
            this.emit('modelUpdated', model);
            this.emit('schemaChanged', this.toJSON());
        }
    }

    /**
     * Add a field to a model
     * @param {number} nodeId - Node ID of the model
     * @param {Object} field - Field data
     */
    addField(nodeId, field) {
        const model = this.findModelByNodeId(nodeId);
        if (model) {
            model.fields.push(field);
            this.emit('fieldAdded', { model, field });
            this.emit('modelUpdated', model);
            this.emit('schemaChanged', this.toJSON());
        }
    }

    /**
     * Update a field in a model
     * @param {number} nodeId - Node ID of the model
     * @param {number} fieldIndex - Index of the field to update
     * @param {Object} field - Updated field data
     */
    updateField(nodeId, fieldIndex, field) {
        const model = this.findModelByNodeId(nodeId);
        if (model && model.fields[fieldIndex]) {
            model.fields[fieldIndex] = field;
            this.emit('fieldUpdated', { model, fieldIndex, field });
            this.emit('modelUpdated', model);
            this.emit('schemaChanged', this.toJSON());
        }
    }

    /**
     * Remove a field from a model
     * @param {number} nodeId - Node ID of the model
     * @param {number} fieldIndex - Index of the field to remove
     * @returns {Object|null} The removed field or null
     */
    removeField(nodeId, fieldIndex) {
        const model = this.findModelByNodeId(nodeId);
        if (model && model.fields[fieldIndex]) {
            const removedField = model.fields.splice(fieldIndex, 1)[0];
            this.emit('fieldRemoved', { model, fieldIndex, field: removedField });
            this.emit('modelUpdated', model);
            this.emit('schemaChanged', this.toJSON());
            return removedField;
        }
        return null;
    }

    /**
     * Get field data for editing
     * @param {number} fieldIndex - Field index or null for new field
     * @returns {Object} Field data
     */
    getFieldDataForEdit(fieldIndex = null) {
        if (fieldIndex !== null && this._selectedModel?.fields[fieldIndex]) {
            return { ...this._selectedModel.fields[fieldIndex] };
        }
        return {
            name: '',
            type: 'string',
            nullable: false,
            default: null,
            index: 'none'
        };
    }

    /**
     * Convert schema to JSON format
     * @returns {Object} Schema as JSON
     */
    toJSON() {
        return {
            models: this._models.map(m => ({
                name: m.modelName,
                table: m.tableName,
                fields: m.fields,
                relations: m.relations
            }))
        };
    }

    /**
     * Create a new model data object
     * @returns {Object} New model data
     */
    createModelData() {
        return {
            nodeId: this.getNextNodeId(),
            modelName: `Model${this._models.length + 1}`,
            tableName: `model${this._models.length + 1}s`,
            fields: [],
            relations: []
        };
    }
}
