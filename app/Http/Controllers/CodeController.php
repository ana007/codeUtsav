<?php

namespace App\Http\Controllers;

use App\Claimed;
use App\PromoCode;
use App\AppUser;
use App\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CodeController extends Controller {
  private $message = array('code.valid'     =>  'Success, it is valid code.',
                          'code.invalid'    =>  'Sorry, Invalid or Expired code.',
                          'code.claimed' =>  'Sorry , you already claimed.', 
                          'coin.claimed' => 'Coin Successfully Claimed.',
                          'coin.notClaimed' => 'Try again later.');

  public function verifyCode(Request $request)
  {
    /*
       IF code exist in PromoCode table (Normal code) THEN
        Check if Max Claim count not excceded & valid date range
        Get vendor advertisement form promo tabel
        return true
      else
        Check IF Code exist in UserInfo (Referal) column THEN
          Check if invite count not exceeded
            return true
          else
            return false
    */
    $input = $request->json()->all();
    $status = false;

    $code = PromoCode::where([['code', '=', $input['code']]] )->first();

    if(!empty($code)){
      $date = $this->getCurrentDateTime();
      if( $code->claim_count < $code->max_claim &&
         ($code->start_date <= $date  &&   $code->end_date >= $date) &&
         ($code ->type == 1)){
           $status = true;
      }
      else
          $status = false;
    }else{
      $userInfo = UserInfo::where([
                                ['code', '=',  $input['code']]
                                //,['invite_count', '!=', 0]
                                   ])->first();
      $status = empty($userInfo)? false:true;
    }

    if($status)
      return response()->json(['success'=>true , 'message' => $this->message['code.valid']]);

    return response()->json(['success'=>false , 'message' => $this->message['code.invalid']]);
  }


  public function redeemCode(Request $request)
  {
    $input = $request->json()->all();
    $code = PromoCode::where([['code', '=', $input['code']]] )->first();
     $user = $this->getUser();
     $vendorAd=$code ? $code->code_ad : NULL;
    if(empty($code))
    {
      return response()->json(['success'=>false , 'message' => $this->message['code.invalid']]);
    }else
    {
                     $currentdate = date("Y-m-d H:i:s");           // for currnet date and time
                     
              switch ($code->type)
                  {
                    case 1:        // FOR NORMAL TYPE


                    // IF CONDITION FOR CHECKING  CLAIM COUNT
                      if($code->claim_count < $code->max_claim && ($code->start_date == NULL ? true : ($code->start_date <= $currentdate  &&   $code->end_date >= $currentdate)) && $code->new_user_flag == 0){

                        
                       // IF CONDITION FOR CHECKING DATE BETWEEN START AND END DATE

                         // CEHCK IF USER NOT USING PROMOCODE AGAIN SO CHECK FROM CLAIM TABLE WITH CODE ID AND USER ID

                        $code_id = $code->id;
                        $user_id = $user->id;

                         $present = Claimed::where([
                                    ['code_id', '=', $code_id],
                                    ['user_id', '=', $user_id]
                                ])->first();

                        if(empty($present)){
                          // claim_count attempt increase
                               $claim_attempt = $code->claim_count;
                                DB::table('promo_codes')
                                    ->where('code', $input['code'])
                                        ->update(['claim_count' => $claim_attempt+1]);

                                            // CREATE CLAIM TABLE TRANSACTIONS
                                                     DB::table('code_claim')->insert(
                                                                    [ 'user_id' =>  $user_id,
                                                                      'code_id' =>  $code_id,
                                                                      'datetime' =>  $currentdate,
                                                                    ]
                                                                );

                                  //  ADDING COIN TO USER TABLE BY GETTING COIN FROM PROMOCODE

                                         $user_coin = $code->coin_count;

                                         $current_coin = $user->coin_silver_promo;
                                         AppUser::where('id', $user->id)
                                                   ->update(['coin_silver_promo' => $current_coin+$user_coin]);

                                  // CHECKING AD FROM PRMO TABEL TO RETURN ADVERTISEMENT
                                                   if(empty($code->code_ad))
                                                   {
                                                        $vendorAd = "no advertisement"; 
                                                   }

                                                    // function to get total available coin
                                                      $totalcoin = $this->getCoin();

                                    return response()->json(['success'=>true , 'message' => $this->message['code.valid'] ,'coin' => $totalcoin ,'vendorAd' => $vendorAd]);

                             } // CLOSE IF
                             else{
                                     return response()->json(['success'=>false ,'message'=> $this->message['code.claimed']]);
                             }

                      }else{
                          return response()->json(['success'=>false ,'message'=> $this->message['code.invalid']]);
                      }



                       break;
                       case 3:        // FOR USER TYPE
                        if($code->claim_count < $code->max_claim && ($code->start_date <= $currentdate  &&   $code->end_date >= $currentdate) && strpos($code->user_id, ','.(string)$user->id.',') != false ){

                                  // CEHCK IF USER NOT USING PROMOCODE AGAIN SO CHECK FROM CLAIM TABLE WITH CODE ID AND USER ID

                        $code_id = $code->id;
                        $user_id = $user->id;

                         $present = Claimed::where([
                                    ['code_id', '=', $code_id],
                                    ['user_id', '=', $user_id]
                                ])->first();

                        if(empty($present)){

                          // claim_count attempt increase
                               $claim_attempt = $code->claim_count;
                                DB::table('promo_codes')
                                    ->where('code', $input['code'])
                                        ->update(['claim_count' => $claim_attempt+1]);

                                            // CREATE CLAIM TABLE TRANSACTIONS

                                                     DB::table('code_claim')->insert(
                                                                    [ 'user_id' =>  $user_id,
                                                                      'code_id' =>  $code_id,
                                                                      'datetime' =>  $currentdate,
                                                                    ]
                                                                );

                                  //  ADDING COIN TO USER TABLE BY GETTING COIN FROM PROMOCODE
                                         $user_coin = $code->coin_count;
                                         $current_coin = $user->coin_silver_promo;
                                         AppUser::where('id', $user->id)
                                                   ->update(['coin_silver_promo' => $current_coin+$user_coin]);

                                        // CHECKING AD FROM PRMO TABEL TO RETURN
                                                   if(empty($code->code_ad))
                                                   {
                                                        $vendorAd = "no advertisement"; 
                                                   }

                                                    // function to get total available coin
                                                      $totalcoin = $this->getCoin();

                                    return response()->json(['success'=>true , 'message' => $this->message['code.valid'] ,'coin' => $totalcoin ,'vendorAd' => $vendorAd]);

                        }else{

                                    return response()->json(['success'=>false ,'message'=> $this->message['code.claimed']]);
                                 }
                         }else{
                          return response()->json(['success'=>false ,'message'=> $this->message['code.invalid']]);
                      }
      }
      //no case handled
      return response()->json(['success'=>false , 'message' => $this->message['code.invalid']]);
    }   
}      // end redeemCode function

public function claimCoin(){
        $user = $this->getUser();
        $date = $this->getCurrentDateTime();
        $date1 = date('Y-m-d H:i:s',strtotime("-1 hours"));
        if($date1 > $user->last_claimed || !isset($user->last_claimed)) {
              $user->increment('coin_silver_promo',20,['last_claimed' => $date]);
              $user = $this->getUser();
              $totalcoin = $this->getCoin();
              $date2 = date_create($user->last_claimed);
              $date3 = date_create(date('Y-m-d H:i:s',strtotime("+2 hours")));
              $interval = date_diff($date2, $date3);
              $h = $interval->format('%H');
              $i = $interval->format('%i'); 
              $s = $interval->format('%s');
              $this->message['coin.claimed'] = "Keep Playing you have got ".$totalcoin." coin";
             return response()->json(['success'=>true ,'message'=> $this->message['coin.claimed'],'coin' => $totalcoin,'h'=>$h,'i'=>$i,'s'=>$s]);
           } 
        else{ 
              $totalcoin = $this->getCoin();
              $date2 = date_create($user->last_claimed);
              $date3 = date_create($date1);
              $interval = date_diff($date3, $date2);
              $h = $interval->format('%H');
              $i = $interval->format('%i');
              $s = $interval->format('%s');
             return response()->json(['success'=>false ,'message'=> $this->message['coin.notClaimed'],'coin' => $totalcoin,'h'=>$h,'i'=>$i,'s'=>$s]);
        }
      }

 // get coin function

     public function getCoin(){
         $user = $this->getUser();
         $rowcoin = AppUser::select('coin_silver_base','coin_silver_promo')->where('id',$user->id)->first();
         $totalcoin = $rowcoin->coin_silver_base + $rowcoin->coin_silver_promo;
     return $totalcoin;
  }


}
