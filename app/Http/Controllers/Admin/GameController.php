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
    	$diseasedata = DB::table('spread')->join('promo_codes','promo_codes.id','=','spread.disease_id')->join('cities','cities.id','=','spread.locality_id')->join('state','cities.id','=','state.id')->select('promo_codes.code','spread.count','spread.id','cities.name','spread.flag')->orderBy('spread.count','desc')->limit(3)->get();
    	//return $diseasedata;
    	return view('admin.index',compact('diseasedata'));
    }

   

}
