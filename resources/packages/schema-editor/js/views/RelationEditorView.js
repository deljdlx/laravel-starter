import { EventEmitter } from '../utils/EventEmitter.js';

/**
 * RelationEditorView - Modal popup for editing relation cardinalities
 * 
 * Events emitted:
 * - save: when save button is clicked, payload: { relationData }
 * - cancel: when cancel button is clicked or modal is closed
 */
export class RelationEditorView extends EventEmitter {
    constructor() {
        super();
        this._modalElement = null;
        this._sourceModel = null;
        this._targetModel = null;
        
        // Available cardinality options
        this._cardinalityOptions = [
            { value: '0,1', label: '0,1 (Zero or one)' },
            { value: '1,1', label: '1,1 (Exactly one)' },
            { value: '0,n', label: '0,n (Zero or many)' },
            { value: '1,n', label: '1,n (One or many)' },
            { value: 'n,n', label: 'n,n (Many to many)' }
        ];
    }

    /**
     * Show the relation editor modal
     * @param {Object} sourceModel - Source model data
     * @param {Object} targetModel - Target model data
     * @param {Object} existingRelation - Existing relation data for editing (optional)
     */
    show(sourceModel, targetModel, existingRelation = null) {
        this._sourceModel = sourceModel;
        this._targetModel = targetModel;
        
        // Create modal if it doesn't exist
        this._createModal(existingRelation);
        
        // Show modal
        if (this._modalElement) {
            this._modalElement.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    /**
     * Hide the modal
     */
    hide() {
        if (this._modalElement) {
            this._modalElement.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    /**
     * Create the modal element
     * @param {Object} existingRelation - Existing relation data for editing
     */
    _createModal(existingRelation) {
        // Remove existing modal if any
        if (this._modalElement) {
            this._modalElement.remove();
        }

        const sourceCardinality = existingRelation?.sourceCardinality || '1,1';
        const targetCardinality = existingRelation?.targetCardinality || '0,n';

        this._modalElement = document.createElement('div');
        this._modalElement.className = 'relation-modal-overlay';
        this._modalElement.innerHTML = `
            <div class="relation-modal">
                <div class="relation-modal-header">
                    <h3>🔗 Define Relation</h3>
                    <button class="relation-modal-close" type="button">&times;</button>
                </div>
                <div class="relation-modal-body">
                    <div class="relation-entities">
                        <div class="relation-entity source-entity">
                            <div class="entity-icon">📦</div>
                            <div class="entity-name">${this._escapeHtml(this._sourceModel?.modelName || 'Source')}</div>
                        </div>
                        <div class="relation-arrow">→</div>
                        <div class="relation-entity target-entity">
                            <div class="entity-icon">📦</div>
                            <div class="entity-name">${this._escapeHtml(this._targetModel?.modelName || 'Target')}</div>
                        </div>
                    </div>
                    
                    <div class="cardinality-section">
                        <div class="cardinality-field">
                            <label>Cardinality on <strong>${this._escapeHtml(this._sourceModel?.modelName || 'Source')}</strong></label>
                            <select id="source-cardinality">
                                ${this._renderCardinalityOptions(sourceCardinality)}
                            </select>
                            <small class="cardinality-hint">How many ${this._escapeHtml(this._sourceModel?.modelName || 'Source')} can be related</small>
                        </div>
                        
                        <div class="cardinality-field">
                            <label>Cardinality on <strong>${this._escapeHtml(this._targetModel?.modelName || 'Target')}</strong></label>
                            <select id="target-cardinality">
                                ${this._renderCardinalityOptions(targetCardinality)}
                            </select>
                            <small class="cardinality-hint">How many ${this._escapeHtml(this._targetModel?.modelName || 'Target')} can be related</small>
                        </div>
                    </div>
                    
                    <div class="relation-preview">
                        <div class="preview-label">Relation Preview:</div>
                        <div class="preview-text" id="relation-preview-text">
                            ${this._escapeHtml(this._sourceModel?.modelName || 'Source')} <span class="preview-cardinality">(${sourceCardinality})</span> 
                            ↔ 
                            <span class="preview-cardinality">(${targetCardinality})</span> ${this._escapeHtml(this._targetModel?.modelName || 'Target')}
                        </div>
                    </div>
                </div>
                <div class="relation-modal-footer">
                    <button id="cancel-relation-btn" class="btn btn-secondary" type="button">Cancel</button>
                    <button id="save-relation-btn" class="btn btn-primary" type="button">💾 Save Relation</button>
                </div>
            </div>
        `;

        document.body.appendChild(this._modalElement);
        this._bindEvents();
    }

    /**
     * Render cardinality options for select
     * @param {string} selected - Currently selected value
     * @returns {string} HTML options
     */
    _renderCardinalityOptions(selected) {
        return this._cardinalityOptions.map(opt => 
            `<option value="${opt.value}" ${opt.value === selected ? 'selected' : ''}>${opt.label}</option>`
        ).join('');
    }

    /**
     * Bind event listeners
     */
    _bindEvents() {
        // Close button
        const closeBtn = this._modalElement.querySelector('.relation-modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this._handleCancel());
        }

        // Cancel button
        const cancelBtn = this._modalElement.querySelector('#cancel-relation-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => this._handleCancel());
        }

        // Save button
        const saveBtn = this._modalElement.querySelector('#save-relation-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', () => this._handleSave());
        }

        // Close on overlay click
        this._modalElement.addEventListener('click', (e) => {
            if (e.target === this._modalElement) {
                this._handleCancel();
            }
        });

        // Update preview on cardinality change
        const sourceSelect = this._modalElement.querySelector('#source-cardinality');
        const targetSelect = this._modalElement.querySelector('#target-cardinality');

        if (sourceSelect) {
            sourceSelect.addEventListener('change', () => this._updatePreview());
        }
        if (targetSelect) {
            targetSelect.addEventListener('change', () => this._updatePreview());
        }

        // Close on Escape key
        this._handleKeyDown = (e) => {
            if (e.key === 'Escape') {
                this._handleCancel();
            }
        };
        document.addEventListener('keydown', this._handleKeyDown);
    }

    /**
     * Update the relation preview text
     */
    _updatePreview() {
        const sourceCardinality = this._modalElement.querySelector('#source-cardinality')?.value || '1,1';
        const targetCardinality = this._modalElement.querySelector('#target-cardinality')?.value || '0,n';
        const previewText = this._modalElement.querySelector('#relation-preview-text');
        
        if (previewText) {
            previewText.innerHTML = `
                ${this._escapeHtml(this._sourceModel?.modelName || 'Source')} <span class="preview-cardinality">(${sourceCardinality})</span> 
                ↔ 
                <span class="preview-cardinality">(${targetCardinality})</span> ${this._escapeHtml(this._targetModel?.modelName || 'Target')}
            `;
        }
    }

    /**
     * Handle save button click
     */
    _handleSave() {
        const sourceCardinality = this._modalElement.querySelector('#source-cardinality')?.value || '1,1';
        const targetCardinality = this._modalElement.querySelector('#target-cardinality')?.value || '0,n';

        const relationData = {
            sourceNodeId: this._sourceModel?.nodeId,
            targetNodeId: this._targetModel?.nodeId,
            sourceModelName: this._sourceModel?.modelName,
            targetModelName: this._targetModel?.modelName,
            sourceCardinality,
            targetCardinality
        };

        this.emit('save', { relationData });
        this._cleanup();
        this.hide();
    }

    /**
     * Handle cancel/close
     */
    _handleCancel() {
        this.emit('cancel');
        this._cleanup();
        this.hide();
    }

    /**
     * Cleanup event listeners and modal
     */
    _cleanup() {
        if (this._handleKeyDown) {
            document.removeEventListener('keydown', this._handleKeyDown);
            this._handleKeyDown = null;
        }
        if (this._modalElement) {
            this._modalElement.remove();
            this._modalElement = null;
        }
    }

    /**
     * Escape HTML to prevent XSS
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
