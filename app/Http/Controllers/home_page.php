<?php

namespace App\Http\Controllers;

use App\Models\announce;
use Illuminate\Http\Request;

class home_page extends Controller
{
    //
    function index(){

        $data = announce::all();
        return view('Home_Page',['announces'=>$data]);
    }
}
