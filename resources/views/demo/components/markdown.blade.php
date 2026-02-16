<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown Renderer Demo</title>
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
</head>
<body>
    <div class="demo-container">
        <a href="{{ route('demo.components') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Demo Components
        </a>

        <header class="demo-header">
            <h1>Markdown Renderer</h1>
            <p>Interactive markdown editor with Mermaid diagram support</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Editor -->
            <div class="demo-section">
                <h2 class="demo-section-title">Editor</h2>
                <textarea 
                    id="markdown-input" 
                    class="w-full h-[600px] p-4 bg-gray-800 text-gray-100 rounded-lg border border-gray-700 font-mono text-sm resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write your markdown here...">
# Welcome to Markdown Renderer

This is a **rich markdown** editor with support for:

- **Bold** and *italic* text
- [Links](https://laravel.com)
- Code blocks
- Tables
- And **Mermaid diagrams**!

## Code Example

\`\`\`javascript
function hello() {
    console.log('Hello World!');
}
\`\`\`

## Mermaid Diagram

\`\`\`mermaid
graph TD
    A[Start] --> B{Is it working?}
    B -->|Yes| C[Great!]
    B -->|No| D[Debug]
    D --> B
    C --> E[End]
\`\`\`

## Table Example

| Feature | Status |
|---------|--------|
| Markdown | ✅ |
| Mermaid | ✅ |
| Syntax Highlighting | ✅ |

## Task List

- [x] Setup markdown parser
- [x] Add Mermaid support
- [ ] Add syntax highlighting
- [ ] Add export feature
                </textarea>
            </div>

            <!-- Preview -->
            <div class="demo-section">
                <h2 class="demo-section-title">Preview</h2>
                <div 
                    id="markdown-output" 
                    class="prose prose-invert max-w-none p-4 bg-gray-800 rounded-lg border border-gray-700 h-[600px] overflow-y-auto"
                ></div>
            </div>
        </div>

        <div class="mt-6 demo-section">
            <h3 class="text-lg font-semibold mb-2">Quick Actions</h3>
            <div class="flex gap-3">
                <button id="btn-clear" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Clear Editor
                </button>
                <button id="btn-load-sample" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Load Sample
                </button>
            </div>
        </div>
    </div>

    @vite(['resources/js/markdown.js'])
</body>
</html>
