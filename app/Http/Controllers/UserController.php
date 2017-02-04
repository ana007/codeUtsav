<?php

namespace App\Http\Controllers;

use App\Register;
use App\AppUser;
use App\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\PromoCode;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use Image;
use DomDocument;
use File;

use App\Http\Controllers\Config;

const REFERAL_COIN = 50;
const JOINING_COIN = 50;
//const UNIV_OTP = 1111;



class UserController extends Controller
{

  private $message = array('user.success'     => 'Success, user verified.',
                          'user.error'        => 'Sorry, some error occured please try after some time.',
                          'user.retryError' =>  'Maximum attempt Reached, please have fun tomorrow.',
                          'otp.invalid'       => 'Verfication Failed, Invalid OTP.',
                          'otp.success'       => 'Success, OTP sent to user.',
                          'user.updated'     => 'Success, user updated.',
                          'code.invalid'      => 'Code is expired or invaid',
                          'code.valid'      => 'Code is Successfully Applied',
                           'mobile.error'  =>  'Invalid mobile Number.Please check');

  public function register(Request $request)
  {
    /*
    Input Phone & Device ID
    Check IF phone exist in Register Table THEN
     Check for Retries and send OTP (user is trying to re-register) & increment attempt
    ELSE
      Check if phone exist in USERS table THEN
        Regenerate OTP & send ( Usecase for forgot password)
      ELSE
        Create Record in Register Table and send OTP ( Usecase for new registration)
    */
    $input = $request->json()->all();
    $status = false;
    $otp = "";
    $phone = $input['phone'];
    $device_id = $input['device_id'];

  

                $UNIV_OTP =  getenv('UNI_OTP');
                $UNIV_PHONE = getenv('UNI_PHONE');

   // return $UNIV_PHONE;

    if(preg_match("#^(\+){0,1}(91){0,1}(-|\s){0,1}[0-9]{10}$#",$phone))
    {

    $regRow = Register::where('phone','=',$phone)->first();

    if(!empty($regRow)){
      $attempt = $regRow->attempt;
      if($attempt < 3)
      {
        $last_attempt = $this->getCurrentDateTime();
        DB::table('register')
          ->where('phone', $input['phone'])
          ->update(['attempt' => $attempt+1,'last_attempt' => $last_attempt]);
        $otp = $regRow->OTP;
        $status =true;
      }else{
        $status = false;
      }
    }else{
        $userRow = AppUser::where('phone','=',$phone)->first();
        if(!empty($userRow)){

                  if($UNIV_PHONE == $phone){

                          $password = Hash::make($UNIV_OTP);
                          $otp=$UNIV_OTP;
                          AppUser::where('phone', '=' ,$phone)->update(['OTP' => $UNIV_OTP,'password' => $password]);
                          $status = true;
                      }else{

                            $attempt = $userRow->attempt;
                            if($attempt < 3)
                            {
                                $last_attempt = $this->getCurrentDateTime();

                              $otp = $this->generateOTP();
                              $password = Hash::make($otp);
                              AppUser::where('phone', '=' ,$phone)->update(['OTP' => $otp,'attempt' => $attempt+1,'last_attempt' => $last_attempt,'password' => $password]);
                              $status = true;

                                }else{
                                $status = false;
                               }
                    }




        }else{
          $otp = $this->generateOTP();
          DB::table('register')->insert(['phone' =>  $phone,
                                         'OTP' =>  $otp,
                                         'generated' => $this->getCurrentDateTime(),
                                         'device_id' => $input['device_id']]);
          $status =true;
        }
      }

      if($status)

        if((!empty($otp) && $this->sendOTP($phone,$otp)) || ($UNIV_PHONE == $phone))


           return response()->json(['success'=>true , 'message' => $this->message['otp.success'],'otp' => $otp]);

          return response()->json(['success'=>false ,'message'=> $this->message['user.retryError']]);

          }else{

              return response()->json(['success'=>false ,'message'=> $this->message['mobile.error']]);

     } // if end for mobile validation

    }


 public function reSendOtp(Request $request)
 {
    /*
    Input Phone number
    Check if phone exist in Register table THEN
      Check for Retries and send SMS
    ELSE Check in USER tables
       CHeck for retries and send SMS
    */
    $input = $request->json()->all();
    $phone = $input['phone'];
    $status = false;
    $otp = '';
    //Check if user exist in register table
    $regRow = Register::where('phone','=',$phone)->first();

    if(!empty($regRow)){
        $attempt = $regRow->attempt;
        if($attempt < 3)
        {
          DB::table('register')
            ->where('phone', $input['phone'])
            ->update(['attempt' => $attempt+1,'last_attempt' => $this->getCurrentDateTime()]);
            $otp = $regRow->OTP;
            $status = true;
        }
    }else
    {
      $userRow = AppUser::where('phone','=',$phone)->first();
      if(!empty($userRow)){
        $otp = $this->generateOTP();
        AppUser::where('phone', '=' ,$phone)->update(['OTP' => $otp]);
        $status = true;
        //TODO implement Retries column & logic
      }
    }

    if($status)
    {
      if(!empty($otp) && $this->sendOTP($phone,$otp))
        return response()->json(['success'=>true ,'message'=> $this->message['otp.success'],'otp' => $otp]);
    }

    return response()->json(['success'=>false ,'message'=> $this->message['user.attempt']]);

  }


  public function verifyUser(Request $request)
  {
    /*
    Input Phone Number, OTP, Code (optional)
    IF user exist in Register THEN (registration usecase)
      Validate otp
      Validate Code & calculate Coin
      Get vendor advertisement form promo tabel
      Create User with relevant coin & referal code
      update coin in user table by promocode
      Update Code Table & User referal if applicable
      Remove user from Register table
      new_user flag set true
      RETURN Token
 Else
     Validate OTP (Reset Password case for existing user)
     return Token
      */

    $input = $request->json()->all();
    $phone = $input['phone'];

    $otp = $input['otp'];
    $code = isset($input['code']) ? $input['code'] : NULL;
    $newUser = false;
    $date = $this->getCurrentDateTime();
    $coin = JOINING_COIN;
    $refUserId = null;
    $token = null;
    $new_user = false;
    $vendorAd = "";

    

                $UNIV_OTP =  getenv('UNI_OTP');
                $UNIV_PHONE = getenv('UNI_PHONE');

    // check user exist in register table
    $regRow = Register::where([['phone', '=', $phone ]])->first();
    $userRow = null;
    //user found in register table
    if(!empty($regRow))
    { // validate OTP
      if($regRow->OTP == $otp || UNIV_OTP == $otp)
        {
          //Manage Code
        if(!empty($code))
        {
          $codeRow = PromoCode::where([['code', '=', $code]])->first();
            //validate code

          if(!empty($codeRow))
          {

             $vendorAd= $codeRow->code_ad;

            if( $codeRow->claim_count < $codeRow->max_claim &&
                 ($codeRow->start_date <= $date  &&   $codeRow->end_date >= $date) &&
                 ($codeRow ->type == 1)){
                   $coin = $coin + $codeRow->coin_count;


             }
          }else
          {
            //Check for referal code
            $refUser = UserInfo::where([
                                       ['code', '=',  $input['code']]
                                        //,['invite_count', '!=', 0]
                                       ])->first();
            if(!empty($refUser))
            {
              $refUserId = $refUser->user_id;
              $coin = $coin + REFERAL_COIN;
            }
          }
        }
          // End Manage Code
          //Create User
          $input['password'] = Hash::make($otp);
          $input['coin_silver_promo'] = $coin;
          $input['device_id'] = $regRow->device_id;
          $userRow = AppUser::create($input);

          if(!empty($codeRow))
          {
               // claim_count attempt increase
                               $claim_attempt = $codeRow->claim_count;
                                DB::table('promo_codes')
                                    ->where('code', $input['code'])
                                        ->update(['claim_count' => $claim_attempt+1]);

                            // CREATE CLAIM TABLE TRANSACTIONS BY PROMOCODE
                                                     DB::table('code_claim')->insert(
                                                                    [ 'user_id' =>   $userRow->id,
                                                                      'code_id' =>  $codeRow->id,
                                                                      'datetime' =>  $date,
                                                                    ]
                                                                );
          }

          //Update User Info table
          DB::table('user_info')->insert([
                    'user_id' =>  $userRow->id,
                    'ref_user_id'=>$refUserId
                  ]);

          //Update Referal user if applicable
          if(!empty($refUserId)){
            AppUser::where('id', $refUserId)
                               ->increment('coin_silver_promo', REFERAL_COIN);
          }

            //Get token
            $input['password'] = $otp;
            $token = $this->getUserToken($input);

            //Remove user from Register table
            DB::table('register')->where('phone',$phone)->delete();

            $newUser = true;

            return response()->json(['success'=>true ,'message'=> $this->message['user.success'], 'token' => $token ,'user_id'=> $userRow->id, 'new_user_flag' =>  $newUser,'code_ad' => $vendorAd]);
      }else{
          return response()->json(['success'=>false , 'message' => $this->message['code.invalid']]);
        }
      }else
      {
        // check user exist in USER table
        $userRow = AppUser::where([['phone', '=', $phone ]])->first();
        if(!empty($userRow))
        {

          if($userRow->OTP == $otp)
          {

            //check newUserFlag true or false from UserInfo table.
            $userInfoRow = UserInfo::where([['user_id', '=', $userRow->id],
                                              ['name','!=', NULL]])->first();
            if(empty($userInfoRow))
            {
                   $newUser = true;
            }
            //Validate User Credentials
               $input['password'] = $input['otp'];
               $credentials  = array_only($input, ['phone', 'password']);
            try {
             // attempt to verify the credentials and create a token for the user
             if (! $token = JWTAuth::attempt($credentials)) {
               return response()->json(['error' => 'invalid_credentials'], 401);
             }
           } catch (JWTException $e) {
               // something went wrong whilst attempting to encode the token
               return response()->json(['error' => 'could_not_create_token'], 500);
           }

              return response()->json(['success'=>true ,'message'=> $this->message['user.success'], 'token' => $token,'user_id'=> $userRow->id, 'new_user_flag' =>   $newUser]);

          }else{
            return response()->json(['success'=>false ,'message'=> $this->message['otp.invalid']]);
          }
        } else{
          return response()->json(['success'=>false ,'message'=> $this->message['user.error']]);
        }   /// else end

      }   /// verifyUser() end
  }

  public function updateUser(Request $request)
  {
    $user = $this->getUser();
    $filePath = NULL;
     // User Image Upload

       $data = $request->all();

       if(isset($data['user_image_data'])){
        $filePath = $this->saveImgFile($data['user_image_data'],$user->id);
       }
       // else{
       //    // if(isset($data['gender']) && $data['gender'] == 'F'){
       //    //   $filePath = '/uploads/users/default/user_female.png';
       //    // }else{
       //    //   $filePath = '/uploads/users/default/user_male.png';
       //    // }
       //  unset($data['user_image_data']);
       //  unset($data['user_image']);

       // }

    // End Image Upload

        $input = $request->json()->all();

        if(isset($data['user_image_data'])){
              $input['user_image'] = $filePath;
              unset($input['user_image_data']);
       }else{
        unset($input['user_image']);
       }

        

    if(isset($input['new_user_flag'])){
      $name = $input['name'];
      // FUNCTION TO GET AUTOGENERATED REFERAL CODE
      if($input['new_user_flag'])
        $input['code']  = $this->generateReferalCode($name);
      unset($input['new_user_flag']);
    }

    if(isset($input['relation_type']) && $input['relation_type'] != 10 && $input['relation_type'] != 30){
         unset($input['locality']);
    }

    $info = DB::table('user_info')
              ->where('user_id',  $user->id)
              ->update($input);



    return response()->json(['success'=>true , 'message' => $this->message['user.updated']]);

  }  // updateUser() end

  private function getUserToken($input)
  {
    $credentials  = array_only($input, ['phone', 'password']);
    $token = null;
    try {
     // attempt to verify the credentials and create a token for the user
     if (! $token = JWTAuth::attempt($credentials)) {
       return response()->json(['error' => 'invalid_credentials'], 401);
     }
    } catch (JWTException $e) {
       // something went wrong whilst attempting to encode the token
       return response()->json(['error' => 'could_not_create_token'], 500);
    }
    return $token;
  }

  public function generateReferalCode($name)
  {
    if(!empty($name)){
      $prefix = strtoupper(substr($name, 0, 4));
      $suffix =   mt_rand(1111,9999);
      return $prefix.$suffix;
    }
    return null;
  }

  private function generateOTP()
  {

              return mt_rand(1111,9999);


  }

  public function getReferalCode(){
    $user = $this->getUser();
    $userInfo = UserInfo::where([
                               ['user_id', '=', $user->id]
                                //,['invite_count', '!=', 0]
                               ])->first();
     return response()->json(['success'=>true , 'message' => 'Success','referal_code'=> $userInfo->code]);
  }

  // Fetch All the user Data
  public function getUserDetails(){
    $user = $this->getUser();
    $userInfo = UserInfo::join('app_users', 'user_info.user_id', '=', 'app_users.id')
            ->select('app_users.id','app_users.phone','app_users.coin_silver_base','app_users.coin_silver_promo','app_users.coin_silver_promo', 'user_info.*')
            ->where('app_users.id',$user->id)
            ->get();
    $user = $userInfo[0];
    $user->coin = $user->coin_silver_base + $user->coin_silver_promo;
    return response()->json(['success'=>true , 'message' => 'Success','data'=> $user]);
  }

  private function saveImgFile($data,$user_id){
     //get the base-64 from data
        $base64_str = substr($data, strpos($data, ",")+1);

        //decode base64 string
        $image = base64_decode($base64_str);
        $png_url = "u_".$user_id.".png";
        $folder = ceil($user_id/5000);
           $save_path = '/uploads/users/pic'.$folder.'/';
           $path = public_path('/uploads/users/pic'.$folder);
        
        //$save_path = '/uploads/users/y'.date('Y').'/m'.date('m').'/d'.date('d').'/';
        
        // $path = public_path('/uploads/' . $png_url);
        // $image1 = Image::make($image)->save($path);

        /*  $image = base64_decode($base64_str);
        $png_url = "user-".time().".png";
        $save_path = '/uploads/users/y'.date('Y').'/m'.date('m').'/d'.date('d').'/';

        $path = public_path('/uploads/users/y'.date('Y').'/m'.date('m').'/d'.date('d'));*/

       if(!File::exists($path)) {
          File::makeDirectory($path, 0777, true);
      }
        $path = public_path($save_path.$png_url);
        Image::make($image)->resize(100, 100)->save($path);
        return $save_path.$png_url;

  }

 



}
