import './bootstrap';
import './home/theme';
import './home/mermaid';

document.addEventListener('DOMContentLoaded', () => {
  new TomSelect("select.tags",{
	  maxItems: 3
  });
});

