<?php

namespace App\Http\Controllers\Statics;

use App\Desgin\StaticTables;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Facades\Admin;
class HomeController extends Controller
{
    public function index(Content $content)
    {

            return $content
                ->title('Dashboard')
                ->row(function (Row $row) {
                    $row->column(12, function (Column $column) {
                       $html="<center class='row'>
<h2>Title: A process model for the Implementation of blockchain-based systems</h2></center>";
                       $html.="<center class='row'>
<h2>Supervisor: DR Michal Ries</h2></center><br><br>";
                        $column->append($html);
                    });
                })
                ->row(function (Row $row) {
                   /* $row->column(3, function (Column $column) {
                        $infoBox = new InfoBox('All Papers', 'file', 'yellow', admin_url('phd/allpapers'), $this->allpatients());
                        $column->append($infoBox->render());
                    });
                    $row->column(3, function (Column $column) {
                        $infoBox = new InfoBox('All references ', 'list', 'blue', admin_url('phd/allreferences'), $this->alldrugs());
                        $column->append($infoBox->render());
                    });

                    $row->column(3, function (Column $column) {
                        $infoBox = new InfoBox('Literature review
', 'table', 'green', admin_url('https://1drv.ms/w/s!Ah9n6XViClYFhAQ7UJz7ZWTAvL1T'), $this->allupcomingappointments(),"_blank");
                        $column->append($infoBox->render());
                    });

                    $row->column(3, function (Column $column) {
                        $infoBox = new InfoBox('Daily Tasks
', 'list', 'red', admin_url('https://trello.com/b/qa3lZxFL/the-state-of-the-art'), "Trello","_blank");
                        $column->append($infoBox->render());
                    });*/

                })
                ->row(function (Row $row) {



                });


    }
    function firstlogin(Content $content){
        return $content->title(__('welcome'))
            ->row(function (Row $row){
                $row->column(12, function (Column $column) {
                    $box = new Box(__('settings.aboutnextbook'), "This School MIS is comprehensive software which include all modules and features related to a school system. It is develop based on 10 years experiences in local market in Afghanistan. 
Below are the shorts descriptions of all module of this software. <br>
•	Admission. In this module, the software covers all features related to student registration, resign, cards and so on. <br>
•	Examination. This module covers all features related to examination, such as inserting marks, their result, nevertheless, it is prints Etlanma, result sheet, one subject marks and so on at the template of minatory of Education. <br>

•	Settings: In this module, the software cover all static data, user management, role management and so other system settings. <br>
•	Transports: This module cover the details features of a transport system, it is start form vehicle and driver registration to assigning transport to student, it is fee and lots of other features. <br>
•	Assets: In this module system store all assets of a School with details. 
•	HR: In this module, it is covering the details features of school staff, such as registration, their attendance, payroll and so on. <br>
•	Inventory: Inventory module corresponds all task of a inventory, it is cover vendor, product registration, product selling and so on.<br> 
•	Library: Library module cover all task of a library management system, such as taking books, submitting book, calculating fine in case of late submitting and so on. <br>
•	Finance. It is covering all related task of school fee, inventory payments and on. <br>
•	Web portal: this system also has a web portal, Students and their parents can access some specific information . <br>
");
                    $form=new \Encore\Admin\Widgets\Form1();
                    $form->disableSubmit();
                    $form->disableReset();
                    $html="<a href=".admin_url('school/class')."><button style='float:right' class='btn btn-info'>".__('admin.next')."</button></a>";
                    $form->html($html);


                    //$show->divider();

                    $column->append($box->render().$form->render());
                });
            });
    }
     private function allpatients(){

       return  \App\Models\Allpapers::count();
    }
     private function alldrugs(){
         return "End-note";
       return \App\Models\Drugs::where($this->wherecon())->count();
    }
     private function allupcomingappointments(){
        return "Word File";

    }

    private function allexpenses(){
        return "End-note";

    }
     public function wherecon(){
        return array('school_id'=>Admin::user()->school_id);
    }
}
