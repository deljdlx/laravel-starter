<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schema Editor - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/packages/schema-editor/scss/schema-editor.scss', 'resources/packages/schema-editor/js/SchemaEditor.js'])
</head>
<body>
    <div class="schema-editor-container">
        <!-- Header -->
        <div class="editor-header">
            <div>
                <h1>📊 Schema Editor</h1>
                <p class="subtitle">Visual database schema designer (Front-end V1 - No persistence)</p>
            </div>
            <div>
                <a href="/dev/models" class="btn btn-secondary btn-sm">
                    ← Back to Dev Tools
                </a>
            </div>
        </div>

        <!-- Main Editor Body -->
        <div class="editor-body">
            <!-- Left Panel: JSON Debug -->
            <div class="json-panel">
                <div class="json-panel-header">
                    📝 Schema JSON (Debug)
                </div>
                <div class="json-panel-body">
                    <div class="json-display" id="json-debug-panel">
{
  "models": []
}
                    </div>
                </div>
            </div>

            <!-- Center: Editor Canvas -->
            <div class="editor-canvas">
                <div class="canvas-toolbar">
                    <button id="add-model-btn" class="btn btn-primary btn-sm">
                        ➕ Add Model
                    </button>
                </div>
                <div id="drawflow"></div>
            </div>

            <!-- Right Panel: Properties -->
            <div class="properties-panel">
                <div class="properties-panel-header">
                    ⚙️ Properties
                </div>
                <div class="properties-panel-body" id="properties-panel">
                    <div class="empty-state">
                        <div class="empty-state-icon">📦</div>
                        <div>Select a model to view and edit its properties</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
