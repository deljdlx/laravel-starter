import axios from 'axios';

import '@tabler/core/dist/js/tabler.min.js';
import "@tabler/core/dist/css/tabler.min.css";
import "@tabler/core/dist/css/tabler-vendors.min.css";
// import "@fortawesome/fontawesome-free/css/all.min.css";



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


console.group('%cbootstrap.js :: 31 =============================', 'color: #932818; font-size: 1rem');
console.log(echarts);
console.groupEnd();

window.echarts = echarts;
