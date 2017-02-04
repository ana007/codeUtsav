<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser(){
      $user = null;
      try {

          if (! $user = JWTAuth::parseToken()->authenticate()) {
              return response()->json(['user_not_found'], 404);
          }

      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['token_expired'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['token_invalid'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['token_absent'], $e->getStatusCode());

      }
      return $user;
    }

    public function getCurrentDateTime(){
      return date("Y-m-d H:i:s");
    }

    public function sendOTP($phone,$otp){
      $msg = "Your OTP is ".$otp.". Thank you for registering on RaipurPlus, Share with your friend and Win prizes.";
      $status = $this->sendSMS($phone,$msg,null);

      return $status;
    }


    public function sendSMS($phone,$msg,$sender = null){
      $status = true;
      //Return if SMS is not enabled
      $enable = getenv('SMS_ENABLE');
      if($enable == 'false')
        return $status;

      $authKey = getenv('SMS_AUTH_KEY');
      //Your message to send, Add URL encoding here.
      $message = urlencode($msg);
      //Define route
      $route = "4";
      if($sender == null)
        $sender = getenv('SMS_SENDER');
      //Prepare you post parameters
      $postData = array(
          'authkey' => $authKey,
          'mobiles' => $phone,
          'message' => $message,
          'sender' => $sender,
          'route' => $route
      );
            //API URL
      $url=getenv('SMS_URL');

      // init the resource
      $ch = curl_init();
      curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $postData
          //,CURLOPT_FOLLOWLOCATION => true
      ));


      //Ignore SSL certificate verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


      //get response
      $output = curl_exec($ch);
      //Print error if any
      if(curl_errno($ch))
      {
        $status = false;
      }

      curl_close($ch);
      return $status;
    }
}
