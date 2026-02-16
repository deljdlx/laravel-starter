import { marked } from 'marked';
import { markedHighlight } from 'marked-highlight';
import Prism from 'prismjs';
import 'prismjs/themes/prism-tomorrow.css';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-python';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-json';
import 'prismjs/components/prism-markdown';
import mermaid from 'mermaid';

// Initialize Mermaid with dark theme
mermaid.initialize({
    startOnLoad: false,
    theme: 'dark',
    securityLevel: 'loose',
    fontFamily: 'ui-sans-serif, system-ui, sans-serif',
});

// Configure marked with syntax highlighting
marked.use(markedHighlight({
    langPrefix: 'language-',
    highlight(code, lang) {
        if (lang && Prism.languages[lang]) {
            return Prism.highlight(code, Prism.languages[lang], lang);
        }
        return code;
    }
}));

// Configure marked for GitHub-flavored markdown
marked.setOptions({
    gfm: true,
    breaks: true,
    headerIds: true,
    mangle: false,
});

class MarkdownRenderer {
    constructor(inputSelector, outputSelector) {
        this.input = document.querySelector(inputSelector);
        this.output = document.querySelector(outputSelector);
        this.mermaidCounter = 0;
        
        this.init();
    }

    init() {
        if (!this.input || !this.output) {
            console.error('Markdown renderer: Input or output element not found');
            return;
        }

        // Initial render
        this.render();

        // Listen for input changes
        this.input.addEventListener('input', () => this.render());
    }

    async render() {
        try {
            const markdown = this.input.value;
            
            // Reset mermaid counter
            this.mermaidCounter = 0;
            
            // Process mermaid code blocks
            const processedMarkdown = await this.processMermaidBlocks(markdown);
            
            // Convert markdown to HTML
            const html = marked.parse(processedMarkdown);
            
            // Update output
            this.output.innerHTML = html;
            
            // Render mermaid diagrams
            await this.renderMermaidDiagrams();
            
        } catch (error) {
            console.error('Markdown rendering error:', error);
            this.output.innerHTML = `<div class="text-red-400 p-4">Error rendering markdown: ${error.message}</div>`;
        }
    }

    async processMermaidBlocks(markdown) {
        // Replace mermaid code blocks with placeholder divs
        return markdown.replace(/```mermaid\n([\s\S]*?)```/g, (match, code) => {
            const id = `mermaid-diagram-${this.mermaidCounter++}`;
            return `<div class="mermaid-diagram" data-diagram="${this.escapeHtml(code.trim())}" id="${id}"></div>`;
        });
    }

    async renderMermaidDiagrams() {
        const diagrams = this.output.querySelectorAll('.mermaid-diagram');
        
        for (const diagram of diagrams) {
            try {
                const code = diagram.getAttribute('data-diagram');
                const id = diagram.id;
                
                // Render mermaid diagram
                const { svg } = await mermaid.render(`${id}-svg`, code);
                
                // Insert SVG
                diagram.innerHTML = svg;
                diagram.classList.add('flex', 'justify-center', 'my-4');
                
            } catch (error) {
                console.error('Mermaid rendering error:', error);
                diagram.innerHTML = `<div class="text-red-400 p-4 border border-red-400 rounded">Mermaid Error: ${error.message}</div>`;
            }
        }
    }

    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    clear() {
        this.input.value = '';
        this.render();
    }

    loadSample() {
        const sample = `# Advanced Markdown Demo

## Typography

This is **bold text** and this is *italic text*.
You can also use ~~strikethrough~~ and \`inline code\`.

> This is a blockquote.
> It can span multiple lines.

## Lists

### Unordered List
- Item 1
- Item 2
  - Nested item 2.1
  - Nested item 2.2
- Item 3

### Ordered List
1. First item
2. Second item
3. Third item

### Task List
- [x] Completed task
- [ ] Pending task
- [ ] Another pending task

## Code Blocks

\`\`\`javascript
// JavaScript example
class User {
    constructor(name) {
        this.name = name;
    }
    
    greet() {
        return \`Hello, \${this.name}!\`;
    }
}

const user = new User('Alice');
console.log(user.greet());
\`\`\`

\`\`\`php
<?php
// PHP example
class User {
    private string $name;
    
    public function __construct(string $name) {
        $this->name = $name;
    }
    
    public function greet(): string {
        return "Hello, {$this->name}!";
    }
}
\`\`\`

## Tables

| Feature | Support | Notes |
|---------|---------|-------|
| Markdown | ✅ | Full GFM support |
| Mermaid | ✅ | Diagrams & flowcharts |
| Tables | ✅ | GitHub-style |
| Task Lists | ✅ | Interactive checkboxes |
| Emoji | ✅ | :rocket: :fire: :heart: |

## Mermaid Diagrams

### Flowchart
\`\`\`mermaid
graph TB
    Start[Start] --> Input[Get User Input]
    Input --> Validate{Valid?}
    Validate -->|Yes| Process[Process Data]
    Validate -->|No| Error[Show Error]
    Error --> Input
    Process --> Save[Save to DB]
    Save --> Success[Show Success]
    Success --> End[End]
\`\`\`

### Sequence Diagram
\`\`\`mermaid
sequenceDiagram
    participant User
    participant Browser
    participant Server
    participant Database
    
    User->>Browser: Click Submit
    Browser->>Server: POST /api/data
    Server->>Database: INSERT query
    Database-->>Server: Success
    Server-->>Browser: 200 OK
    Browser-->>User: Show Success
\`\`\`

### Class Diagram
\`\`\`mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +login()
        +logout()
    }
    
    class Post {
        +int id
        +string title
        +string content
        +publish()
    }
    
    User "1" --> "*" Post : writes
\`\`\`

### Gantt Chart
\`\`\`mermaid
gantt
    title Project Timeline
    dateFormat YYYY-MM-DD
    section Planning
    Requirements    :a1, 2024-01-01, 7d
    Design         :a2, after a1, 5d
    section Development
    Backend        :b1, after a2, 14d
    Frontend       :b2, after a2, 14d
    section Testing
    Testing        :c1, after b1, 7d
    Deployment     :c2, after c1, 2d
\`\`\`

## Links

- [Laravel Documentation](https://laravel.com/docs)
- [Markdown Guide](https://www.markdownguide.org)
- [Mermaid Documentation](https://mermaid.js.org)

---

**Made with ❤️ using Laravel + Blade + Marked + Mermaid**
`;
        this.input.value = sample;
        this.render();
    }
}

// Initialize renderer when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const renderer = new MarkdownRenderer('#markdown-input', '#markdown-output');
    
    // Setup buttons
    document.getElementById('btn-clear')?.addEventListener('click', () => {
        renderer.clear();
    });
    
    document.getElementById('btn-load-sample')?.addEventListener('click', () => {
        renderer.loadSample();
    });
});
