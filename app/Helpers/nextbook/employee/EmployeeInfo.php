<?php

namespace App\Helpers\nextbook\employee;


 class EmployeeInfo{
    
    
     public function loadEmployeeinformation(){
         
         
       $var =  "<script>
               function changeselect(){
               
               var id =document.getElementById('employee_id').value;
               $.ajax({
                url: '". admin_url('api/employeeinfo')."',
                method: 'get',
                data:{'id':id},
                success: function(data){
                document.getElementById('info').innerHTML=data;
              }
             });
               }
               </script>";
       
       return $var;
         
     }
     public function loademployeeforattendecen(){
         $var =  "<script>
             $(function(){
             
           
   
  $(document).on('click','.dynamicElement',function(){

  $('.present').val($('#dpresent').val());
    $('.absent').val($('#dabsent').val());

  $('.onleave').val($('#donleave').val());


});           
             

});

               function changeselect(){
           
                var year =document.getElementById('year').value;
                var month_id =document.getElementById('month_id').value;
              
                
               $.ajax({
                url: '". admin_url('api/employeeforattendence')."',
                method: 'get',
                data:{'year':year,'month_id':month_id},
                success: function(data){
                document.getElementById('info').innerHTML=data;
                
              }
             });
               }
               </script>";
       
       return $var; 
     }
     
     public function loademployeeforpayroll(){
         $var =  "<script>
          $(function(){
                var year =document.getElementById('year').value;
                var month_id =document.getElementById('month_id').value;
                
                
               $.ajax({
                url: '". admin_url('api/employeeforpayroll')."',
                method: 'get',
                data:{'year':year,'month_id':month_id,'project_id':project_id, 'isupdate':1},
                success: function(data){
                document.getElementById('info').innerHTML=data;
                
              }
             });
             });

               function changeselect(){
           
                var year =document.getElementById('year').value;
                var month_id =document.getElementById('month_id').value;
                  var project_id =document.getElementById('project_id').value;
               $.ajax({
                url: '". admin_url('api/employeeforpayroll')."',
                method: 'get',
              data:{'year':year,'month_id':month_id,'project_id':project_id, 'isupdate':0},
                success: function(data){
                document.getElementById('info').innerHTML=data;
                
              }
             });
               }
               </script>";
       
       return $var; 
     }
     

    
    
}