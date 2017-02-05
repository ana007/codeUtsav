<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');

// });


    //Auth::routes();

    Route::get('/login', 'Admin\AuthController@getSignInPage'); 
    Route::post('/postSignIn', 'Admin\AuthController@postSignIn'); 
                 
       
    Route::get('/', 'Admin\AuthController@getSignInPage'); 

    Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () 
    { 
        # For logout
        Route::get('/logout', 'Admin\AuthController@getLogout');
         
        # Dashboard / Index
            Route::get('/home', array('as' => 'dashboard','uses' => 'Admin\GameController@index'));

        # Dashboard / Index
            Route::get('/', array('as' => 'dashboard','uses' => 'Admin\GameController@index'));

      # pomocode Management
    	 Route::group(array('prefix' => '/diseases'), function () { 
    	
             Route::get('/', ['uses' => 'Admin\PomocodeController@index']);
        	 Route::get('create', 'Admin\PomocodeController@create');
             Route::get('search','Admin\PomocodeController@search'); 
             Route::get('search/{serach?}','Admin\PomocodeController@search'); 
        	 Route::post('/create', 'Admin\PomocodeController@store'); 
        	 Route::get('{diseases}/edit', array('as' => 'code.edit', 'uses' => 'Admin\PomocodeController@edit')); 
        	 Route::post('{diseases}/edit', 'Admin\PomocodeController@update'); 
        	 Route::get('{diseases}/delete', array('as' => 'code.delete', 'uses' => 'Admin\PomocodeController@destroy')); 
        	 Route::get('{diseases}/confirm-delete', array('as' => 'code.confirm-delete', 'uses' => 'Admin\PomocodeController@getModalDelete'));
    	  });

        Route::get('/display', 'Admin\DisplayController@index'); 
        Route::get('display/{serach}','Admin\DisplayController@search'); 
        Route::get('/verify', 'Admin\VerifyController@index'); 
        Route::get('/verify/{id}', 'Admin\VerifyController@updateState'); 
        Route::get('/verify/state/{id}','Admin\VerifyController@state'); 
        Route::get('/verify/city/{id}','Admin\VerifyController@city');
        Route::get('/update/{id}','Admin\UpdateController@update');

    });

