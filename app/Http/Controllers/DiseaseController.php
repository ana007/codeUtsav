<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;

class DiseaseController extends Controller {
	


	public function getDisease() {


			$disease = DB::table('promo_codes')->select('id','code')->get();

			return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $disease]); 
            

	}

	public function insertDisease(Request $request) {

		$input = $request->json()->all();

		$disease = $input['disease'];
		$city = $input['city'];
		
		$cit = DB::table('cities')->select('id')->where('name',$city)->first();
		$dis = DB::table('promo_codes')->select('id')->where('code',$disease)->first();

		$city_id = $cit->id;
		$disease_id = $dis->id;

		$isPresent = DB::table('spread')->select('id')->where('city_id',$city_id)->where('disease_id',$disease_id)->first();

		if($isPresent == null) {

			DB::table('spread')->insert(['city_id' =>  $city_id,
                                         'disease_id' =>  $disease_id,
                                         'count' => 1]);

		}

		else {

			DB::table('spread')
            ->where('city_id', $city_id)
            ->where('disease_id',$disease_id)
            ->increment('count');
		}

		 
	}

	public function addUser(Request $request) {

		$input = $request->json()->all();

		$name = $input['name'];
		$contact = $input['contact'];
		$city = $input['city'];
		$state = $input['state'];
		$gender = $input['gender'];

		$con = DB::table('user')->select('id')->where('contact',$contact)->first();

		if($con != null)
			return response()->json(['success'=>false ,'message'=> "Already Exists"]); 		

		$cit = DB::table('cities')->select('id')->where('name',$city)->first();
		$sta = DB::table('state')->select('id')->where('name',$state)->first();

		$city_id = $cit->id;
		$state_id = $sta->id;

		DB::table('user')->insert(['name' =>  $name,
										 'gender' => $gender,	
                                         'contact' =>  $contact,
                                         'city_id' => $city_id,
                                         'state_id' => $state_id]);

	}

	public function getStates() {

		$states = DB::table('state')->select('id','name')->get();		
		return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $states]); 
	}

	public function getCities(Request $request) {

		$input = $request->json()->all();
		$state_id = $input['state'];

		$cities = DB::table('cities')->select('id','name')->where('state_id',$state_id)->get();

		return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $cities]); 	
	}

}

?>