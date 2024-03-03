<?php

namespace App\Customviews;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Widgets\Form;
use App\Models\Dentalchart;
use Encore\Admin\Widgets\Table;
class Teeth
{
 
 public static function html($id){
    if($id!=0){
         $ischlid= DB::table("patients")->where("id",$id)->first()->ischild; 
         if($ischlid==1){
            return Teeth::childhtml($id).Teeth::teechChattable($id).Teeth::loadjavascript($id);
         }
         else{
             return Teeth::adulthtml($id).Teeth::teechChattable($id).Teeth::loadjavascript($id);
         }
    }
    
    
 
 }
 public static function adulthtml($id){
      $html= Teeth::model($id)
              . '<div class="adult img-responsive" style="display: block;  position: relative; padding: 0px; "><img  id="themap" class="adult img-responsive maphilighted" src="'. Teeth::resoucepath() .'" usemap="#usa"  alt="" style="position: relative; left: 0px; top: 0px; padding: 0px; border: 0px;"></div>
        <map id="usa_image_map" name="usa">
        <area shape="poly" id="1"  name="1"  coords="80,264,92,264,104,266,116,270,124,275,132,283,136,292,136,299,134,305,129,312,122,319,115,323,101,329,93,329,79,328,67,323,61,318,58,313,56,303,56,292,58,282,63,272,71,267" href="#">
        <area shape="poly" id="2" name="2" coords="79,264,73,259,70,252,69,243,70,233,71,224,75,217,81,212,88,211,94,212,110,218,125,225,137,232,145,243,145,251,142,258,136,266,114,269,91,263" href="#">
        <area shape="poly" id="3" name="3" coords="92,211,113,219,125,221,139,221,148,220,154,217,158,210,158,201,154,192,149,182,142,178,130,174,110,168,98,168,90,172,86,179,85,190,86,198,87,205" href="#">
        <area  shape="poly" id="4" name="4"  coords="110,167,107,159,106,153,105,142,106,134,110,127,119,122,132,122,145,126,164,136,167,137,171,145,171,151,167,160,160,169,153,173,140,174,133,174" href="#">
	<area shape="poly" id="5" name="5"   coords="132,122,149,127,163,136,174,136,180,133,186,131,193,124,198,113,197,104,190,96,163,83,153,82,143,84,136,90,131,100,132,122" href="#">
        <area id="6" name="6" alt="" title="" shape="poly"   coords="155,77,157,70,160,61,168,54,177,50,186,51,195,56,211,77,215,79,213,92,210,97,200,98,191,97,160,82" href="#">
	<area id="7" name="7" alt="" title="" shape="poly"   coords="192,54,191,48,196,40,205,33,218,30,227,31,234,46,238,57,238,68,233,77,225,79,216,79,212,77" href="#">
	<area id="8" name="8" alt="" title=""  shape="poly"   coords="233,26,235,45,239,60,244,66,252,70,261,71,270,67,274,63,278,42,276,21,267,17,254,16,242,18" href="#">
	<area id="9" name="9" alt="" title=""   shape="poly"   coords="279,21,278,42,279,53,281,62,285,70,293,74,303,74,311,70,318,58,321,45,322,26,314,19,302,16,288,18" href="#">
	<area id="10" name="10" alt="" title="" shape="poly" coords="328,31,323,42,321,49,318,60,317,71,321,79,328,82,337,82,342,80,348,73,364,54,365,48,359,40,350,33,339,30" href="#">
	<area id="11" name="11" alt="" title="" shape="poly" coords="342,82,343,92,345,98,352,100,359,100,363,99,393,84,401,78,398,67,392,59,387,53,379,51,372,51,365,54" href="#">
	<area id="12" name="12" alt="" title="" shape="poly" coords="394,84,405,83,415,86,422,92,425,103,425,112,425,122,392,137,383,137,373,133,365,126,360,115,361,107,364,100" href="#">
	<area id="13" name="13" alt="" title="" shape="poly" coords="389,138,397,134,424,122,434,122,443,126,449,131,451,137,451,149,449,159,448,165,444,169,422,175,401,174,389,162,384,150,388,139" href="#">
	<area id="14" name="14" alt="" title="" shape="poly" coords="411,181,421,176,447,169,456,168,464,171,469,179,470,187,470,195,470,204,463,212,440,221,420,222,408,221,400,217,397,210,399,199,406,186,408,183" href="#">
	<area id="15" name="15" alt="" title="" shape="poly" coords="436,223,465,212,472,212,480,217,485,225,487,235,487,245,486,252,483,260,475,265,439,270,420,266,411,254,411,244,417,234,434,224" href="#">
	<area id="16" name="16" alt="" title="" shape="poly" coords="439,271,427,280,425,285,420,294,421,305,430,315,438,322,455,330,469,330,482,327,493,320,499,312,501,293,496,276,486,268,476,265,441,270" href="#">
	<area id="17" name="17" alt="" title="" shape="poly" coords="450,362,441,370,435,381,430,393,429,405,433,416,442,422,469,426,490,424,501,418,510,407,512,394,511,385,486,364,469,358,451,361" href="#">
	<area id="18" name="18" alt="" title="" shape="poly" coords="439,422,431,426,425,431,420,441,419,456,419,461,440,474,461,483,472,487,482,475,491,459,493,446,489,436,472,427,441,422" href="#">
	<area id="19" name="19" alt="" title="" shape="poly" coords="416,473,440,473,458,480,464,491,471,496,472,504,471,511,464,522,453,535,434,530,415,518,408,509,404,499,406,488,414,473" href="#">
	<area id="20" name="20" alt="" title="" shape="poly" coords="407,523,422,526,435,530,448,539,452,546,451,553,445,561,436,568,429,569,396,555,392,547,393,539,397,532,406,523" href="#">
	<area id="21" name="21" alt="" title="" shape="poly" coords="375,580,370,568,372,561,379,556,387,553,395,553,430,570,430,581,422,590,415,595,404,602,376,581" href="#">
	<area id="22" name="22" alt="" title="" shape="poly" coords="349,596,359,605,365,619,367,625,382,628,392,626,398,621,402,614,404,603,373,579,368,577,359,577,353,579,348,585,348,595" href="#">
	<area id="23" name="23" alt="" title="" shape="poly" coords="349,596,362,610,367,625,368,630,354,642,342,645,334,644,327,634,325,619,321,610,316,605,320,595,328,592,337,592,346,595" href="#">
	<area id="24" name="24" alt="" title="" shape="poly" coords="315,605,321,610,325,620,327,634,327,645,319,652,307,653,295,650,288,644,284,633,283,620,286,608,291,602,303,601,315,604" href="#">
	<area id="25" name="25"  shape="poly" coords="279,610,282,619,281,631,277,645,270,651,258,654,246,652,238,645,237,636,238,620,242,611,250,605,258,602,264,601,271,602,279,609" href="#">
	<area id="26" name="26"  shape="poly" coords="198,626,197,631,208,641,220,646,231,645,236,636,238,619,241,611,249,605,245,595,236,591,228,591,220,594,198,625" href="#">
	<area id="27" name="27"  shape="poly" coords="160,603,190,580,199,577,207,577,215,580,219,585,219,595,196,627,185,629,173,627,164,619,161,612,160,605" href="#">
	<area id="28" name="28" shape="poly" coords="136,569,135,577,139,586,145,592,160,602,191,579,196,569,193,562,187,556,179,553,170,554,137,568" href="#">
	<area id="29" name="29"  shape="poly" coords="126,533,134,529,145,525,158,522,167,529,174,538,173,547,170,555,136,570,127,568,119,560,114,552,113,545,118,539,124,534" href="#">
	<area id="30" name="30"  shape="poly" coords="112,536,129,530,144,523,154,516,158,509,161,495,152,475,143,474,130,474,118,476,104,483,102,488,96,494,93,502,94,514,103,525" href="#">
	<area id="31" name="31" shape="poly" coords="86,430,99,425,116,422,134,426,141,433,144,441,146,448,146,455,146,463,126,474,93,487,81,473,74,458,72,446,75,437,85,431" href="#">
	<area id="32" name="32"  shape="poly" coords="96,358,82,362,74,367,65,375,55,385,53,396,56,408,63,417,72,423,82,426,98,427,122,423,131,419,137,409,137,398,131,384,126,374,118,365,109,359,97,358" href="#">       

  

</map>';
      return $html;
 }
 public static function model($id){
     $html='<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
               Add
              </button>
          <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Teeth Detials</h4>
              </div>
              <div class="modal-body">'.
      Teeth::getteathchartform($id)
              .'</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savedata">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>';
     return $html;
     
 }
 
 public static function childhtml($id){
     $html= Teeth::model($id).' <div class="adult img-responsive" style="display: block;  position: relative; padding: 0px; "><img  id="themap" class="adult img-responsive maphilighted" src="'. Teeth::resoucepathchild() .'" usemap="#usa"  alt="" style="position: relative; left: 0px; top: 0px; padding: 0px; border: 0px;"></div>
         <map id="usa_image_map" name="usa">

			   <area name="33" data-chart-name="A" alt="" title="" shape="poly" coords="83,302,99,302,102,300,105,299,108,296,109,293,112,287,114,285,116,283,118,276,121,272,122,263,122,258,123,244,122,236,122,231,119,225,118,222,116,217,113,214,109,211,106,211,102,209,96,206,91,205,85,204,79,205,72,207,65,211,60,215,56,219,53,226,51,232,51,238,51,242,50,254,51,267,53,277,56,285,62,293,71,299,76,301" href="#">
				
				<area name="34" data-chart-name="B" alt="" title="" shape="poly" coords="85,202,90,202,93,203,96,204,100,205,106,208,108,209,113,209,119,206,124,202,132,195,136,190,142,181,146,171,149,160,151,153,150,145,147,138,142,132,136,128,128,123,122,122,118,122,111,124,105,126,97,131,91,136,85,144,80,151,77,160,74,168,74,177,75,187,79,195,82,199" href="#">
			   
				<area name="35" data-chart-name="C" alt="" title="" shape="poly" coords="134,122,136,125,140,127,145,131,149,135,150,136,153,136,158,136,163,134,173,131,179,126,185,119,189,110,190,103,189,98,188,92,187,89,187,88,182,86,176,82,171,79,166,76,161,75,156,75,135,75,131,76,128,80,127,82,127,97,130,110" href="#">
				
				<area name="36" data-chart-name="D" alt="" title="" shape="poly" coords="164,74,166,74,170,76,175,79,179,82,184,85,188,86,194,88,202,90,207,90,212,90,214,89,217,84,217,79,217,74,217,68,218,60,218,51,219,48,220,47,216,41,215,37,211,36,207,34,203,33,198,33,193,35,170,45,165,50,160,55,160,59,160,68" href="#">
				
				<area name="37" data-chart-name="E" alt="" title="" shape="poly" coords="217,37,221,46,225,54,228,60,232,65,237,70,240,73,245,75,250,76,254,76,259,72,264,65,273,55,278,46,282,38,284,30,279,26,272,23,264,21,258,19,250,18,242,18,236,18,227,21,221,25,218,30,217,33" href="#">
				
				<area name="38" data-chart-name="F" alt="" title="" shape="poly" coords="284,42,286,42,293,59,295,65,297,70,299,73,302,76,304,77,307,78,311,78,315,77,318,76,322,75,326,73,329,70,333,66,338,61,340,57,343,54,345,50,348,46,351,42,349,39,347,34,343,30,339,26,333,23,327,22,319,21,316,19,312,19,308,18,305,19,301,18,296,19,292,20,288,23,285,29,283,37,283,41" href="#">
				
				<area name="39" data-chart-name="G" alt="" title="" shape="poly" coords="347,54,348,57,349,60,350,63,350,68,351,71,351,76,352,80,354,85,355,88,357,90,359,92,361,93,364,95,366,96,369,95,373,93,376,92,379,89,382,87,386,84,394,80,400,78,401,74,403,69,404,64,404,61,401,57,399,55,394,51,390,49,385,46,381,44,374,42,369,42,359,41,355,41,351,46,348,50" href="#">
				
				<area name="40" data-chart-name="H" alt="" title="" shape="poly" coords="376,95,375,99,374,103,373,106,375,110,377,112,379,115,381,117,385,124,388,128,391,131,394,132,399,134,403,135,413,134,419,134,421,132,426,126,431,121,434,116,436,110,437,105,438,99,438,91,437,84,437,80,434,78,432,77,426,77,413,78,405,79,399,80,390,84,378,92" href="#">
				
				<area name="41" data-chart-name="I" alt="" title="" shape="poly" coords="456,214,459,213,462,211,466,210,468,209,472,207,476,206,479,206,481,205,482,202,484,199,486,195,489,190,490,184,491,179,491,174,490,171,488,165,485,159,482,151,477,143,474,138,470,134,466,132,462,130,457,127,453,126,448,126,439,126,434,127,431,128,428,128,426,128,422,134,418,139,415,145,414,150,414,163,416,169,419,177,422,183,424,189,429,196,433,201,441,207,449,212" href="#">
				
				<area name="42" data-chart-name="J" alt="" title="" shape="poly" coords="456,217,451,220,448,224,446,228,444,233,442,238,441,243,441,259,442,266,443,271,444,275,446,279,449,285,453,292,457,298,461,304,464,306,468,308,472,309,478,309,484,308,492,304,500,299,507,294,512,290,514,284,516,277,517,268,516,262,515,256,514,248,512,239,509,231,507,226,503,220,496,212,491,209,485,207,478,207,468,210" href="#">
				
				
				<area name="43" data-chart-name="K" alt="" title="" shape="poly" coords="444,462,448,462,449,463,452,463,454,464,456,465,458,466,460,467,461,468,463,468,467,468,471,467,472,467,476,466,480,464,484,461,488,458,491,453,494,447,496,442,498,436,500,429,501,423,502,417,503,410,503,398,502,394,501,390,499,387,496,383,493,380,489,375,486,373,481,370,477,368,472,367,467,367,461,367,455,368,450,370,445,374,441,379,435,388,430,400,428,409,427,417,425,427,427,434,430,445,436,454" href="#">
				
				<area name="44" data-chart-name="L" alt="" title="" shape="poly" coords="442,463,438,464,431,466,421,470,413,475,408,480,403,487,400,493,397,500,396,507,393,517,393,523,393,529,396,535,402,543,407,547,411,549,415,550,420,550,427,549,435,547,442,543,448,538,460,526,466,518,471,502,472,493,470,486,467,480,463,474,460,470,453,465" href="#">
				
				<area name="45" data-chart-name="M" alt="" title="" shape="poly" coords="397,542,390,545,383,549,375,557,369,566,363,577,363,581,365,586,369,589,375,592,385,596,395,597,401,598,408,597,411,591,413,585,414,578,413,570,411,562,409,551,405,546" href="#">
				
				<area name="46" data-chart-name="N" alt="" title="" shape="poly" coords="359,582,350,583,344,585,340,587,336,592,331,596,326,604,325,609,326,616,328,624,331,628,334,630,337,631,343,631,351,630,358,628,362,627,368,622,371,617,374,610,375,605,376,599,376,594" href="#">
				
				<area name="47" data-chart-name="O" alt="" title="" shape="poly" coords="273,622,278,628,281,631,284,633,286,635,289,636,296,636,309,636,316,634,320,630,322,626,324,621,324,618,323,614,321,609,318,605,314,599,310,595,306,591,302,590,298,590,294,591,290,594,282,604,276,613,273,619" href="#">
				
				<area name="48" data-chart-name="P" alt="" title="" shape="poly" coords="221,622,223,625,226,628,229,630,233,631,237,633,240,634,254,634,271,626,273,626,272,623,267,613,265,608,263,601,260,596,259,591,255,589,253,588,248,588,245,590,236,598,230,606,225,613" href="#">
				
				<area name="49" data-chart-name="Q" alt="" title="" shape="poly" coords="169,595,167,600,167,605,170,608,174,612,178,615,181,617,185,619,189,620,193,621,196,622,202,623,205,624,210,624,214,624,217,624,220,621,221,618,222,613,221,608,220,603,218,598,216,591,214,587,211,585,208,583,204,581,200,581,193,582,190,582,184,584" href="#">
				
				<area name="50" data-chart-name="R" alt="" title="" shape="poly" coords="146,551,141,557,138,564,136,571,135,577,135,585,137,590,138,592,141,594,143,595,147,596,151,596,157,595,164,593,170,592,174,589,179,586,182,583,186,582,189,574,190,569,190,565,188,562,184,558,179,554,172,549,167,545,160,544,156,544,150,546" href="#">
				
				<area name="51" data-chart-name="S" alt="" title="" shape="poly" coords="95,467,91,470,88,474,86,481,85,485,84,492,85,497,85,503,87,507,89,514,92,520,95,525,101,532,103,535,108,539,111,541,114,543,118,545,123,547,129,548,142,549,145,549,149,544,153,543,155,541,158,535,161,528,162,524,162,514,160,510,157,502,154,495,148,484,144,478,137,472,132,468,125,464,118,462,111,461,101,463" href="#">
				
				<area name="52" data-chart-name="T" alt="" title="" shape="poly" coords="94,464,96,464,99,462,103,461,107,460,112,460,117,460,119,461,121,460,124,457,127,453,129,449,132,444,132,438,132,431,133,427,132,422,130,416,129,410,126,401,125,397,122,392,120,386,116,379,113,375,109,370,103,366,98,364,93,363,84,364,79,366,73,368,67,371,62,375,58,380,55,386,52,394,51,398,51,410,52,416,55,422,56,430,58,436,61,442,64,450,66,454,71,458,75,461,82,464" href="#">
			
    </map>';
     return $html;
     
 }
 
 public static function  resoucepath()
 {
    return url("uploads/images/1.jpg");
 }
  public static function  resoucepathchild()
 {
    return url("uploads/images/2.png");
 }
// public static function loadmaplibrary(){
//     $lib='<script type="text/javascript" src="'.url("js/map.js").'"></script>';
// }
  
public static function loadjavascript($id){
 $areas="";
       $ischlid= DB::table("patients")->where("id",$id)->first()->ischild; 
         if($ischlid==1){
            $areas="34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52";
         }
         else{
             $areas= "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32";
         }
    $allteeth= DB::table("dental_chart")->where("patient_id",$id)->get();
 
    $javascript="<script>
	var image = $('#themap');
     
     
	    $(function(){
         
         $('#savedata').click(function(){ 
       var date=$('#date').val();
       var color=$('#color').val();
       var procedure_id=$('#procedure_id').val();
       var note=$('#note').val();
       var patient_id=$('#patient_id').val();
       var teeth_numbers=$('.teeth_number').val();
       
            $.ajax({
    url: '". admin_url('mypatients/saveselectedteeth')."',
    method: 'get',  
    data:{'date':date,'color':color,'procedure_id':procedure_id,'note':note,'patient_id':patient_id,'teeth_numbers':teeth_numbers},
    success: function(data){
       $('#modal-default').modal('hide');
       location.reload();
    }
});
 });

	var profiles = [
    { 
        areas: '".$areas."',
       
    }
    ];

var optionsXref = {};
    

$.each(profiles,function(i,e) {
    var areas = e.areas.split(',');    
    $.each(areas,function(j,key) {
        optionsXref[key]=e.options;
    });        
});

image.mapster({
    mapKey: 'name',
  onClick: function(e) {
    if (e.selected) {
        image.mapster('set',true,e.key, optionsXref[e.key]);   
        var key='name';
        var dd= $('#themap').mapster('get',key);
        $('.teeth_number').val(dd);
        return false;
                   
    }
    else{
       
        var key='name';
        var dd= $('#themap').mapster('get',key);
         var list=removevalue(dd,e.key,',');
        $('.teeth_number').val(list);
    
}},areas: [";
    $dd="";
    foreach($allteeth as $item)
        {
          $dd.= "{ key:'".$item->teethnumber."',selected:true,
          fillColor: '".ltrim($item->color, '#')."'   
    },";
        }
        $secon  ="
          ]
	
     });


		});
                
function removevalue (list, value, separator) {
  separator = separator || ',';
  var values = list.split(separator);
  for(var i = 0 ; i < values.length ; i++) {
    if(values[i] == value) {
      values.splice(i, 1);
      return values.join(separator);
    }
  }
  return list;
}

		</script>";
    return $javascript.$dd.$secon;
    
    
    
} 

 public static   function getteathchartform($id){
     
     
      
        $form = new \Encore\Admin\Widgets\Form1();
        $form->attribute("id","secondform");
        $form->date('datee', 'Date')->attribute("id","date");
        $form->color("colore","color")->attribute("id","color")->placeholder("color name ");
        $form->hidden("patient_ide")->default($id)->attribute("id","patient_id");
        $form->disableSubmit();
        $form->multipleSelect("procedure_ide","Procedure")->options(\App\Models\Procedures::where('id','>',0)->pluck('name', 'id'))->attribute("id","procedure_id");
        $form->textarea("notee","Note")->attribute("id","note");
        $form->tools(function (Form\Tools $tools) {
        $tools->disableList();
        $tools->disableDelete();
        $tools->disableView();
   
         });

       return $form->render();
    }
    
    
    public static function teechChattable($id){
     $allteeth= DB::table("dental_chart")->where("patient_id",$id)->get();
     $headers = ['Teeth Number', 'Procudere',"date","note"];
     $rows=array();
     foreach($allteeth as $oneteach){
         $rows[]=array(Teeth::teethnumber($oneteach->teethnumber),
             Teeth::findprocudernames($oneteach->procedure_id),
             $oneteach->date,
             $oneteach->note
             
             
         );
     }
  
$table = new Table($headers, $rows);

return $table->render();
 }
 public static function findprocudernames($procedures){
    $allprocuders= explode(',', $procedures);
    $html="";
    foreach($allprocuders as $item){
        $procedurename= DB::table("procedures")->where('id',$item)->first()->name;
        $html.='<span class="label label-success">'.$procedurename.'</span>';
    }
    return $html;
 }
 public static function teethnumber($number){
     
     if($number<33){
         return $number;
     }
     else{
         $new=$number+32;
         return chr($new);
     }
     
 }
}
