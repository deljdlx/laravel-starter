import { IndexIndicator } from '../utils/IndexIndicator.js';

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
        const indexed = IndexIndicator.render(field.index);

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
