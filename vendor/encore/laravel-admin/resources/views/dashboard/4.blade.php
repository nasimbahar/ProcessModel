 <div id="container4" style="height: <?php echo config('height');?>"></div>

<script>

Highcharts.chart('container4', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Income and Expense from last Five Months'
  },
  subtitle: {
    text: 'Income and Expense '
  },
  xAxis: {
    categories: ['Jan', 'fab','Mar','Aprial','May'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Income)',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ''
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
   credits: {
                enabled: false
            },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [ {
    name: 'Expenses',
    data: [814, 841, 3714, 727, 31]
  }, {
    name: 'Income',
    data: [1216, 1001, 4436, 738, 40]
  }]
});
</script>