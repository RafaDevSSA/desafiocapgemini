<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST,GET,PUT,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/account',['as'=>'save-account','uses'=>'AccountController@save']);
    Route::post('/account/login',['as'=>'get-account','uses'=>'AccountController@login']);
    Route::post('/account/balance',['as'=>'balance-account','uses'=>'AccountController@balance']);
    Route::post('/account/deposit',['as'=>'deposit-account','uses'=>'AccountController@deposit']);
    Route::post('/account/withdraw',['as'=>'withdraw-account','uses'=>'AccountController@withdraw']);
