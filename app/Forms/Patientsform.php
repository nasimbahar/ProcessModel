<?php

namespace App\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Patientsform extends Form
{
    

    public function form()
    {
        $this->text('name', 'Patient Name')->rules('required|min:3');
        $this->text('fname', 'Father Name');
        $this->date('birth_date', 'date of birth');
        $this->radio("gender", "Geneder")->options(['m' => 'Male', 'f'=> 'Female'])->default('m');
        $this->mobile('contact_number', 'Contact Number')->rules('required|min:10');
        $this->email("email","Email");
        $this->textarea('address', 'address')->rules('required|min:3');
        $this->textarea('note', 'Note')->rules('required|min:3');
        $this->image("picture","Patient Picture");
        $this->hidden("clinic_id");
        $this->hidden("user_id");
    }

}
