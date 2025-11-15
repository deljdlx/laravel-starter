<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Model Builder - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CodeMirror for syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/clike/clike.min.js"></script>
</head>
<body>
    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Model Builder
                            </h2>
                            <div class="text-secondary mt-1">
                                Generate Eloquent models with migrations and factories
                            </div>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <a href="/dev/models" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                                Model Inspector
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <form id="model-builder-form">
                        <div class="row">
                            <!-- Left column: Basic Configuration -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Model Configuration</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label required">Model Name</label>
                                            <input type="text" class="form-control" name="model_name" id="model_name" 
                                                   placeholder="e.g., Product" required
                                                   pattern="[A-Z][a-zA-Z0-9]*"
                                                   title="Must start with uppercase letter, no spaces or special characters">
                                            <small class="form-hint">Use PascalCase (e.g., Product, OrderItem)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Timestamps</label>
                                            <label class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="timestamps" checked>
                                                <span class="form-check-label">Include created_at/updated_at</span>
                                            </label>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Soft Deletes</label>
                                            <label class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="soft_deletes">
                                                <span class="form-check-label">Enable soft deletes</span>
                                            </label>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Model Status</label>
                                            <label class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="has_statuses">
                                                <span class="form-check-label">Enable Spatie HasStatuses trait</span>
                                            </label>
                                            <small class="form-hint">Allows tracking model statuses</small>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <label class="form-label">Generation Options</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="generate_migration" id="generate_migration" checked>
                                                <label class="form-check-label" for="generate_migration">
                                                    Generate Migration
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="generate_factory" id="generate_factory" checked>
                                                <label class="form-check-label" for="generate_factory">
                                                    Generate Factory
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right column: Attributes -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Model Attributes</h3>
                                        <div class="ms-auto">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="addAttributeRow()">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Add Attribute
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="attributes-container">
                                            <!-- Attributes will be added here dynamically -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" id="submit-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        Generate Model
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Result messages -->
                    <div id="result-messages" class="mt-3"></div>

                    <!-- Confirmation Modal -->
                    <div class="modal modal-blur fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Model Generation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h3 class="text-muted h5">Preview of files to be generated:</h3>
                                    </div>
                                    
                                    <!-- Tabs for file preview -->
                                    <ul class="nav nav-tabs mb-3" id="preview-tabs" role="tablist"></ul>
                                    <div class="tab-content" id="preview-content" style="max-height: 500px; overflow-y: auto;"></div>
                                    
                                    <div class="alert alert-info mt-3 mb-0">
                                        <strong>Note:</strong> Make sure to review the generated files and run migrations if needed.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="confirm-generation">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                        Confirm & Generate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Available models for foreign key references
        const availableModels = @json($models);
        
        // Column types
        const columnTypes = [
            'string',
            'text',
            'integer',
            'bigInteger',
            'float',
            'decimal',
            'boolean',
            'date',
            'datetime',
            'timestamp',
            'json',
            'binary'
        ];

        // Relation types with labels
        const relationTypes = [
            { value: 'belongsTo', label: 'Belongs To (One-to-One/Many)' },
            { value: 'hasOne', label: 'Has One' },
            { value: 'hasMany', label: 'Has Many (One-to-Many)' },
            { value: 'belongsToMany', label: 'Belongs To Many (Many-to-Many)' }
        ];

        // Foreign key actions
        const foreignKeyActions = [
            'cascade',
            'restrict',
            'set null',
            'no action'
        ];

        let attributeCounter = 0;

        // Initialize with one attribute row
        document.addEventListener('DOMContentLoaded', () => {
            addAttributeRow();
        });

        /**
         * Escape HTML to prevent XSS
         */
        function escapeHtml(text) {
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
         * Add a new attribute row
         */
        function addAttributeRow() {
            const container = document.getElementById('attributes-container');
            const rowId = `attribute-${attributeCounter++}`;
            
            const row = document.createElement('div');
            row.className = 'attribute-row card mb-3';
            row.id = rowId;
            row.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Column Name <span class="text-muted small" id="column-name-hint-${rowId}">(optional for many-to-many)</span></label>
                            <input type="text" class="form-control form-control-sm" 
                                   name="attributes[${attributeCounter}][name]" 
                                   id="column-name-${rowId}"
                                   placeholder="e.g., title"
                                   pattern="[a-z_][a-z0-9_]*"
                                   required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Type</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][type]" required>
                                ${columnTypes.map(type => `<option value="${type}">${type}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label">Index</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][index_type]">
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
                                           name="attributes[${attributeCounter}][nullable]">
                                    <span class="form-check-label">Nullable</span>
                                </label>
                            </div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input fk-toggle" type="checkbox" 
                                           name="attributes[${attributeCounter}][is_foreign_key]"
                                           onchange="toggleForeignKeyOptions('${rowId}', this.checked)">
                                    <span class="form-check-label">Foreign Key</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm w-100" onclick="removeAttributeRow('${rowId}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                                Remove
                            </button>
                        </div>
                    </div>

                    <!-- Foreign key options (initially hidden) -->
                    <div class="row fk-options" id="fk-options-${rowId}" style="display: none;">
                        <div class="col-12">
                            <div class="alert alert-info mt-2 mb-2">
                                <h4 class="alert-title">Foreign Key Configuration</h4>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Target Model</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][foreign_model]">
                                <option value="">Select model...</option>
                                ${availableModels.map(model => `<option value="${model}">${model}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Relation Type</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][relation_type]" onchange="handleRelationTypeChange(this, '${rowId}')">
                                ${relationTypes.map(type => `<option value="${type.value}">${type.label}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">ON DELETE</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][on_delete]">
                                ${foreignKeyActions.map(action => `<option value="${action}" ${action === 'cascade' ? 'selected' : ''}>${action}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">ON UPDATE</label>
                            <select class="form-select form-select-sm" name="attributes[${attributeCounter}][on_update]">
                                ${foreignKeyActions.map(action => `<option value="${action}" ${action === 'cascade' ? 'selected' : ''}>${action}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                </div>
            `;
            
            container.appendChild(row);
        }

        /**
         * Remove an attribute row
         */
        function removeAttributeRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.remove();
            }
        }

        /**
         * Handle relation type change - make column name optional for many-to-many
         */
        function handleRelationTypeChange(selectElement, rowId) {
            const relationType = selectElement.value;
            const columnNameInput = document.getElementById(`column-name-${rowId}`);
            const columnNameHint = document.getElementById(`column-name-hint-${rowId}`);
            
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

        /**
         * Toggle foreign key options visibility
         */
        function toggleForeignKeyOptions(rowId, show) {
            const fkOptions = document.getElementById(`fk-options-${rowId}`);
            if (fkOptions) {
                fkOptions.style.display = show ? 'flex' : 'none';
            }
        }

        /**
         * Handle form submission - show confirmation first
         */
        document.getElementById('model-builder-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(e.target);
            const data = collectFormData(formData);
            
            // Show confirmation modal with preview
            await showConfirmationModal(data);
        });

        /**
         * Collect form data into structured object
         */
        function collectFormData(formData) {
            const data = {
                model_name: formData.get('model_name'),
                timestamps: formData.get('timestamps') === 'on',
                soft_deletes: formData.get('soft_deletes') === 'on',
                has_statuses: formData.get('has_statuses') === 'on',
                generate_migration: formData.get('generate_migration') === 'on',
                generate_factory: formData.get('generate_factory') === 'on',
                attributes: []
            };

            // Collect attributes
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
        async function showConfirmationModal(data) {
            try {
                // Fetch preview from server
                const response = await fetch('{{ route('dev.model-builder.preview') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const preview = await response.json();
                
                // Build tabs
                const tabsContainer = document.getElementById('preview-tabs');
                const contentContainer = document.getElementById('preview-content');
                
                let tabsHtml = '';
                let contentHtml = '';
                
                preview.operations.forEach((op, index) => {
                    const icon = op.type === 'model' ? '📄' : op.type === 'migration' ? '🗄️' : op.type === 'pivot_migration' ? '🔗' : '🏭';
                    const tabId = `tab-${index}`;
                    const active = index === 0 ? 'active' : '';
                    
                    // Tab header
                    tabsHtml += `
                        <li class="nav-item" role="presentation">
                            <button class="nav-link ${active}" id="${tabId}-tab" data-bs-toggle="tab" 
                                    data-bs-target="#${tabId}" type="button" role="tab"
                                    onclick="activateTab('${tabId}')">
                                ${icon} ${escapeHtml(op.description)}
                            </button>
                        </li>
                    `;
                    
                    // Tab content
                    contentHtml += `
                        <div class="tab-pane fade ${active ? 'show active' : ''}" id="${tabId}" role="tabpanel">
                            <div class="mb-2">
                                <small class="text-muted">${escapeHtml(op.path)}</small>
                                ${op.note ? `<div class="text-info small">${escapeHtml(op.note)}</div>` : ''}
                            </div>
                            <textarea id="editor-${index}" class="form-control"></textarea>
                        </div>
                    `;
                });
                
                tabsContainer.innerHTML = tabsHtml;
                contentContainer.innerHTML = contentHtml;
                
                // Store data for later use
                window.pendingGenerationData = data;
                window.previewOperations = preview.operations;
                
                // Show modal using data attribute
                const modalElement = document.getElementById('confirmation-modal');
                modalElement.classList.add('show');
                modalElement.style.display = 'block';
                document.body.classList.add('modal-open');
                
                // Add backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'modal-backdrop';
                document.body.appendChild(backdrop);
                
                // Initialize CodeMirror editors after modal is shown
                setTimeout(() => {
                    window.codeEditors = [];
                    preview.operations.forEach((op, index) => {
                        const editor = CodeMirror.fromTextArea(document.getElementById(`editor-${index}`), {
                            mode: 'application/x-httpd-php',
                            theme: 'monokai',
                            lineNumbers: true,
                            readOnly: true,
                            lineWrapping: true,
                            viewportMargin: Infinity
                        });
                        editor.setValue(op.source || '// No source available');
                        editor.setSize('100%', '400px');
                        window.codeEditors.push(editor);
                    });
                    
                    // Refresh the first editor to ensure proper display
                    if (window.codeEditors.length > 0) {
                        window.codeEditors[0].refresh();
                    }
                }, 100);
                
            } catch (error) {
                console.error('Error fetching preview:', error);
                alert('Failed to load preview. Please try again.');
            }
        }

        /**
         * Activate tab and refresh CodeMirror
         */
        function activateTab(tabId) {
            const index = parseInt(tabId.split('-')[1]);
            setTimeout(() => {
                if (window.codeEditors && window.codeEditors[index]) {
                    window.codeEditors[index].refresh();
                }
            }, 50);
        }

        /**
         * Close modal
         */
        function closeModal() {
            const modalElement = document.getElementById('confirmation-modal');
            modalElement.classList.remove('show');
            modalElement.style.display = 'none';
            document.body.classList.remove('modal-open');
            
            const backdrop = document.getElementById('modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Clean up CodeMirror editors
            if (window.codeEditors) {
                window.codeEditors.forEach(editor => {
                    editor.toTextArea();
                });
                window.codeEditors = [];
            }
        }
        
        // Add close handlers for the modal
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('confirmation-modal');
            const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', closeModal);
            });
        });

        /**
         * Handle confirmed generation
         */
        document.getElementById('confirm-generation').addEventListener('click', async () => {
            const data = window.pendingGenerationData;
            if (!data) return;
            
            // Close modal
            closeModal();
            
            const submitBtn = document.getElementById('submit-btn');
            const resultDiv = document.getElementById('result-messages');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Generating...';
            
            // Clear previous messages
            resultDiv.innerHTML = '';

            try {
                const response = await fetch('{{ route('dev.model-builder.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    let filesHtml = '';
                    for (const [type, value] of Object.entries(result.files)) {
                        if (Array.isArray(value)) {
                            value.forEach(path => {
                                filesHtml += `<li><strong>${type}:</strong> <code>${escapeHtml(path)}</code></li>`;
                            });
                        } else {
                            filesHtml += `<li><strong>${type}:</strong> <code>${escapeHtml(value)}</code></li>`;
                        }
                    }
                    
                    resultDiv.innerHTML = `
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <div>
                                    <h4 class="alert-title">Success!</h4>
                                    <div class="text-secondary">${escapeHtml(result.message)}</div>
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
                    
                    // Reset form
                    document.getElementById('model-builder-form').reset();
                    document.getElementById('attributes-container').innerHTML = '';
                    addAttributeRow();
                } else {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                                </div>
                                <div>
                                    <h4 class="alert-title">Error!</h4>
                                    <div class="text-secondary">${result.error || 'An error occurred while generating the model.'}</div>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                resultDiv.innerHTML = `
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                <h4 class="alert-title">Network Error!</h4>
                                <div class="text-secondary">${error.message}</div>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                `;
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Generate Model
                `;
            }
        });
    </script>
</body>
</html>
