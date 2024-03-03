<?php


namespace App\Http\Controllers\Master;
use App\ExtraGridActions\FormGridAction;
use App\ExtraGridActions\GridActionInfo;
use App\ExtraGridActions\LinkGridAction;
use App\Models\PhdModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;

class MasterController extends AdminController
{
    public $helper;
    private $relationshipForm=null;
    private $relationshipFields=null;
    private $relationshipRules=null;
    public function __construct()
    {
        $this->helper=new MasterHelper();
    }

    protected function grid()
    {
        $Uri=explode("/",$_SERVER['REQUEST_URI']);
        $this->helper->getCleanUrl($Uri[5]);
        $grid = new Grid(new $this->helper->ClassName);

        if($this->helper->gridWhere!=null){
            $grid->model()->where($this->helper->Additionalwhere());
        }
        $grid->setTitle($this->helper->getTitle("grid"));
        $this->gridActions($grid);
        $this->gridFilters($grid);
        $this->gridData($grid);
        $this->gridFooter($grid);
        $this->gridOptions($grid);
        return $grid;
    }

    public function gridActions($grid){
          $uri=$this->helper->uri;
          $is_extra_actions=$this->helper->is_extra_actions;
          $lang_file=$this->helper->lang_file;
          $options=$this->helper->options[0];
          $grid->actions(function ($actions) use ($uri,$is_extra_actions,$lang_file,$options) {
            $gridActionInfo=new GridActionInfo();
              if($options!==null) {
                  if($options[0]==0 ){
                      $actions->disableView();
                  }
                  if($options[1]==0 ){
                      $actions->disableEdit();
                  }
                  if($options[2]==0 ){
                      $actions->disableDelete();
                  }

              }
            if($is_extra_actions==1) {
                $allActions = $gridActionInfo->getGridInfo($uri);
                foreach ($allActions as $item) {
                    if($item->type=="link")
                        $actions->add(new LinkGridAction($actions->getkey(),$item->url_label,$lang_file));
                    else
                        $actions->add(new FormGridAction($actions->getkey(),$item->id));
                }
            }
        });
    }
    private function gridOptions($obj){
        if($this->helper->options!==null) {
            $allOption = $this->helper->options[0];
            if ($allOption[0][0] == 0 ) {
                $obj->disableCreateButton();

            }


        }

    }
    private  function gridFilters($grid){
        if($this->helper->filters!==null) {
            $grid->filter(function ($filter) {
                foreach($this->helper->filters as $item) {
                    $Check = strpos($item, ",");
                    if ($Check !== false) {
                        $string = explode(",", $item);
                        $filter->equal($string[0], __(__($this->helper->lang_file . "." . $string[0])))->select(PhdModel::dropdown($string[1]));
                    } else {
                        $filter->equal($item, __(__($this->helper->lang_file . "." . $item)));
                    }
                }
            });
        }
    }
    private function gridData($grid){
        $grid->id('ID');
        foreach($this->helper->grid as $item){
            $Check = strpos($item, ",");
            if ($Check !== false) {
                $string = explode(",", $item);
                $relationshipName=$string[0];
                $columnName=$string[1];

                $grid->$relationshipName()->$columnName(__($this->helper->lang_file . "." . $relationshipName.$columnName));
            }else {
                if($item=="image"){
                    $grid->image()->image(null,50,50);
                }else {
                    $grid->column($item, __(__($this->helper->lang_file . "." . $item)))->display(function ($item) {
                        return $item;
                    });
                }
            }
        }
    }
    private function gridFooter($grid){
        if($this->helper->footer!==null) {
            $grid->footer(function ($query) {
                $html=" ";
                foreach($this->helper->footer as $item){
                    $op=$item[1] ;
                    $coulm=$item[2];
                   if($item[0]=="null"){
                       $result= $query->$op($coulm);
                   }else{

                   }
                   $html.="<div >".__($this->helper->lang_file.".".$this->helper->uri.$op.$coulm).":<label class='badge bg-green'>". $result."</label></div>";
                }

                return $html;
            });
        }
    }

    protected function detail($id)
    {
        $Uri=explode("/",$_SERVER['REQUEST_URI']);
        $this->helper->getCleanUrl($Uri[5]);
        $show = new Show($this->helper->ClassName::findOrFail($id));
        $show->panel()->istwocolumns('true');
        $this->showAllFields($show);

        return $show;
    }
    private function showAllFields($show){
        foreach ($this->helper->view as $item){
            if(strpos($item, ",")!==false){
              $array=explode(",",$item);
              if(sizeof($array)==2){
                  $columName=$array[0];
                  $table_name=$array[1];
                 $value= PhdModel::getName($table_name,  $show->getModel()->$columName);
                  $show->$columName(__($this->helper->lang_file.".".$columName))->as(function ($id) use($value) {
                      return $value;
                  });
              }
            }
            else{
                if($item=="image"){
                    if($show->getModel()->image==null){
                        $show->$item(__($this->helper->lang_file.".".$item))->as(function ($id) use($item) {
                            return "No Image";
                        });
                    }else
                    $show->image()->image(null,100,100)->attribute(array("class"=>"profile-user-img img-responsive img-circle"));

                }else {
                    $show->$item(__($this->helper->lang_file . "." . $item));
                }
            }
        }

    }
    public function showLayout(){

    }
    protected function form()
    {

        $Uri=explode("/",$_SERVER['REQUEST_URI']);
        $this->helper->getCleanUrl($Uri[5]);
        $form = new Form(new $this->helper->ClassName);
        $form->setWidth($this->helper->fieldWidth,$this->helper->labelWidth);
        $this->formSubmittingUrl($form);
        $this->formOptions($form);
        $this->formLayout($form);
        $this->formSaving($form);
        $this->formSaved($form);

        $form->hidden("user_id")->default($this->userid());
        return $form;
    }
    private function formSubmittingUrl($form){
        if($form->isCreating()) {
            $form->setTitle($this->helper->getTitle("create"));
        }
        if($form->isEditing()) {
            $form->setTitle($this->helper->getTitle("edit",$this->id));

        }
    }

    private function formOptions($form){
        if($this->helper->options!==null) {
            $allOption = $this->helper->options[1];
            $form->tools(function (Form\Tools $tools) use($allOption) {
                foreach ($allOption as $item){
                    if($item[0]==0){
                        $tools->disableList();
                    }
                    if($item[1]==0){
                        $tools->disableView();
                    }
                    if($item[2]==0){
                        $tools->disableDelete();
                    }
                }

        });}


    }
    private  function formLayout($form){
        $form->column($this->helper->getColumnWidth(), function ($form) {
            $this->formFields($form,0,$this->helper->firstRowMaxFields);
            if(sizeof($this->helper->form)<=$this->helper->firstRowMaxFields) {
                $this->formRelationShip($form);
            }
        });
        if(sizeof($this->helper->form)>$this->helper->firstRowMaxFields) {
            $form->column($this->helper->getColumnWidth(), function ($form) {
                $this->formFields($form, $this->helper->firstRowMaxFields, $this->helper->secondRowMaxFields);
                if(sizeof($this->helper->form)<=$this->helper->secondRowMaxFields) {
                    $this->formRelationShip($form);
                }
            });
        }

        if(sizeof($this->helper->form)>$this->helper->secondRowMaxFields) {
            $form->column($this->helper->getColumnWidth(), function ($form) {
                $this->formFields($form, $this->helper->secondRowMaxFields, sizeof($this->helper->form));
                $this->formRelationShip($form);
            });
        }
    }
    private function formSaving($form){
        $form->saving(function (Form $form) {
        // $form->t_district_id=20;
        });
    }
    private function formSaved($form){
        $form->saved(function (Form $form) {
            $id = $form->model()->id;
            if($this->helper->callBack_function!==null) {
                if (strpos($this->helper->callBack_function, 'return') !== false) {
                    $string = explode(",", $this->helper->callBack_function);
                    return redirect(admin_url($string[1]));
                } else {
                    $this->helper->callBackafterSubmitting($id, $form->isCreating(), $form->isEditing());
                }
            }

        });
    }
    private function formFields($form,$start,$end){
         for($index=$start;$index<$end;$index++){
            $one_field = $this->helper->fields[$index];
            $Check = strpos($one_field, ",");
            if ($Check !== false) {
                $string = explode(",", $one_field);
                $var = $string[0];
                if(isset($string[2])){
                    $this->ParantCascadeFields($form,$var,$index,$string);
                }else {
                    if($this->IsBeforeCascading($index))
                        $form->$var($this->helper->form[$index], __(__($this->helper->lang_file . "." . $this->helper->form[$index])))->options(PhdModel::dropdown($string[1],$this->whereOneToManay($index)))->rules([$this->helper->getRule($this->helper->form[$index])]);
                    else
                        $form->$var($this->helper->form[$index], __(__($this->helper->lang_file . "." . $this->helper->form[$index])))->options(PhdModel::dropdown($string[1]))->rules([$this->helper->getRule($this->helper->form[$index])]);
                }
                }
            else {
                if($one_field=="text")
                    $form->$one_field($this->helper->form[$index], __(__($this->helper->lang_file . "." . $this->helper->form[$index])))->rules([$this->helper->getRule($this->helper->form[$index])])->icon($this->helper->getIcon($this->helper->form[$index]));
                else {

                    $form->$one_field($this->helper->form[$index], __(__($this->helper->lang_file . "." . $this->helper->form[$index])))->rules([$this->helper->getRule($this->helper->form[$index])])->attribute(array("style" => "width:100%"));
                }}

        }

}


    private function formRelationShip($form){

        if($this->helper->relationship!==null) {
            $nameAndType = $this->helper->relationship[0];
            $data = $this->helper->relationship[1];
            $this->relationshipForm=explode(",",$data[0]);
            $this->relationshipFields=explode(",",$data[1]);
            $this->relationshipRules=explode(",",$data[2]);
            $array = explode(",", $nameAndType);
            $relationship = $array[0];
            $form->hasMany($relationship, __($this->helper->lang_file.".".$relationship), function (Form\NestedForm $form) {
                for($index=0;$index<sizeof($this->relationshipForm);$index++){
                    $one_field = $this->relationshipFields[$index];
                    $Check = strpos($one_field, "-");
                    if ($Check !== false) {
                        $string = explode("-", $one_field);
                        $var = $string[0];
                        $form->$var($this->relationshipForm[$index], __(__($this->helper->lang_file . "." . $this->relationshipForm[$index])))->options(PhdModel::dropdown($string[1], false))->rules($this->relationshipRules[$index]);
                    } else {
                            $form->$one_field($this->relationshipForm[$index], __(__($this->helper->lang_file . "." . $this->relationshipForm[$index])))->rules($this->relationshipRules[$index])->attribute(array("style"=>"width:100%"));
                    }

                }

                $form->hidden("user_id")->default($this->userid());
            })->mode($array[1]);
        }
    }

    private function formIgnoredFields($form,$tablename){
       $allFields= DB::getSchemaBuilder()->getColumnListing($tablename);



    }

    public function ParantCascadeFields($form,$var,$index,$string){
           $depended_column = $this->helper->form[$index + 1];
            $api = admin_url("api/cascading/" . $string[2]);
            $form->$var($this->helper->form[$index], __(__($this->helper->lang_file . "." . $this->helper->form[$index])))->options(PhdModel::dropdown($string[1], false))->rules($this->helper->getRule($this->helper->form[$index]))->load($depended_column, $api);

    }

    public function whereOneToManay($index){
        $obj=new AjaxController();
        if($obj->IsCaseadingFiledNotNull($this->id,$this->helper->ClassName,$this->helper->form[$index])){
            return array("id"=>$obj->childCasCadingID);
        }
        return array("id"=>0);



    }
    public function IsBeforeCascading($index){
        if($index!=0) {
            $newIndex = $index - 1;
            $one_field = $this->helper->fields[$newIndex];
            $Check = strpos($one_field, ",");
            if ($Check !== false) {
                $string = explode(",", $one_field);
                if (isset($string[2])) {
                    return true;
                }
            }
        }
        return false;
}





}
