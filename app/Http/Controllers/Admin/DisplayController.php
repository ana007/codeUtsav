<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{
    //
    function index(){
    	return view('admin.display.index');
    }
}
