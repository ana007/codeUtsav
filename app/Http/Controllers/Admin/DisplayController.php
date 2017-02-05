<?php

namespace App\Http\Controllers\Admin;

use DB;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{
    //
    function index(){
    	$diseasedata = DB::table('spread')->join('promo_codes','promo_codes.id','=','spread.disease_id')->join('cities','cities.id','=','spread.locality_id')->join('state','cities.id','=','state.id')->select('promo_codes.code','spread.count','spread.id','cities.name','spread.flag')->orderBy('spread.count','desc')->get();
    	//return $diseasedata;
    	return view('admin.display.index',compact('diseasedata'));
    }

  public function search(Request $request)
        {
           $search = \Request::get('search');
           $diseasedata = DB::table('spread')->join('promo_codes','promo_codes.id','=','spread.disease_id')->join('cities','cities.id','=','spread.locality_id')->join('state','cities.id','=','state.id')->select('promo_codes.code','spread.count','spread.id','cities.name','spread.flag')->where('code','like','%'.$search.'%')->orderBy('spread.count','desc')->get();
           // return $diseasedata;
           return view('admin.display.search',compact('diseasedata'));
        }
}
