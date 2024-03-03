<?php

namespace Encore\Admin\Controllers;

use App\Models\Packagess;
use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Facades\Admin;
class AdminController extends Controller
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Title';
   
    protected  $id=0;
    protected $secondid=0;
    protected $childid=0;

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
               'index'  => 'Index ',
               'show'   => 'Show',
               'edit'   => 'Edit',
              'create' => 'Create ',
    ];

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title;
    }

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
       
       

            return $content
                ->title($this->title())
                ->description($this->description['index'] ?? trans('admin.list'))
                ->body($this->grid());
        
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id,$secondid=0, Content $content)
    {
        
      
        $this->id=$id;
        $this->secondid=$secondid;
       // $this->childid=$id;
        
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content,$id=0)
    {
        $this->childid=$id;
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    public function wherecon(){
        return array('school_id'=>Admin::user()->school_id);
    }
    
    public function school_id(){
          
          return Admin::user()->school_id;
    }
       public function isfirstlogin(){
          
          if(Admin::user()->is_first_login==1){
              return true;
          }
          return false;
    }
    public function userid(){
        return Admin::user()->id;
    }

}
