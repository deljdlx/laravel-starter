import { EventEmitter } from '../utils/EventEmitter.js';

/**
 * FieldEditorView - Responsible for rendering the field editor form
 * 
 * Events emitted:
 * - save: when save button is clicked, payload: { fieldData }
 * - cancel: when cancel button is clicked
 */
export class FieldEditorView extends EventEmitter {
    /**
     * @param {string} containerId - ID of the field editor container
     */
    constructor(containerId = 'field-editor-container') {
        super();
        this._containerId = containerId;
        this._fieldTypes = [
            'string',
            'text',
            'integer',
            'boolean',
            'float',
            'date',
            'datetime'
        ];
        this._indexTypes = [
            'none',
            'primary',
            'index',
            'unique'
        ];
    }

    /**
     * Render the field editor form
     * @param {Object} fieldData - Field data to edit
     * @param {boolean} isEditing - Whether editing an existing field
     */
    render(fieldData, isEditing = false) {
        const container = document.getElementById(this._containerId);
        if (!container) {
            return;
        }

        container.innerHTML = this._generateFormHTML(fieldData, isEditing);
        this._bindEvents();

        // Focus on name input
        setTimeout(() => {
            document.getElementById('field-name-input')?.focus();
        }, 100);
    }

    /**
     * Hide/clear the field editor
     */
    hide() {
        const container = document.getElementById(this._containerId);
        if (container) {
            container.innerHTML = '';
        }
    }

    /**
     * Generate the form HTML
     * @param {Object} fieldData - Field data
     * @param {boolean} isEditing - Whether editing
     * @returns {string} HTML string
     */
    _generateFormHTML(fieldData, isEditing) {
        return `
            <div class="field-editor-form" style="background: #f8fafc; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                <div class="property-field">
                    <label>Field Name</label>
                    <input type="text" id="field-name-input" placeholder="e.g., email" value="${this._escapeAttr(fieldData.name)}" />
                </div>
                <div class="property-field">
                    <label>Field Type</label>
                    <select id="field-type-input">
                        ${this._renderTypeOptions(fieldData.type)}
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
                        ${this._renderIndexOptions(fieldData.index)}
                    </select>
                </div>
                <div class="property-field">
                    <label>Default Value</label>
                    <input type="text" id="field-default-input" placeholder="null" value="${this._escapeAttr(fieldData.default || '')}" />
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button id="save-field-btn" class="btn btn-primary btn-sm">💾 ${isEditing ? 'Update' : 'Save'} Field</button>
                    <button id="cancel-field-btn" class="btn btn-secondary btn-sm">Cancel</button>
                </div>
            </div>
        `;
    }

    /**
     * Render field type options
     * @param {string} selectedType - Currently selected type
     * @returns {string} HTML options
     */
    _renderTypeOptions(selectedType) {
        return this._fieldTypes.map(type =>
            `<option value="${type}" ${type === selectedType ? 'selected' : ''}>${type}</option>`
        ).join('');
    }

    /**
     * Render index type options
     * @param {string} selectedIndex - Currently selected index type
     * @returns {string} HTML options
     */
    _renderIndexOptions(selectedIndex) {
        return this._indexTypes.map(indexType =>
            `<option value="${indexType}" ${indexType === selectedIndex ? 'selected' : ''}>${indexType}</option>`
        ).join('');
    }

    /**
     * Bind event listeners to form elements
     */
    _bindEvents() {
        const saveBtn = document.getElementById('save-field-btn');
        const cancelBtn = document.getElementById('cancel-field-btn');

        if (saveBtn) {
            saveBtn.addEventListener('click', () => this._handleSave());
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => this._handleCancel());
        }
    }

    /**
     * Handle save button click
     */
    _handleSave() {
        const fieldData = this._collectFormData();
        if (!fieldData.name) {
            alert('Field name is required');
            return;
        }
        this.emit('save', { fieldData });
    }

    /**
     * Handle cancel button click
     */
    _handleCancel() {
        this.emit('cancel');
    }

    /**
     * Collect form data into an object
     * @returns {Object} Field data from form
     */
    _collectFormData() {
        return {
            name: document.getElementById('field-name-input')?.value.trim() || '',
            type: document.getElementById('field-type-input')?.value || 'string',
            nullable: document.getElementById('field-nullable-input')?.checked || false,
            index: document.getElementById('field-index-input')?.value || 'none',
            default: document.getElementById('field-default-input')?.value.trim() || null
        };
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
