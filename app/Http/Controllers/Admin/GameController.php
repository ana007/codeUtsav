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

public function search(Request $request)
        {
           $search = \Request::get('search');
           $codes = PromoCode::where('code','like','%'.$search.'%')->paginate(5);

           return view('admin.code.search',compact('codes'));
        }

    
}
