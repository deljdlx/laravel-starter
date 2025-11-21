/**
 * SchemaState - Manages the state of the schema editor
 */
export class SchemaState {
    constructor() {
        this.models = [];
        this.selectedModel = null;
        this.nodeIdCounter = 1;
        this.editingField = null;
    }

    /**
     * Add a new model to the schema
     * @param {Object} modelData - Model data
     * @returns {Object} The added model
     */
    addModel(modelData) {
        this.models.push(modelData);
        return modelData;
    }

    /**
     * Remove a model from the schema
     * @param {number} nodeId - The node ID of the model to remove
     * @returns {boolean} True if model was removed
     */
    removeModel(nodeId) {
        const index = this.models.findIndex(m => m.nodeId === nodeId);
        if (index !== -1) {
            this.models.splice(index, 1);
            if (this.selectedModel && this.selectedModel.nodeId === nodeId) {
                this.selectedModel = null;
            }
            return true;
        }
        return false;
    }

    /**
     * Find a model by its node ID
     * @param {number} nodeId - The node ID to search for
     * @returns {Object|null} The model or null if not found
     */
    findModelByNodeId(nodeId) {
        return this.models.find(m => m.nodeId === nodeId) || null;
    }

    /**
     * Select a model
     * @param {Object} model - The model to select
     */
    selectModel(model) {
        this.selectedModel = model;
    }

    /**
     * Clear the selected model
     */
    clearSelection() {
        this.selectedModel = null;
    }

    /**
     * Get the next node ID
     * @returns {number} The next node ID
     */
    getNextNodeId() {
        return this.nodeIdCounter++;
    }

    /**
     * Get the schema as JSON
     * @returns {Object} The schema as a JSON object
     */
    toJSON() {
        return {
            models: this.models.map(m => ({
                name: m.modelName,
                table: m.tableName,
                fields: m.fields,
                relations: m.relations
            }))
        };
    }
}
