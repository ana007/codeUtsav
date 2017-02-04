<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/v1/locations','LocalityController@locations');
Route::get('/v1/faq','FaqController@faq');

Route::post('auth','Api\AuthController@authenticate');
Route::post('v1/verifyCode','CodeController@verifyCode');
Route::post('/v1/register','UserController@register');
Route::post('/v1/reSendOTP','UserController@reSendOtp');
Route::post('/v1/verifyUser','UserController@verifyUser');

Route::group(['middleware' => 'jwt.auth'], function () {
	Route::post('/v1/getcodedetail','CodeController@getCodeDetail');
	Route::post('/v1/updateUser','UserController@updateUser');
});

Route::get('/disease','DiseaseController@getDisease');
Route::post('/updateDiseaseCount','DiseaseController@insertDisease');
Route::post('/addUser','DiseaseController@addUser');
Route::post('/getStates','DiseaseController@getStates');
Route::post('/getCities','DiseaseController@getCities');

Route::get('/user', function (Request $request) {
    return $request->user();
});


