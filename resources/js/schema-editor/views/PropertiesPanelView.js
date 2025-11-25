import { EventEmitter } from '../utils/EventEmitter.js';
import { IndexIndicator } from '../utils/IndexIndicator.js';

/**
 * PropertiesPanelView - Responsible for rendering the properties panel
 * 
 * Events emitted:
 * - addFieldClick: when add field button is clicked
 * - deleteModelClick: when delete model button is clicked
 * - modelNameChange: when model name input changes, payload: { value }
 * - tableNameChange: when table name input changes, payload: { value }
 * - editFieldClick: when edit field button is clicked, payload: { index }
 * - deleteFieldClick: when delete field button is clicked, payload: { index }
 */
export class PropertiesPanelView extends EventEmitter {
    /**
     * @param {string} elementId - ID of the properties panel container
     */
    constructor(elementId = 'properties-panel') {
        super();
        this._elementId = elementId;
    }

    /**
     * Render the properties panel
     * @param {Object|null} model - Selected model or null
     */
    render(model) {
        const panel = document.getElementById(this._elementId);
        if (!panel) {
            return;
        }

        if (!model) {
            panel.innerHTML = this._renderEmptyState();
            return;
        }

        panel.innerHTML = this._renderModelProperties(model);
        this._bindEvents();
    }

    /**
     * Render empty state when no model is selected
     * @returns {string} HTML string
     */
    _renderEmptyState() {
        return `
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <div>Select a model to view and edit its properties</div>
            </div>
        `;
    }

    /**
     * Render model properties
     * @param {Object} model - Model data
     * @returns {string} HTML string
     */
    _renderModelProperties(model) {
        const fieldsHTML = this._renderFieldsList(model.fields);

        return `
            <div class="property-section">
                <div class="property-section-title">MODEL INFORMATION</div>
                <div class="property-field">
                    <label>Model Name</label>
                    <input type="text" id="model-name-input" value="${this._escapeAttr(model.modelName)}" />
                </div>
                <div class="property-field">
                    <label>Table Name</label>
                    <input type="text" id="table-name-input" value="${this._escapeAttr(model.tableName)}" />
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
    }

    /**
     * Render the fields list
     * @param {Array} fields - Array of field objects
     * @returns {string} HTML string
     */
    _renderFieldsList(fields) {
        if (!fields || fields.length === 0) {
            return '<div style="padding: 1.5rem; text-align: center; color: #94a3b8; font-style: italic; font-size: 0.875rem;">No fields yet</div>';
        }

        return fields.map((field, index) => this._renderFieldItem(field, index)).join('');
    }

    /**
     * Render a single field item
     * @param {Object} field - Field data
     * @param {number} index - Field index
     * @returns {string} HTML string
     */
    _renderFieldItem(field, index) {
        const nullable = field.nullable ? '<span style="color: #f59e0b; margin-left: 0.25rem;">?</span>' : '';
        const indexed = IndexIndicator.render(field.index, { inline: true });

        return `
            <div class="field-item" style="display: flex; align-items: center; padding: 0.75rem; border-bottom: 1px solid #e2e8f0; background: white;">
                <div class="field-info" style="flex: 1;">
                    <div class="field-name" style="font-weight: 600; font-size: 0.875rem; color: #1e293b; font-family: 'Courier New', monospace;">
                        ${this._escapeHtml(field.name)}
                    </div>
                    <div class="field-type" style="font-size: 0.75rem; color: #64748b;">
                        ${this._escapeHtml(field.type)}${nullable}${indexed}
                    </div>
                </div>
                <div class="field-actions" style="display: flex; gap: 0.25rem;">
                    <button class="btn btn-icon btn-sm btn-edit-field" data-index="${index}" title="Edit" style="background: #f1f5f9; border: 1px solid #e2e8f0;">✏️</button>
                    <button class="btn btn-icon btn-sm btn-delete-field" data-index="${index}" title="Delete" style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626;">🗑️</button>
                </div>
            </div>
        `;
    }

    /**
     * Bind event listeners
     */
    _bindEvents() {
        // Add Field button
        const addFieldBtn = document.getElementById('add-field-btn');
        if (addFieldBtn) {
            addFieldBtn.addEventListener('click', () => this.emit('addFieldClick'));
        }

        // Delete Model button
        const deleteModelBtn = document.getElementById('delete-model-btn');
        if (deleteModelBtn) {
            deleteModelBtn.addEventListener('click', () => this.emit('deleteModelClick'));
        }

        // Model name input
        const modelNameInput = document.getElementById('model-name-input');
        if (modelNameInput) {
            modelNameInput.addEventListener('input', (e) => {
                this.emit('modelNameChange', { value: e.target.value });
            });
        }

        // Table name input
        const tableNameInput = document.getElementById('table-name-input');
        if (tableNameInput) {
            tableNameInput.addEventListener('input', (e) => {
                this.emit('tableNameChange', { value: e.target.value });
            });
        }

        // Edit field buttons
        document.querySelectorAll('.btn-edit-field').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index, 10);
                this.emit('editFieldClick', { index });
            });
        });

        // Delete field buttons
        document.querySelectorAll('.btn-delete-field').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index, 10);
                this.emit('deleteFieldClick', { index });
            });
        });
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

    /**
     * Escape string for use in HTML attributes
     * @param {string} str - String to escape
     * @returns {string} Escaped string
     */
    _escapeAttr(str) {
        if (!str) return '';
        return str.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }
}
