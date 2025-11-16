/**
 * Model Builder Application - OOP Implementation
 * 
 * This module handles the Model Builder UI functionality using object-oriented programming.
 */

/**
 * Configuration constants
 */
class ModelBuilderConfig {
    static COLUMN_TYPES = [
        'string', 'text', 'integer', 'bigInteger', 'float', 'decimal',
        'boolean', 'date', 'datetime', 'timestamp', 'json', 'binary'
    ];

    static RELATION_TYPES = [
        { value: 'belongsTo', label: 'Belongs To (One-to-One/Many)' },
        { value: 'hasOne', label: 'Has One' },
        { value: 'hasMany', label: 'Has Many (One-to-Many)' },
        { value: 'belongsToMany', label: 'Belongs To Many (Many-to-Many)' }
    ];

    static FOREIGN_KEY_ACTIONS = [
        'cascade', 'restrict', 'set null', 'no action'
    ];
}

/**
 * Utility class for common helper functions
 */
class Utils {
    /**
     * Escape HTML to prevent XSS
     */
    static escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    /**
     * Generate unique ID
     */
    static generateId() {
        return `id-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
    }
}

/**
 * AttributeRow class - Manages individual attribute rows
 */
class AttributeRow {
    constructor(container, availableModels, counter) {
        this.container = container;
        this.availableModels = availableModels;
        this.counter = counter;
        this.rowId = `attribute-${counter}`;
        this.element = null;
    }

    /**
     * Render the attribute row
     */
    render() {
        const row = document.createElement('div');
        row.className = 'attribute-row card mb-3';
        row.id = this.rowId;
        row.innerHTML = this.getTemplate();
        
        this.element = row;
        this.container.appendChild(row);
        this.attachEventListeners();
        
        return this;
    }

    /**
     * Get HTML template for the row
     */
    getTemplate() {
        return `
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Column Name <span class="text-muted small" id="column-name-hint-${this.rowId}">(optional for many-to-many)</span></label>
                        <input type="text" class="form-control form-control-sm" 
                               name="attributes[${this.counter}][name]" 
                               id="column-name-${this.rowId}"
                               placeholder="e.g., title"
                               pattern="[a-z_][a-z0-9_]*"
                               required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Type</label>
                        <select class="form-select form-select-sm" name="attributes[${this.counter}][type]" required>
                            ${ModelBuilderConfig.COLUMN_TYPES.map(type => `<option value="${type}">${type}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Index</label>
                        <select class="form-select form-select-sm" name="attributes[${this.counter}][index_type]">
                            <option value="none">None</option>
                            <option value="index">Index</option>
                            <option value="unique">Unique</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Options</label>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" 
                                       name="attributes[${this.counter}][nullable]">
                                <span class="form-check-label">Nullable</span>
                            </label>
                        </div>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input fk-toggle" type="checkbox" 
                                       name="attributes[${this.counter}][is_foreign_key]"
                                       data-row-id="${this.rowId}">
                                <span class="form-check-label">Foreign Key</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm w-100 remove-row-btn" data-row-id="${this.rowId}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                            Remove
                        </button>
                    </div>
                </div>

                <!-- Foreign key options (initially hidden) -->
                <div class="row fk-options" id="fk-options-${this.rowId}" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-info mt-2 mb-2">
                            <h4 class="alert-title">Foreign Key Configuration</h4>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Target Model</label>
                        <select class="form-select form-select-sm" name="attributes[${this.counter}][foreign_model]">
                            <option value="">Select model...</option>
                            ${this.availableModels.map(model => `<option value="${model}">${model}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Relation Type</label>
                        <select class="form-select form-select-sm relation-type-select" name="attributes[${this.counter}][relation_type]" data-row-id="${this.rowId}">
                            ${ModelBuilderConfig.RELATION_TYPES.map(type => `<option value="${type.value}">${type.label}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">ON DELETE</label>
                        <select class="form-select form-select-sm" name="attributes[${this.counter}][on_delete]">
                            ${ModelBuilderConfig.FOREIGN_KEY_ACTIONS.map(action => `<option value="${action}" ${action === 'cascade' ? 'selected' : ''}>${action}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">ON UPDATE</label>
                        <select class="form-select form-select-sm" name="attributes[${this.counter}][on_update]">
                            ${ModelBuilderConfig.FOREIGN_KEY_ACTIONS.map(action => `<option value="${action}" ${action === 'cascade' ? 'selected' : ''}>${action}</option>`).join('')}
                        </select>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Attach event listeners to row elements
     */
    attachEventListeners() {
        // FK toggle
        const fkToggle = this.element.querySelector('.fk-toggle');
        if (fkToggle) {
            fkToggle.addEventListener('change', () => this.toggleForeignKeyOptions());
        }

        // Relation type change
        const relationSelect = this.element.querySelector('.relation-type-select');
        if (relationSelect) {
            relationSelect.addEventListener('change', () => this.handleRelationTypeChange());
        }

        // Remove button
        const removeBtn = this.element.querySelector('.remove-row-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', () => this.remove());
        }
    }

    /**
     * Toggle foreign key options visibility
     */
    toggleForeignKeyOptions() {
        const fkOptions = document.getElementById(`fk-options-${this.rowId}`);
        const fkToggle = this.element.querySelector('.fk-toggle');
        if (fkOptions && fkToggle) {
            fkOptions.style.display = fkToggle.checked ? 'flex' : 'none';
        }
    }

    /**
     * Handle relation type change
     */
    handleRelationTypeChange() {
        const relationSelect = this.element.querySelector('.relation-type-select');
        const columnNameInput = document.getElementById(`column-name-${this.rowId}`);
        const columnNameHint = document.getElementById(`column-name-hint-${this.rowId}`);
        
        if (relationSelect && columnNameInput) {
            const relationType = relationSelect.value;
            
            if (relationType === 'belongsToMany') {
                columnNameInput.required = false;
                columnNameInput.placeholder = 'Leave empty for auto-generated pivot table';
                if (columnNameHint) {
                    columnNameHint.style.display = 'inline';
                }
            } else {
                columnNameInput.required = true;
                columnNameInput.placeholder = 'e.g., title';
                if (columnNameHint) {
                    columnNameHint.style.display = 'none';
                }
            }
        }
    }

    /**
     * Remove this row
     */
    remove() {
        if (this.element && this.element.parentNode) {
            this.element.remove();
        }
    }

    /**
     * Collect data from this row
     */
    collectData() {
        const inputs = this.element.querySelectorAll('input, select');
        const data = {};
        
        inputs.forEach(input => {
            const name = input.name.match(/\[([^\]]+)\]$/)?.[1];
            if (name) {
                if (input.type === 'checkbox') {
                    data[name] = input.checked;
                } else {
                    data[name] = input.value;
                }
            }
        });
        
        return data;
    }
}

/**
 * ConfirmationModal class - Manages the confirmation modal with code preview
 */
class ConfirmationModal {
    constructor() {
        this.modalElement = document.getElementById('confirmation-modal');
        this.tabsContainer = document.getElementById('preview-tabs');
        this.contentContainer = document.getElementById('preview-content');
        this.codeEditors = [];
        this.operations = [];
    }

    /**
     * Show modal with preview data
     */
    async show(preview) {
        this.operations = preview.operations;
        this.renderTabs();
        this.displayModal();
        await this.initializeEditors();
    }

    /**
     * Render tabs and content
     */
    renderTabs() {
        let tabsHtml = '';
        let contentHtml = '';
        
        this.operations.forEach((op, index) => {
            const icon = this.getIconForType(op.type);
            const tabId = `tab-${index}`;
            const active = index === 0 ? 'active' : '';
            
            // Tab header
            tabsHtml += `
                <li class="nav-item" role="presentation">
                    <button class="nav-link ${active}" id="${tabId}-tab" data-bs-toggle="tab" 
                            data-bs-target="#${tabId}" type="button" role="tab"
                            data-tab-index="${index}">
                        ${icon} ${Utils.escapeHtml(op.description)}
                    </button>
                </li>
            `;
            
            // Tab content
            contentHtml += `
                <div class="tab-pane fade ${active ? 'show active' : ''}" id="${tabId}" role="tabpanel">
                    <div class="mb-2">
                        <small class="text-muted">${Utils.escapeHtml(op.path)}</small>
                        ${op.note ? `<div class="text-info small">${Utils.escapeHtml(op.note)}</div>` : ''}
                    </div>
                    <textarea id="editor-${index}" class="form-control"></textarea>
                </div>
            `;
        });
        
        this.tabsContainer.innerHTML = tabsHtml;
        this.contentContainer.innerHTML = contentHtml;
        
        // Attach tab click listeners
        this.attachTabListeners();
    }

    /**
     * Get icon for operation type
     */
    getIconForType(type) {
        const icons = {
            'model': '📄',
            'migration': '🗄️',
            'pivot_migration': '🔗',
            'factory': '🏭'
        };
        return icons[type] || '📝';
    }

    /**
     * Display the modal
     */
    displayModal() {
        this.modalElement.classList.add('show');
        this.modalElement.style.display = 'block';
        document.body.classList.add('modal-open');
        
        // Add backdrop
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'modal-backdrop';
        document.body.appendChild(backdrop);
    }

    /**
     * Initialize CodeMirror editors
     */
    async initializeEditors() {
        return new Promise((resolve) => {
            setTimeout(() => {
                this.codeEditors = [];
                
                if (typeof CodeMirror !== 'undefined') {
                    this.operations.forEach((op, index) => {
                        const textArea = document.getElementById(`editor-${index}`);
                        if (textArea) {
                            try {
                                const editor = CodeMirror.fromTextArea(textArea, {
                                    mode: 'application/x-httpd-php',
                                    theme: 'monokai',
                                    lineNumbers: true,
                                    readOnly: true,
                                    lineWrapping: true,
                                    viewportMargin: Infinity
                                });
                                editor.setValue(op.source || '// No source available');
                                editor.setSize('100%', '400px');
                                this.codeEditors.push(editor);
                            } catch (error) {
                                console.error('Error initializing CodeMirror:', error);
                                this.fallbackToTextarea(textArea, op.source);
                            }
                        }
                    });
                    
                    // Refresh first editor
                    if (this.codeEditors.length > 0) {
                        this.codeEditors[0].refresh();
                    }
                } else {
                    console.warn('CodeMirror not loaded, using plain textareas');
                    this.operations.forEach((op, index) => {
                        const textArea = document.getElementById(`editor-${index}`);
                        if (textArea) {
                            this.fallbackToTextarea(textArea, op.source);
                        }
                    });
                }
                
                resolve();
            }, 100);
        });
    }

    /**
     * Fallback to styled textarea
     */
    fallbackToTextarea(textArea, source) {
        textArea.value = source || '// No source available';
        textArea.rows = 20;
        textArea.readOnly = true;
        textArea.style.fontFamily = 'monospace';
        textArea.style.fontSize = '12px';
        textArea.style.backgroundColor = '#272822';
        textArea.style.color = '#f8f8f2';
        textArea.style.padding = '10px';
        textArea.style.border = '1px solid #3e3d32';
    }

    /**
     * Attach tab click listeners
     */
    attachTabListeners() {
        const tabs = this.tabsContainer.querySelectorAll('.nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.tabIndex);
                this.activateTab(index);
            });
        });
    }

    /**
     * Activate tab and refresh editor
     */
    activateTab(index) {
        setTimeout(() => {
            if (this.codeEditors && this.codeEditors[index]) {
                this.codeEditors[index].refresh();
            }
        }, 50);
    }

    /**
     * Close the modal
     */
    close() {
        this.modalElement.classList.remove('show');
        this.modalElement.style.display = 'none';
        document.body.classList.remove('modal-open');
        
        const backdrop = document.getElementById('modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
        
        // Clean up CodeMirror editors
        this.cleanup();
    }

    /**
     * Cleanup editors
     */
    cleanup() {
        if (this.codeEditors && this.codeEditors.length > 0) {
            this.codeEditors.forEach(editor => {
                if (editor && typeof editor.toTextArea === 'function') {
                    try {
                        editor.toTextArea();
                    } catch (error) {
                        console.error('Error cleaning up CodeMirror editor:', error);
                    }
                }
            });
            this.codeEditors = [];
        }
    }
}

/**
 * ModelBuilderApp class - Main application controller
 */
class ModelBuilderApp {
    constructor(options = {}) {
        this.availableModels = options.availableModels || [];
        this.routes = options.routes || {};
        this.csrfToken = options.csrfToken || '';
        
        this.attributeCounter = 0;
        this.attributeRows = [];
        this.confirmationModal = new ConfirmationModal();
        this.pendingData = null;
        
        this.initializeElements();
        this.attachEventListeners();
        this.addInitialAttribute();
    }

    /**
     * Initialize DOM elements
     */
    initializeElements() {
        this.form = document.getElementById('model-builder-form');
        this.attributesContainer = document.getElementById('attributes-container');
        this.addAttributeBtn = document.getElementById('add-attribute-btn');
        this.submitBtn = document.getElementById('submit-btn');
        this.resultDiv = document.getElementById('result-messages');
        this.confirmBtn = document.getElementById('confirm-generation');
    }

    /**
     * Attach event listeners
     */
    attachEventListeners() {
        // Form submission
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }

        // Add attribute button
        if (this.addAttributeBtn) {
            this.addAttributeBtn.addEventListener('click', () => this.addAttribute());
        }

        // Confirm generation button
        if (this.confirmBtn) {
            this.confirmBtn.addEventListener('click', () => this.handleConfirmedGeneration());
        }

        // Modal close buttons
        const modal = document.getElementById('confirmation-modal');
        if (modal) {
            const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => this.confirmationModal.close());
            });
        }
    }

    /**
     * Add initial attribute row
     */
    addInitialAttribute() {
        this.addAttribute();
    }

    /**
     * Add new attribute row
     */
    addAttribute() {
        const row = new AttributeRow(
            this.attributesContainer,
            this.availableModels,
            this.attributeCounter++
        );
        row.render();
        this.attributeRows.push(row);
        return row;
    }

    /**
     * Handle form submission
     */
    async handleSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const data = this.collectFormData(formData);
        
        await this.showConfirmationModal(data);
    }

    /**
     * Collect form data
     */
    collectFormData(formData) {
        const data = {
            model_name: formData.get('model_name'),
            timestamps: formData.get('timestamps') === 'on',
            soft_deletes: formData.get('soft_deletes') === 'on',
            has_statuses: formData.get('has_statuses') === 'on',
            generate_migration: formData.get('generate_migration') === 'on',
            generate_factory: formData.get('generate_factory') === 'on',
            attributes: []
        };

        // Collect attributes from rows
        const attributeElements = document.querySelectorAll('.attribute-row');
        attributeElements.forEach((element) => {
            const inputs = element.querySelectorAll('input, select');
            const attr = {};
            
            inputs.forEach(input => {
                const name = input.name.match(/\[([^\]]+)\]$/)?.[1];
                if (name) {
                    if (input.type === 'checkbox') {
                        attr[name] = input.checked;
                    } else {
                        attr[name] = input.value;
                    }
                }
            });
            
            if (attr.name) {
                data.attributes.push(attr);
            }
        });

        return data;
    }

    /**
     * Show confirmation modal with preview
     */
    async showConfirmationModal(data) {
        try {
            const response = await fetch(this.routes.preview, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const preview = await response.json();
            this.pendingData = data;
            
            await this.confirmationModal.show(preview);
            
        } catch (error) {
            console.error('Error fetching preview:', error);
            alert('Failed to load preview. Please try again.');
        }
    }

    /**
     * Handle confirmed generation
     */
    async handleConfirmedGeneration() {
        if (!this.pendingData) return;
        
        this.confirmationModal.close();
        this.showLoading();
        this.clearMessages();

        try {
            const response = await fetch(this.routes.store, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.pendingData)
            });

            const result = await response.json();

            if (result.success) {
                this.showSuccess(result);
                this.resetForm();
            } else {
                this.showError(result.error || 'An error occurred while generating the model.');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showError(`Network Error: ${error.message}`);
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Show loading state
     */
    showLoading() {
        this.submitBtn.disabled = true;
        this.submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Generating...';
    }

    /**
     * Hide loading state
     */
    hideLoading() {
        this.submitBtn.disabled = false;
        this.submitBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Generate Model
        `;
    }

    /**
     * Clear result messages
     */
    clearMessages() {
        this.resultDiv.innerHTML = '';
    }

    /**
     * Show success message
     */
    showSuccess(result) {
        let filesHtml = '';
        for (const [type, value] of Object.entries(result.files)) {
            if (Array.isArray(value)) {
                value.forEach(path => {
                    filesHtml += `<li><strong>${type}:</strong> <code>${Utils.escapeHtml(path)}</code></li>`;
                });
            } else {
                filesHtml += `<li><strong>${type}:</strong> <code>${Utils.escapeHtml(value)}</code></li>`;
            }
        }
        
        this.resultDiv.innerHTML = `
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Success!</h4>
                        <div class="text-secondary">${Utils.escapeHtml(result.message)}</div>
                        <div class="mt-2">
                            <strong>Generated files:</strong>
                            <ul class="mb-0">
                                ${filesHtml}
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        `;
    }

    /**
     * Show error message
     */
    showError(message) {
        this.resultDiv.innerHTML = `
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Error!</h4>
                        <div class="text-secondary">${Utils.escapeHtml(message)}</div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        `;
    }

    /**
     * Reset form to initial state
     */
    resetForm() {
        this.form.reset();
        this.attributesContainer.innerHTML = '';
        this.attributeRows = [];
        this.attributeCounter = 0;
        this.addInitialAttribute();
    }
}

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ModelBuilderApp, ModelBuilderConfig, Utils };
}

// Global initialization function
window.initModelBuilder = function(options) {
    return new ModelBuilderApp(options);
};
