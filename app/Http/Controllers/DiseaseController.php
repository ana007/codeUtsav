<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;

class DiseaseController extends Controller {
	


	public function getDisease() {


			$disease = DB::table('promo_codes')->select('id','code','description')->get();

			return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $disease]); 
            

	}

	public function insertDisease(Request $request) {

		$input = $request->json()->all();

		$disease_id = $input['disease'];
		$city_id = $input['city'];
		$user_id = $input['user'];
		

		$isPresent = DB::table('spread')->select('id')->where('locality_id',$city_id)->where('disease_id',$disease_id)->first();

		$isUpdated = DB::table('user_record')->select('id')->where('user_id',$user_id)->where('disease_id',$disease_id)->first();

		if($isUpdated == null) {

			DB::table('user_record')->insert(['user_id' =>  $user_id,
                                         'disease_id' =>  $disease_id]);

			if($isPresent == null) {

				DB::table('spread')->insert(['locality_id' =>  $city_id,
                                         'disease_id' =>  $disease_id,
                                         'count' => 1]);

			}

			else {

				DB::table('spread')
            	->where('locality_id', $city_id)
            	->where('disease_id',$disease_id)
            	->increment('count');
			}

			return  response()->json(['success'=>true ,'message'=> "Success"]); 

		}

		else {
			return  response()->json(['success'=>false ,'message'=> "Already Submitted"]); 
		}
		 
	}

	public function addUser(Request $request) {

		$input = $request->json()->all();

		$name = $input['name'];
		$contact = $input['contact'];
		$city = $input['city'];
		$state = $input['state'];
		$gender = $input['gender'];
		$device_id = $input['device_id'];

		$con = DB::table('user')->select('id')->where('contact',$contact)->first();

		if($con != null)
			return response()->json(['success'=>false ,'message'=> "Already Exists"]); 		


		DB::table('user')->insert(['name' =>  $name,
										 'gender' => $gender,	
                                         'contact' =>  $contact,
                                         'city_id' => $city,
                                         'state_id' => $state,
                                         'device_id' => $device_id]);

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

	public function getUserData(Request $request) {

		$input = $request->json()->all();
		$contact = $input['contact'];

		$userData = DB::table('user')->where('contact',$contact)->first();

		return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $userData]); 
	}

}

?>