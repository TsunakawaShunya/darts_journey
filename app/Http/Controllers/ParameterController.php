<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use Illuminate\Support\Facades\Auth;


class ParameterController extends Controller
{
    public function post_parameter(Request $request)
    {   
        $input = $request['parameter'];
        $parameter = new Parameter();
        $parameter->fill($input)->save();
        
        return redirect('users/' . Auth::id() . '/trip/list');
    }
}
