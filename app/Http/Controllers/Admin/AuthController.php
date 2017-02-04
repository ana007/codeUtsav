<?php

namespace App\Http\Controllers\Admin;

use App\IntUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
   

   

    public function getSignInPage()
    {
        return view('auth.login');
    }

   

    public function postSignIn(Request $request)
    {
       
       
          $input['email']= $request['email'];
          $input['password']= $request['password'];
        if(count($input) > 0){
            $auth = auth()->guard('roles');

            $credentials = [
                'email' =>  $input['email'],
                'password' =>  $input['password'],
            ];

            if ($auth->attempt($credentials)) {
                 return redirect('admin/home');                     
            } else {
                echo 'Error';
            }
        } else {
            return view('admin.login');
        }



    }

    public function getLogout()
    {
          Auth::logout();
           \Session::flush();
              return redirect('/login');
        
    }

  
}