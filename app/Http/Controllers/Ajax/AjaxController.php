<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
 public function patients(Request $request)
{
    $q = $request->get('q');

    return \App\Models\Patients::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
}
}
