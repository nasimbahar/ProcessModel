<div id="container3" style="height: <?php echo config('height');?>"></div>
<script>
Highcharts.chart('container3', {
    chart: {
        type: 'packedbubble',
       
    },
    title: {
        text: 'Income and Expenses based on Types '
    },
    tooltip: {
        useHTML: true,
        pointFormat: '<b>{point.name}:</b> {point.value}Af</sub>'
    },
    plotOptions: {
        packedbubble: {
            minSize: '30%',
            maxSize: '120%',
            zMin: 0,
            zMax: 1000,
            layoutAlgorithm: {
                splitSeries: false,
                gravitationalConstant: 0.02
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}',
                filter: {
                    property: 'y',
                    operator: '>',
                    value: 250
                },
                style: {
                    color: 'black',
                    textOutline: 'none',
                    fontWeight: 'normal'
                }
            }
        }
    },
     credits: {
                enabled: false
            },
    series: [{
        name: 'Income',
        data: [{
            name: 'Extraction',
            value: 7670
        }, {
            name: 'Cleaning',
            value: 200
        },
        {
            name: "Drugns",
            value: 970
        },
      ]
  }
    , 
    { name: 'Expenses',
        data: [{
            name: "Electricty",
            value: 80
        },
        {
            name: "Water",
            value: 90
        },
        {
            name: "Security",
            value: 130
        },
       ]
   }
    ]
});
</script>