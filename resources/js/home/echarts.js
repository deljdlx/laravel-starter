import * as echarts from 'echarts';

document.addEventListener('DOMContentLoaded', function () {
  const myChart1 = echarts.init(
    document.querySelector('#echarts-example-00')
  );
  myChart1.setOption({
    title: {
      text: 'ECharts Getting Started Example'
    },
    tooltip: {},
    xAxis: {
      data: ['shirt', 'cardigan', 'chiffon', 'pants', 'heels', 'socks']
    },
    yAxis: {},
    series: [{
      name: 'sales',
      type: 'bar',
      data: [5, 20, 36, 10, 10, 20]
    }]
  });

  // =========================== Example 2 ===========================
  const myChart2 = echarts.init(
    document.querySelector('#echarts-example-01')
  );

  myChart2.setOption({
    tooltip: {
      trigger: 'item'
    },
    legend: {
      top: '5%',
      left: 'center'
    },
    series: [{
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [{
        value: 1048,
        name: 'Search Engine'
      },
      {
        value: 735,
        name: 'Direct'
      },
      {
        value: 580,
        name: 'Email'
      },
      {
        value: 484,
        name: 'Union Ads'
      },
      {
        value: 300,
        name: 'Video Ads'
      }
      ]
    }]
  });

});