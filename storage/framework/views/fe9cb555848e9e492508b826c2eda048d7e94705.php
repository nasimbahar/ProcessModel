<?php $__currentLoopData = $js; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script src="<?php echo e(admin_asset ("$j")); ?>"></script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php 
//if(Request::is('admin')){
?>

    <script src="<?php echo e(admin_asset ('code/highcharts.js')); ?>"></script>
<!--    <script src="<?php echo e(admin_asset('code/modules/series-label.js')); ?>"></script>-->
<!--    <script src="<?php echo e(admin_asset('code/modules/exporting.js')); ?>"></script>
    <script src="<?php echo e(admin_asset('code/modules/export-data.js')); ?>"></script>
    <script src="<?php echo e(admin_asset('code/modules/heatmap.js')); ?>"></script>-->
    <script src="<?php echo e(admin_asset('code/highcharts-more.js')); ?>"></script>

    
  
    <script>
      
               function loadstart(){
               
  $.ajax({
    url: '<?php echo admin_url('nextbook/start');?>',
    method: 'get',  
    success: function(data){
     
       location.replace("<?php echo admin_url('/');?>");
    }
});
               

     }  
            

        
        function printpage(){
 
             window.print();
        }
        </script>