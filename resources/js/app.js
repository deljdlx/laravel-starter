import './bootstrap';
import './home/theme';
import './home/mermaid';

document.addEventListener('DOMContentLoaded', () => {
  new TomSelect("select.tags",{
	  maxItems: 3
  });
});


// Alpine.js
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()
