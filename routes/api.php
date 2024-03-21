<?php

use App\Http\Controllers\RiderController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->group(function(){
    Route::post('/Registeration',[UserController::class, 'Register']);
    Route::post('/Login',[UserController::class,'login']);
});


Route::prefix('/riders')->group(function () {
    Route::post('/Registeration', [RiderController::class, 'Register']);
    Route::post('/Login', [RiderController::class, 'login']);
});

