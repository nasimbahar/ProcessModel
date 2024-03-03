<?php


namespace App\Http\Controllers\Master;


use App\Models\AllTableSettings;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\DB;

class TablesController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new AllTableSettings);
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->id('ID');
        $grid->name("Name");
        $grid->column("model", "Model path")->display(function ($item) {
            return $item;
        });
        $grid->lang_file("Language File");
        return $grid;
    }
    protected function form()
    {

        $form = new Form(new AllTableSettings);
        if($form->isCreating()) {
            $tablename="allpapers";
            $allrequired=$this->NonNullabeColumns($tablename);
            $allcoulmns=$this->TableColumns($tablename);
            $allcolumnscount=count($allcoulmns);
            $allrequriedcount=count($allrequired);
            $index=1;
            $index2=1;
            $grid="";
            $filter="";
            $formcontrol="";
            $requiredfileds="";
            foreach($allrequired as $item){
                if($index2==$allrequriedcount){
                    $requiredfileds.='"'.$item.',required"';
                }else {
                    $requiredfileds .= '"' . $item . ',required",';
                }
                $index2++;
            }
            foreach($allcoulmns as $item){

                if($index==$allcolumnscount){
                    if (strpos($item, 'date') !== false) {
                        $formcontrol.='"date"';
                    }
                    else if (strpos($item, 'image') !== false) {
                        $formcontrol.='"image"';
                    }
                    else if (strpos($item, '_id') !== false) {
                        $expload=explode('_',$item);
                        $formcontrol.='"select,'.$expload[0].'"';
                    }
                    else{
                        $formcontrol.='"text"';
                    }


                }else {
                    if (strpos($item, 'date') !== false) {
                        $formcontrol.='"date",';
                    }
                    else if (strpos($item, 'image') !== false) {
                        $formcontrol.='"image",';
                    }
                    else if (strpos($item, '_id') !== false) {
                        $expload=explode('_',$item);
                        $formcontrol.='"select,'.$expload[0].'",';
                    }
                    else{
                        $formcontrol.='"text",';
                    }
                }
                if($index==$allcolumnscount){
                    if(ends_with($item,"id")){
                        $expload=explode('_',$item);
                        $filter.='"'.$item.','.$expload[0].'"';
                    }else {
                        $filter .= '"' . $item . '"';
                    }
                }else {
                    if(ends_with($item,"id")){
                        $expload=explode('_',$item);
                        $filter.='"'.$item.','.$expload[0].'",';
                    }else {
                        $filter .= '"'. $item .'",';
                    }
                }
                if($index==$allcolumnscount){
                    if(ends_with($item,"id")){
                        $expload=explode('_',$item);
                        $grid .= '"'.$expload[0].',name"';

                    }else {
                        $grid .= '"' . $item . '"';
                    }
                }else {
                    if(ends_with($item,"id")){
                        $expload=explode('_',$item);
                        $grid .= '"'.$expload[0].',name",';
                    }else {
                        $grid .= '"' . $item . '",';
                    }
                }

                $index++;

            }
            $form->text("name","Name")->rules( ['required']);
            $form->text("model","Model Path")->default("App\Models\student");
            $form->text("lang_file","Language File")->default("settings");
            $form->text("callback_function","Call Back Function...");
            $form->text("submit_url","New Update, Create Actions Url");
            $form->switch("is_extra_action","Has Grid Extra action");
            $form->textarea("grid","Grid Data")->default("[".$grid."]");
            $form->textarea("filters","Grid Filters")->default("[".$filter."]");
            $form->textarea("footer","Grid Footer");
            $form->textarea("form","Form Fileds")->default("[".$grid."]");
            $form->textarea("fields","Fields Types")->default("[".$formcontrol."]");
            $form->textarea("rules","Form Rules")->default("[".$requiredfileds."]");
            $form->textarea("relationship","Form Relationship");
            $form->textarea("icon","Form Fields Icons");
            $form->textarea("titles","Four Titles");
            $form->textarea("options","Form And Grid Buttons options");
            $form->textarea("view","View Column")->default("[".$grid."]");
        }
        else{
            $form->text("name","Name")->rules( ['required']);
            $form->text("model","Model Path");
            $form->text("lang_file","Language File");
            $form->text("callback_function","Call Back Function...");
            $form->text("submit_url","New Update, Create Actions Url");
            $form->switch("is_extra_action","Has Grid Extra action");
            $form->textarea("grid","Grid Data");
            $form->textarea("filters","Grid Filters");
            $form->textarea("footer","Grid Footer");
            $form->textarea("form","Form Fileds");
            $form->textarea("fields","Fields Types");
            $form->textarea("rules","Form Rules");
            $form->textarea("relationship","Form Relationship");
            $form->textarea("icon","Form Fields Icons");
            $form->textarea("titles","Four Titles");
            $form->textarea("options","Form And Grid Buttons options");
            $form->textarea("view","View Column");
        }





        return $form;
    }
    function endsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }
    private function TableColumns($table){

        $array=array();
        $index=0;
        $data=DB::getSchemaBuilder()->getColumnListing($table);

        $size=sizeof($data);
        for($index=0;$index<$size;$index++){
            $exclude=array("id","updated_at","deleted_at","created_at","user_id");
            if(in_array($data[$index],$exclude)){
                continue;
            }
            $array=$array+array($data[$index]=>$data[$index]);




        }
        return $array;

    }
    private function NonNullabeColumns($tablename){
        $allcoumns=Db::select("select GROUP_CONCAT(column_name) nonnull_columns from information_schema.columns where table_schema ='wenpp' and table_name = '".$tablename."' and is_nullable = 'NO'");
        $allColumns=explode(",",$allcoumns[0]->nonnull_columns);
        $array=array();
        $index=0;
        $data=$allColumns;

        $size=sizeof($data);
        for($index=0;$index<$size;$index++){
            $exclude=array("id","updated_at","deleted_at","created_at","user_id");
            if(in_array($data[$index],$exclude)){
                continue;
            }
            $array=$array+array($data[$index]=>$data[$index]);




        }
        return $array;

    }

}
