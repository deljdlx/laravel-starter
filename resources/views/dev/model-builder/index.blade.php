<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Model Builder - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/model-builder.js', 'resources/js/model-builder-app.js'])
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
        // Initialize Model Builder application using OOP architecture
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize the Model Builder App with configuration
            window.modelBuilderApp = window.initModelBuilder({
                availableModels: @json($models),
                previewRoute: '{{ route('dev.model-builder.preview') }}',
                storeRoute: '{{ route('dev.model-builder.store') }}',
                csrfToken: document.querySelector('meta[name="csrf-token"]').content
            });
        });
    </script>
</body>
</html>
