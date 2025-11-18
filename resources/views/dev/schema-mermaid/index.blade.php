<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Database Schema - Mermaid Diagram</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
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
                                Database Schema
                            </h2>
                            <div class="text-secondary mt-1">
                                Interactive ER diagram generated from the database schema using Mermaid
                            </div>
                        </div>
                        <div class="col-auto ms-auto">
                            <a href="/dev/models" class="btn btn-secondary">
                                Model Inspector
                            </a>
                            <a href="/dev/model-builder" class="btn btn-secondary">
                                Model Builder
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
                                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="diagram-tab" data-bs-toggle="tab" href="#diagram" role="tab" aria-controls="diagram" aria-selected="true">
                                                Diagram
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="code-tab" data-bs-toggle="tab" href="#code" role="tab" aria-controls="code" aria-selected="false">
                                                Mermaid Code
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="ms-auto">
                                        <button class="btn btn-sm btn-primary" onclick="copyToClipboard()">
                                            Copy Mermaid Code
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- Diagram Tab -->
                                        <div class="tab-pane fade show active" id="diagram" role="tabpanel" aria-labelledby="diagram-tab">
                                            <div class="text-center">
                                                <pre class="mermaid">{{ $mermaidCode }}</pre>
                                            </div>
                                        </div>
                                        
                                        <!-- Code Tab -->
                                        <div class="tab-pane fade" id="code" role="tabpanel" aria-labelledby="code-tab">
                                            <pre class="border rounded p-3" style="background-color: #f8f9fa;"><code id="mermaid-code">{{ $mermaidCode }}</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Information Card -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">About This Diagram</h3>
                                </div>
                                <div class="card-body">
                                    <p>This Entity-Relationship diagram is automatically generated from your database schema. It shows:</p>
                                    <ul>
                                        <li><strong>Tables</strong>: All tables in your database (excluding system tables)</li>
                                        <li><strong>Columns</strong>: Column names and types</li>
                                        <li><strong>Keys</strong>:
                                            <ul>
                                                <li><code>PK</code> - Primary Key</li>
                                                <li><code>FK</code> - Foreign Key</li>
                                                <li><code>UK</code> - Unique Key</li>
                                            </ul>
                                        </li>
                                        <li><strong>Relationships</strong>: Foreign key relationships showing "has many" associations</li>
                                    </ul>
                                    <p class="mb-0">The diagram is interactive - you can zoom and pan to explore the schema.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * Copy Mermaid code to clipboard
         */
        function copyToClipboard() {
            const code = document.getElementById('mermaid-code').textContent;
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(code).then(() => {
                    alert('Mermaid code copied to clipboard!');
                }).catch(err => {
                    console.error('Failed to copy:', err);
                    fallbackCopy(code);
                });
            } else {
                fallbackCopy(code);
            }
        }

        /**
         * Fallback copy method for older browsers
         */
        function fallbackCopy(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.top = '0';
            textarea.style.left = '0';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            
            try {
                document.execCommand('copy');
                alert('Mermaid code copied to clipboard!');
            } catch (err) {
                alert('Failed to copy to clipboard. Please copy manually.');
            }
            
            document.body.removeChild(textarea);
        }
    </script>
</body>
</html>
