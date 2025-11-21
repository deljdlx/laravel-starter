<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schema Editor - Developer Tools</title>
    @vite(['resources/css/app.css', 'resources/js/schema-editor-drawflow.js'])
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

        #drawflow {
            flex: 1;
            position: relative;
            background: #f1f5f9;
        }
        
        /* Drawflow styling */
        .drawflow .parent-node {
            background: white;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .drawflow .parent-node.selected {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        

        .model-node-content {
            min-width: 220px;
        }

        .drawflow .drawflow-node {
            width: 300px;
        }
        
        .model-header {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9375rem;
        }
        
        .model-body {
            padding: 0;
            background: white;
        }
        
        .model-body .no-fields {
            padding: 1rem;
            text-align: center;
            color: #94a3b8;
            font-style: italic;
            font-size: 0.8125rem;
        }
        
        .model-body .field-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8125rem;
            transition: background-color 0.15s ease;
        }
        
        .model-body .field-item:hover {
            background-color: #f8fafc;
        }
        
        .model-body .field-item:last-child {
            border-bottom: none;
        }
        
        .model-body .field-name {
            font-weight: 600;
            color: #0f172a;
            font-family: 'Courier New', monospace;
        }
        
        .model-body .field-type-badge {
            color: #3b82f6;
            font-size: 0.75rem;
            font-weight: 500;
            background: #eff6ff;
            padding: 0.125rem 0.5rem;
            border-radius: 0.25rem;
        }
        
        .model-body .nullable-indicator {
            color: #f59e0b;
            font-weight: 700;
            font-size: 0.875rem;
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
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: pre-line;
            font-family: monospace;
            font-size: 0.875rem;
            line-height: 1.6;
        }

        /* Model fields container - HTML display */
        .model-fields-container {
            background: white;
            width: 100%;
        }

        .fields-separator {
            height: 1px;
            background: #e2e8f0;
            margin: 0;
        }

        .no-fields-message {
            padding: 0.75rem 1rem;
            color: #94a3b8;
            font-style: italic;
            font-size: 0.75rem;
            text-align: center;
        }

        .fields-list {
            padding: 0.5rem 0;
        }

        .field-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8125rem;
            transition: background-color 0.15s ease;
        }

        .field-item:hover {
            background-color: #f8fafc;
        }

        .field-item:last-child {
            border-bottom: none;
        }

        .field-name {
            font-weight: 600;
            color: #0f172a;
            font-family: 'Courier New', monospace;
        }

        .field-type {
            color: #3b82f6;
            font-size: 0.75rem;
            font-weight: 500;
            background: #eff6ff;
            padding: 0.125rem 0.375rem;
            border-radius: 0.25rem;
        }

        .field-nullable {
            color: #f59e0b;
            font-weight: 700;
            font-size: 0.875rem;
        }

        /* Custom Model Node Styling */
        .custom-model-node {
            background: white;
            border-radius: 6px;
            overflow: hidden;
            min-width: 220px;
        }

        .model-node-header {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9375rem;
        }

        .model-node-body {
            padding: 0;
        }

        .no-fields {
            padding: 1rem;
            text-align: center;
            color: #94a3b8;
            font-style: italic;
            font-size: 0.8125rem;
        }

        .fields-list {
            padding: 0;
        }

        .field-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8125rem;
            transition: background-color 0.15s ease;
        }

        .field-row:hover {
            background-color: #f8fafc;
        }

        .field-row:last-child {
            border-bottom: none;
        }

        .field-row .field-name {
            font-weight: 600;
            color: #0f172a;
            font-family: 'Courier New', monospace;
            flex-shrink: 0;
        }

        .field-row .field-type {
            color: #3b82f6;
            font-size: 0.75rem;
            font-weight: 500;
            background: #eff6ff;
            padding: 0.125rem 0.5rem;
            border-radius: 0.25rem;
            flex-shrink: 0;
        }

        .field-row .field-nullable {
            color: #f59e0b;
            font-weight: 700;
            font-size: 0.875rem;
            margin-left: auto;
        }

        /* Fields Control styling */
        .fields-control {
            width: 100%;
            background: white;
        }

        .fields-control .fields-separator {
            height: 1px;
            background: #e2e8f0;
            margin: 0;
        }

        .fields-control .no-fields {
            padding: 1rem;
            text-align: center;
            color: #94a3b8;
            font-style: italic;
            font-size: 0.8125rem;
        }

        .fields-control .fields-list {
            padding: 0;
        }

        .fields-control .field-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8125rem;
            transition: background-color 0.15s ease;
        }

        .fields-control .field-row:hover {
            background-color: #f8fafc;
        }

        .fields-control .field-row:last-child {
            border-bottom: none;
        }

        .fields-control .field-name {
            font-weight: 600;
            color: #0f172a;
            font-family: 'Courier New', monospace;
            flex-shrink: 0;
        }

        .fields-control .field-type {
            color: #3b82f6;
            font-size: 0.75rem;
            font-weight: 500;
            background: #eff6ff;
            padding: 0.125rem 0.5rem;
            border-radius: 0.25rem;
            flex-shrink: 0;
        }

        .fields-control .field-nullable {
            color: #f59e0b;
            font-weight: 700;
            font-size: 0.875rem;
            margin-left: auto;
        }

        /* Sockets in custom node */
        .rete-sockets {
            padding: 0.5rem;
        }

        .input-socket,
        .output-socket {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.25rem 0;
        }

        .socket-label {
            font-size: 0.75rem;
            color: #64748b;
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
