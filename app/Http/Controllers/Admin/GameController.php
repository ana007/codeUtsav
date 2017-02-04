<?php

namespace App\Http\Controllers\Admin;

use App\Games;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Request;
//use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Image;

class GameController extends Controller
{

    public function index(){
      return view('admin.index');
    }

    
}
