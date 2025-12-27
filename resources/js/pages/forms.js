import '../bootstrap';
import '../home/theme';
import TomSelect from 'tom-select';

document.addEventListener('DOMContentLoaded', () => {
  new TomSelect("input.tags",{
	  maxItems: 3
  });
});
