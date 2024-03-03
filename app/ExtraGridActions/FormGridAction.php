<?php
namespace App\ExtraGridActions;
use App\Models\AllTableSettings;
use App\Models\GridActions;
use App\Models\PhdModel;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Invoicepayments;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormGridAction extends RowAction
{
    public $name ;
    public $id;
    public $savingtable;
    public $formdata;
    public $fields;
    public $lang_file;
    public $rules;
    public $tablename;
    public $action_id;
    public $functionName;
    function __construct($id=0,$actionid=0) {
        parent::__construct();
        if($actionid!==0) {
            $this->getActionsFormInfo($actionid);
            $this->id = $id;
        }
    }
    public function handle(Model $model, Request $request)
    {
        try{
        $actionid=$request->get("action_id");
        $this->getActionsFormInfo($actionid);
        $array=$this->formdata;
        $addedFileds=array("school_id"=>$request->get('school_id'),'user_id'=>$request->get("user_id"));
            $data=$request->only($array);
            $merge= array_merge($data,$addedFileds);
           DB::table($this->tablename)->insert(
               $merge
        );
           $obj=new GridCallBackfunction();
           $funtionname=$this->functionName;
           $obj->$funtionname($request->get(('id')));

       }catch (\Exception $e) {
           DB::rollback();
            return $this->response()->error($e)->refresh();
        }return $this->response()->success('Success message.')->refresh();
    }
    public function form()
    {
        $this->name();
        if($this->id!=0){
            $this->formFields();
        }
    }
    private function formFields(){
        $index=0;
        foreach ($this->formdata as $item){
            $one_field = $this->fields[$index];
            $Check = strpos($one_field, ",");
            if ($Check !== false) {
                $string = explode(",", $one_field);
                $var = $string[0];
                $this->$var($this->formdata[$index], __(__($this->lang_file . "." . $this->formdata[$index])))->options(PhdModel::dropdown($string[1]))->rules($this->rules[$index]);

            }
            else {
                if($one_field=="text")
                    $this->$one_field($this->formdata[$index], __(__($this->lang_file . "." . $this->formdata[$index])))->rules([$this->rules[$index]]);
                else {
                  if($one_field=="hidden"){
                      $this->hidden($this->formdata[$index])->default($this->id);
                  }
                  else
                    $this->$one_field($this->formdata[$index], __(__($this->lang_file . "." . $this->formdata[$index])))->rules([$this->rules[$index]])->attribute(array("style" => "width:100%"));
                }}
          $index++;
        }
        $this->hidden("user_id")->default(Admin::user()->id);
        $this->hidden("school_id")->default(Admin::user()->school_id);
        $this->hidden("id")->default($this->id);
        $this->hidden("action_id")->default($this->action_id);

    }
    private function getActionsFormInfo($id){

        if($id!=0) {
            $gridactionsInfo = GridActions::where("id", $id)->get()->first();
            $arraylabelandFile = explode(",", $gridactionsInfo->url_label);
            $this->formdata = json_decode($gridactionsInfo->form, true);
            $this->fields = json_decode($gridactionsInfo->fields, true);
            $this->rules = json_decode($gridactionsInfo->rules, true);
            $this->name = __($arraylabelandFile[0] . "." . $arraylabelandFile[1]);
            $this->lang_file = $arraylabelandFile[0];
            $this->tablename=$arraylabelandFile[2];
            $this->action_id=$id;
            $this->functionName=$gridactionsInfo->call_back_function;
        }
    }


}
