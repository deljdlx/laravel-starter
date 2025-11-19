<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rete.js Demo - Visual Node Editor</title>
    @vite(['resources/css/app.css', 'resources/js/retejs-demo.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 2rem;
        }

        .header h1 {
            margin: 0;
            color: #333;
            font-size: 2rem;
            font-weight: 600;
        }

        .header p {
            margin: 0.5rem 0 0 0;
            color: #666;
            font-size: 1rem;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 2rem;
        }

        .editor-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .editor-header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 500;
            font-size: 1.1rem;
        }

        #rete-editor {
            flex: 1;
            min-height: 500px;
            position: relative;
            background: #f8f9fa;
        }

        .info-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-panel h2 {
            margin: 0 0 1rem 0;
            color: #333;
            font-size: 1.3rem;
        }

        .info-panel ul {
            margin: 0.5rem 0;
            padding-left: 1.5rem;
            color: #555;
        }

        .info-panel li {
            margin: 0.5rem 0;
        }

        /* Rete.js node styles */
        .rete-node {
            background: white;
            border: 2px solid #667eea;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            min-width: 180px;
        }

        .rete-node.selected {
            border-color: #764ba2;
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.3);
        }

        .rete-title {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 8px;
            text-align: center;
            font-size: 14px;
        }

        .rete-socket {
            background: #667eea;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .rete-connection path {
            stroke: #667eea;
            stroke-width: 2px;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎨 Rete.js Demo - Visual Node Editor</h1>
        <p>An interactive node-based editor for visual programming</p>
        <a href="/" class="back-link">← Back to Home</a>
    </div>

    <div class="container">
        <div class="editor-wrapper">
            <div class="editor-header">
                Node Editor Canvas
            </div>
            <div id="rete-editor"></div>
        </div>

        <div class="info-panel">
            <h2>📝 About this Demo</h2>
            <p>This is a demonstration of <strong>Rete.js</strong>, a powerful framework for creating visual node-based editors. The demo shows a simple mathematical calculation flow:</p>
            <ul>
                <li><strong>Number Nodes:</strong> Input values (default 5 and 3)</li>
                <li><strong>Add Node:</strong> Adds two numbers together</li>
                <li><strong>Display Node:</strong> Shows the result (5 + 3 = 8)</li>
            </ul>
            <p><strong>Interactions:</strong></p>
            <ul>
                <li>Drag nodes to rearrange them</li>
                <li>Click and drag from output sockets to create connections</li>
                <li>Change values in the Number nodes to see the result update</li>
                <li>Zoom with mouse wheel, pan by dragging the canvas</li>
            </ul>
        </div>
    </div>
</body>
</html>
