<?php

namespace App\Http\Controllers\Ajax\nextbook;

use Illuminate\Http\Request;
use DB;

class AutocompleteController extends \Encore\Admin\Controllers\AdminController
{


    function fetch(Request $request)
    {
      $tablename=$request->get('table');
      $columnname=$request->get('column');
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table($tablename)
        ->where($columnname, 'LIKE', "%{$query}%")->where($this->wherecon())
        ->get();
      $output = '<br><ul class="dropdown-menu" style="display:block; position:relative;">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->$columnname.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
    
    public static  function Javascript($table,$column,$issell="false"){
        $script="<script>
$(document).ready(function(){

$(document).on('keyup', '.autocomplete',function (e) { 
        var query = $(this).val();
        if(query != '')
        {
         $.ajax({
          url:'".admin_url('api/autocomplete')."',
          method:'get',
          data:{query:query,issell:'".$issell."',table:'".$table."',column:'".$column."'},
          success:function(data){
           $('#autocompletelist').fadeIn();  
             $('#autocompletelist').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('.autocomplete').val($(this).text());  
        $('#autocompletelist').fadeOut();  
    })
        if('".$issell."'!='false'){ 
    

$(document).on('blur', '.autocomplete', function(){  
    var query = $(this).val();
        if(query != '')
        {
         $.ajax({
          url:'".admin_url('nextbook/loadproducts')."',
          method:'get',
          data:{query:query},
          success:function(data){
           $('#autocompletelist').fadeIn();  
             $('#autocompletelist').html(data);
          }
         });
        }
    });
     
    }
});

     
</script>";
          return $script;
    }

}
