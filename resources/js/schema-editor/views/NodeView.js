/**
 * NodeView - Responsible for rendering Drawflow node HTML
 * Pure view class - only handles HTML generation
 */
export class NodeView {
    /**
     * Generate HTML for a model node
     * @param {Object} modelData - Model data with fields
     * @returns {string} HTML string for the node
     */
    render(modelData) {
        const fieldsHTML = this._renderFields(modelData.fields);

        return `
            <div class="model-node-content">
                <div class="model-header">
                    <strong>${this._escapeHtml(modelData.modelName)}</strong>
                </div>
                <div class="model-body">
                    ${fieldsHTML}
                </div>
            </div>
        `;
    }

    /**
     * Render fields list HTML
     * @param {Array} fields - Array of field objects
     * @returns {string} HTML string
     */
    _renderFields(fields) {
        if (!fields || fields.length === 0) {
            return '<div class="no-fields">No fields</div>';
        }

        return fields.map(field => this._renderField(field)).join('');
    }

    /**
     * Render a single field item
     * @param {Object} field - Field data
     * @returns {string} HTML string
     */
    _renderField(field) {
        const nullable = field.nullable ? '<span class="nullable-indicator">?</span>' : '';
        const indexed = this._renderIndexIndicator(field.index);

        return `
            <div class="field-item">
                <span class="field-name">${this._escapeHtml(field.name)}</span>
                <span class="field-type-badge">${this._escapeHtml(field.type)}</span>
                ${nullable}
                ${indexed}
            </div>
        `;
    }

    /**
     * Render index indicator based on index type
     * @param {string} indexType - Index type (primary, index, unique, none)
     * @returns {string} HTML string for the indicator
     */
    _renderIndexIndicator(indexType) {
        switch (indexType) {
            case 'primary':
                return '<span class="unique-indicator" title="Primary Key">🔑</span>';
            case 'index':
            case true:
                return '<span class="index-indicator" title="Index">🔍</span>';
            case 'unique':
                return '<span class="unique-indicator" title="Unique Index">1️⃣</span>';
            default:
                return '';
        }
    }

    /**
     * Escape HTML special characters
     * @param {string} str - String to escape
     * @returns {string} Escaped string
     */
    _escapeHtml(str) {
        if (!str) return '';
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
}
