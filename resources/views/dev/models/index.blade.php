<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Model Inspector - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                                Model Inspector
                            </h2>
                            <div class="text-secondary mt-1">
                                Browse and inspect Eloquent models and database schema
                            </div>
                        </div>
                        <div class="col">
                            <a href="/dev/model-builder" class="btn btn-secondary">
                                Builder
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Available Models</h3>
                                    <div class="ms-auto">
                                        <span class="badge bg-blue-lt" id="model-count">Loading...</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table" id="models-table">
                                        <thead>
                                            <tr>
                                                <th>Model Name</th>
                                                <th>Table Name</th>
                                                <th>Primary Key</th>
                                                <th>Connection</th>
                                                <th>Timestamps</th>
                                                <th class="w-1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="models-tbody">
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                                    Loading models...
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Model Details Modal -->
    <div class="modal" id="model-details-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Model Details</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="text-center">
                        <div class="spinner-border" role="status"></div>
                        <p class="text-muted mt-2">Loading model details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop" id="modal-backdrop" style="display: none;"></div>

    <script>
        // API endpoints
        const API_BASE = '/dev/api/models';

        // Load all models on page load
        document.addEventListener('DOMContentLoaded', async () => {
            await loadModels();
        });

        /**
         * Load all models and populate the table
         */
        async function loadModels() {
            try {
                const response = await fetch(API_BASE);
                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.error || 'Failed to load models');
                }

                displayModels(data.models, data.count);
            } catch (error) {
                console.error('Error loading models:', error);
                showError('Failed to load models: ' + error.message);
            }
        }

        /**
         * Display models in the table
         */
        function displayModels(models, count) {
            const tbody = document.getElementById('models-tbody');
            const countBadge = document.getElementById('model-count');

            countBadge.textContent = `${count} model${count !== 1 ? 's' : ''}`;

            if (models.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-muted">No models found</td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = models.map(model => `
                <tr>
                    <td>
                        <strong>${escapeHtml(model.short_name)}</strong>
                        <div class="text-muted small">${escapeHtml(model.class)}</div>
                    </td>
                    <td>
                        <code>${escapeHtml(model.table)}</code>
                    </td>
                    <td>
                        <code>${escapeHtml(model.primary_key)}</code>
                    </td>
                    <td>
                        ${model.connection ? `<code>${escapeHtml(model.connection)}</code>` : '<span class="text-muted">default</span>'}
                    </td>
                    <td>
                        ${model.timestamps 
                            ? '<span class="badge bg-success-lt">Yes</span>' 
                            : '<span class="badge bg-secondary-lt">No</span>'}
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="showModelDetails('${escapeHtml(model.short_name)}')">
                            Details
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        /**
         * Show error message in the table
         */
        function showError(message) {
            const tbody = document.getElementById('models-tbody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger">${escapeHtml(message)}</td>
                </tr>
            `;
        }

        /**
         * Open the modal
         */
        function openModal() {
            const modal = document.getElementById('model-details-modal');
            const backdrop = document.getElementById('modal-backdrop');
            modal.style.display = 'block';
            backdrop.style.display = 'block';
            modal.classList.add('show');
            backdrop.classList.add('show');
            document.body.classList.add('modal-open');
        }

        /**
         * Close the modal
         */
        function closeModal() {
            const modal = document.getElementById('model-details-modal');
            const backdrop = document.getElementById('modal-backdrop');
            modal.style.display = 'none';
            backdrop.style.display = 'none';
            modal.classList.remove('show');
            backdrop.classList.remove('show');
            document.body.classList.remove('modal-open');
        }

        /**
         * Load and show details for a specific model
         */
        async function showModelDetails(modelName) {
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');

            modalTitle.textContent = `${modelName} - Details`;
            modalBody.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status"></div>
                    <p class="text-muted mt-2">Loading model details...</p>
                </div>
            `;

            openModal();

            try {
                const response = await fetch(`${API_BASE}/${encodeURIComponent(modelName)}`);
                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.error || 'Failed to load model details');
                }

                modalBody.innerHTML = renderModelDetails(data);
            } catch (error) {
                console.error('Error loading model details:', error);
                modalBody.innerHTML = `
                    <div class="alert alert-danger">
                        <strong>Error:</strong> ${escapeHtml(error.message)}
                    </div>
                `;
            }
        }

        /**
         * Render model details HTML
         */
        function renderModelDetails(model) {
            return `
                <!-- Basic Info -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Basic Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-5">Class:</dt>
                                    <dd class="col-7"><code>${escapeHtml(model.class)}</code></dd>
                                    <dt class="col-5">Table:</dt>
                                    <dd class="col-7"><code>${escapeHtml(model.table)}</code></dd>
                                    <dt class="col-5">Primary Key:</dt>
                                    <dd class="col-7"><code>${escapeHtml(model.primary_key)}</code></dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-5">Connection:</dt>
                                    <dd class="col-7">${model.connection ? `<code>${escapeHtml(model.connection)}</code>` : '<span class="text-muted">default</span>'}</dd>
                                    <dt class="col-5">Timestamps:</dt>
                                    <dd class="col-7">${model.timestamps ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-secondary">Disabled</span>'}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attributes -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Attributes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4 class="text-muted h5">Fillable</h4>
                                ${model.attributes.fillable.length > 0 
                                    ? `<ul class="list-unstyled">${model.attributes.fillable.map(attr => `<li><code>${escapeHtml(attr)}</code></li>`).join('')}</ul>`
                                    : '<p class="text-muted">No fillable attributes</p>'}
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4 class="text-muted h5">Guarded</h4>
                                ${model.attributes.guarded.length > 0 
                                    ? `<ul class="list-unstyled">${model.attributes.guarded.map(attr => `<li><code>${escapeHtml(attr)}</code></li>`).join('')}</ul>`
                                    : '<p class="text-muted">No guarded attributes</p>'}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4 class="text-muted h5">Hidden</h4>
                                ${model.attributes.hidden.length > 0 
                                    ? `<ul class="list-unstyled">${model.attributes.hidden.map(attr => `<li><code>${escapeHtml(attr)}</code></li>`).join('')}</ul>`
                                    : '<p class="text-muted">No hidden attributes</p>'}
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4 class="text-muted h5">Casts</h4>
                                ${model.attributes.casts.length > 0 
                                    ? `<ul class="list-unstyled">${model.attributes.casts.map(cast => `<li><code>${escapeHtml(cast.attribute)}</code>: <span class="badge bg-azure-lt">${escapeHtml(cast.type)}</span></li>`).join('')}</ul>`
                                    : '<p class="text-muted">No casts defined</p>'}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Relationships -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Relationships</h3>
                    </div>
                    <div class="card-body">
                        ${model.relationships.length > 0 ? `
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Related Model</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${model.relationships.map(rel => `
                                            <tr>
                                                <td><code>${escapeHtml(rel.name)}</code></td>
                                                <td><span class="badge bg-purple-lt">${escapeHtml(rel.type)}</span></td>
                                                <td><code>${escapeHtml(rel.related_model)}</code></td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                        ` : '<p class="text-muted">No relationships defined</p>'}
                    </div>
                </div>

                <!-- Database Schema -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Database Schema</h3>
                    </div>
                    <div class="card-body">
                        ${model.schema.error ? `
                            <div class="alert alert-warning">
                                ${escapeHtml(model.schema.error)}
                            </div>
                        ` : ''}
                        
                        ${model.schema.columns.length > 0 ? `
                            <h4 class="text-muted h5 mb-3">Columns</h4>
                            <div class="table-responsive mb-3">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Nullable</th>
                                            <th>Default</th>
                                            <th>Auto Increment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${model.schema.columns.map(col => `
                                            <tr>
                                                <td><code>${escapeHtml(col.name)}</code></td>
                                                <td><span class="badge bg-cyan-lt">${escapeHtml(col.type)}</span></td>
                                                <td>${col.nullable ? '<span class="badge bg-success-lt">Yes</span>' : '<span class="badge bg-secondary-lt">No</span>'}</td>
                                                <td>${col.default !== null ? `<code>${escapeHtml(String(col.default))}</code>` : '<span class="text-muted">NULL</span>'}</td>
                                                <td>${col.auto_increment ? '<span class="badge bg-primary-lt">Yes</span>' : '<span class="badge bg-secondary-lt">No</span>'}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                        ` : ''}

                        ${model.schema.indexes && model.schema.indexes.length > 0 ? `
                            <h4 class="text-muted h5 mb-3">Indexes</h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Columns</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${model.schema.indexes.map(idx => `
                                            <tr>
                                                <td><code>${escapeHtml(idx.name)}</code></td>
                                                <td><span class="badge ${idx.type === 'primary' ? 'bg-danger-lt' : idx.type === 'unique' ? 'bg-warning-lt' : 'bg-info-lt'}">${escapeHtml(idx.type)}</span></td>
                                                <td>${idx.columns.map(c => `<code>${escapeHtml(c)}</code>`).join(', ')}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        }

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
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }
    </script>
</body>
</html>
