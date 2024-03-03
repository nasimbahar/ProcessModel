<?php

namespace App\Helpers;


 class Javascript{
    
    
     public function loadPatientinformation(){
         
         
       $var =  "<script>
               function changeselect(){
               
               var id =document.getElementById('patient_id').value;
               $.ajax({
                url: '". admin_url('api/patientinfo')."',
                method: 'get',
                data:{'id':id},
                success: function(data){
                document.getElementById('patient_info').innerHTML=data;
              }
             });
               }
               </script>";

       
       return $var;
         
     }
     
     public function loadPlanpaymentinfo(){
         $var =  "<script>
             
         $(function(){
         $('.treatmentplan_id').on('change', function() {
          var id=this.value;
          $.ajax({
                url: '". admin_url('api/paymentinfo')."',
                method: 'get',
                data:{'id':id},
                success: function(data){
                document.getElementById('payment_info').innerHTML=data;
              }
             });
});
              
               });
               </script>";

       
       return $var;
         
     }
    
    
}