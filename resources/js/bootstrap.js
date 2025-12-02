import axios from 'axios';


import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import '@tabler/core/dist/js/tabler.min.js';
// Import Tabler with custom variables instead of minified CSS
import "../css/tabler.scss";
// import "@tabler/core/dist/css/tabler.min.css";
// import "@tabler/core/dist/css/tabler-vendors.min.css";
// import "@fortawesome/fontawesome-free/css/all.min.css";


import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';
import 'tom-select/dist/css/tom-select.bootstrap5.css';

import 'tabulator-tables/dist/css/tabulator_bootstrap5.min.css';
import { TabulatorFull as Tabulator } from 'tabulator-tables';

import ApexCharts from 'apexcharts'


import jsVectorMap from 'jsvectormap'
import 'jsvectormap/dist/maps/world'


import * as echarts from 'echarts';



window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Tabulator = Tabulator;
window.ApexCharts = ApexCharts;
window.jsVectorMap = jsVectorMap;

window.TomSelect = TomSelect;

window.echarts = echarts;
