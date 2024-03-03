<div id="container1" style="height: <?php echo config('height');?>"></div>
<script>
Highcharts.chart('container1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: '<?php echo $chart->title;?>'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
           credits: {
                enabled: false
            },
  series: [{
    name: '<?php echo $chart->type;?>',
    colorByPoint: true,
     data: [
    <?php $index=0; foreach($chart->points as $key => $value)
    
            {?>
          {                
                                
      name:"<?php echo $key;?>",
       y: <?php echo $value;?>,
       <?php if($index==0){
             ?>
           sliced: true,
      selected: true  
        <?php }  ?>   
    
       },
            <?php $index++; }?>]
   
  }]
});

</script>