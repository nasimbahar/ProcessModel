 <div id="container" style="height: <?php echo config('height');?>"></div>
<script>

Highcharts.chart('container', {

    title: {
        text: '<?php echo $chart->title;?>'
    },

    subtitle: {
        text: '<?php echo $chart->subTitle;?>'
    },

    yAxis: {
        title: {
            text: '<?php echo $chart->yaxixTitle;?>'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: '<?php echo $chart->accessibility;?>'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: <?php echo $chart->pointstart ;?>
        }
    },
 credits: {
                enabled: false
            },
    series: [{
        name: 'Cleaning',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
    }, {
        name: 'Extraction',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
        name: 'Braces',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
    } 
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>