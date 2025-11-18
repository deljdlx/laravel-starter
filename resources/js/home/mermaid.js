import mermaid from 'mermaid';

// Initialize Mermaid with configuration
mermaid.initialize({
  startOnLoad: true,
  theme: 'default',
  securityLevel: 'loose',
  themeVariables: {
    primaryColor: '#066fd1',
    primaryTextColor: '#fff',
    primaryBorderColor: '#044a8d',
    lineColor: '#0ca678',
    secondaryColor: '#e8f4fd',
    tertiaryColor: '#f5f7fb'
  }
});

export default mermaid;
