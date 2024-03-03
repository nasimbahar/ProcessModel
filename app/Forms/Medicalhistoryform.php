<?php

namespace App\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Medicalhistoryform extends Form
{
    

    public function form()
    {
        $this->textarea("Note","Note");
        $this->image("picture","Picture");
    }

}
