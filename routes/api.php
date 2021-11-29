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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('auth/register', [\App\Http\Controllers\Api\UserController::class,'register']);
Route::get('test',function (){
    return response()->json(['message'=>'test']);
});

Route::post('auth/login',[\App\Http\Controllers\Api\UserController::class,'login']);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user-info', [\App\Http\Controllers\Api\UserController::class,'getUserInfo']);
});


/* CRM agent */
Route::get('crm/get_agent_actived', [\App\Http\Controllers\Api\AgentController::class, 'getAgent']);
Route::post('crm/register_agent', [\App\Http\Controllers\Api\AgentController::class, 'registerAgent']);


Route::post('crm/register_customer', [\App\Http\Controllers\CustomerAPIController::class, 'registerCustomer']);
