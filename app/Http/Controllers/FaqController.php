<?php

namespace App\Http\Controllers;

use App\Faq;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faq(Request $request) {

          $response = Faq::select('id','question','answer')->get();
          
        
    	if($response == '[]') {
          return  response()->json(['success'=>false ,'message'=> "No result found"]);
        } else {
          return  response()->json(['success'=>true ,'message'=> "Faq Data is:",'data'=> $response]);
        }
    }
}