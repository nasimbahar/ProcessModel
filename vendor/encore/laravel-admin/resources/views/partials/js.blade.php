@foreach($js as $j)
<script src="{{ admin_asset ("$j") }}"></script>
@endforeach
<?php 
//if(Request::is('admin')){
?>

    <script src="{{admin_asset ('code/highcharts.js') }}"></script>
<!--    <script src="{{admin_asset('code/modules/series-label.js')}}"></script>-->
<!--    <script src="{{admin_asset('code/modules/exporting.js')}}"></script>
    <script src="{{admin_asset('code/modules/export-data.js')}}"></script>
    <script src="{{admin_asset('code/modules/heatmap.js')}}"></script>-->
    <script src="{{admin_asset('code/highcharts-more.js')}}"></script>

    
  
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