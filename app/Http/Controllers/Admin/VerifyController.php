<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
//use Illuminate\Http\Request;
use DB;
use DateTime;
use Illuminate\Support\Facades\Session;

use App\Http\Middleware;
class VerifyController extends Controller
{
    //


    public function index(){

    	$var = DB::table('state')->select('id','name')->get();

    	return view('admin.verify.index',compact('var'));
    }

	public function updateState($id){

    	$city_name = DB::table('cities')->select('id','name')->where('state_id',$id)->get();

    	$statename = DB::table('state')->select('id','name')->where('id',$id)->get();
    	// return $statename;
    	return view('admin.verify.index',compact('city_name','statename','id'));
    }
        public function city($id)
        {
           $city_name = DB::table('cities')->select('id','name')->where('id',$id)->get();
           $diseasedata = DB::table('spread')->join('promo_codes','promo_codes.id','=','spread.disease_id')->select('code','spread.count','spread.id')->where('spread.locality_id',$id)->where('spread.flag','0')->get();
           //$disease_name = DB::table('promo_codes')->select('code')->where('');
           // return $city_name;
           // return $diseasedata;
           return view('admin.verify.city',compact('city_name','diseasedata'));
        }
}
