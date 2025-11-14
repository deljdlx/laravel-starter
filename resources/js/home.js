import './bootstrap';

import './home/tabulator';
import './home/echarts';
import './home/apex';
import './home/jsVectorMap';

import './home/theme';

document.addEventListener('DOMContentLoaded', () => {
  new TomSelect("select.tags",{
	  maxItems: 3
  });
});

