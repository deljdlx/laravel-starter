<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schema Editor - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/js/schema-editor.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
        }

        .schema-editor-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .editor-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .editor-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .editor-header .subtitle {
            margin: 0.25rem 0 0 0;
            font-size: 0.875rem;
            color: #64748b;
        }

        .editor-body {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* Left Panel - JSON Debug */
        .json-panel {
            width: 350px;
            background: #f8fafc;
            border-right: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .json-panel-header {
            padding: 1rem;
            background: white;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #1e293b;
        }

        .json-panel-body {
            flex: 1;
            overflow: auto;
            padding: 1rem;
        }

        .json-display {
            background: #1e293b;
            color: #e2e8f0;
            padding: 1rem;
            border-radius: 6px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
            overflow-x: auto;
            white-space: pre;
        }

        /* Center - Editor */
        .editor-canvas {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #f1f5f9;
        }

        .canvas-toolbar {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
            display: flex;
            gap: 0.5rem;
        }

        #rete-editor {
            flex: 1;
            position: relative;
            background: #f1f5f9;
        }

        /* Right Panel - Properties */
        .properties-panel {
            width: 350px;
            background: white;
            border-left: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .properties-panel-header {
            padding: 1rem;
            background: white;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #1e293b;
        }

        .properties-panel-body {
            flex: 1;
            overflow: auto;
            padding: 1rem;
        }

        .property-section {
            margin-bottom: 1.5rem;
        }

        .property-section-title {
            font-weight: 600;
            font-size: 0.875rem;
            color: #475569;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .property-field {
            margin-bottom: 1rem;
        }

        .property-field label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.25rem;
        }

        .property-field input,
        .property-field select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .property-field input:focus,
        .property-field select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .fields-list {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        .field-item {
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
        }

        .field-item:last-child {
            border-bottom: none;
        }

        .field-item:hover {
            background: #f8fafc;
        }

        .field-info {
            flex: 1;
            min-width: 0;
        }

        .field-name {
            font-weight: 500;
            font-size: 0.875rem;
            color: #1e293b;
        }

        .field-type {
            font-size: 0.75rem;
            color: #64748b;
        }

        .field-actions {
            display: flex;
            gap: 0.25rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        .btn-icon {
            padding: 0.375rem;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Rete.js custom styling */
        .rete-node {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            font-family: inherit;
        }

        .rete-node.selected {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .rete-title {
            font-weight: 600;
            color: #1e293b;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }
    </style>
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
                    <div class="json-display" id="json-display">
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
                <div id="rete-editor"></div>
            </div>

            <!-- Right Panel: Properties -->
            <div class="properties-panel">
                <div class="properties-panel-header">
                    ⚙️ Properties
                </div>
                <div class="properties-panel-body" id="properties-body">
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
