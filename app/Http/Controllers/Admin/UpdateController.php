<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UpdateController extends Controller
{
    public function update($id){

    	DB::table('spread')->where('id',$id)->update(['flag' => 1]);
	$city_name = DB::table('cities')->select('id','name')->where('id',$id)->get();
           $diseasedata = DB::table('spread')->join('promo_codes','promo_codes.id','=','spread.disease_id')->select('code','spread.count','spread.id')->where('spread.locality_id',$id)->where('spread.flag','0')->get();
           //$disease_name = DB::table('promo_codes')->select('code')->where('');
           // return $city_name;
           // return $diseasedata;
           return view('admin.verify.city',compact('city_name','diseasedata'));
    }
}
