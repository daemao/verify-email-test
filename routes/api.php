<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1/auth')->group(function (){
    Route::post('/login',[\App\Http\Controllers\v1\Auth\LoginController::class,'index']);
    Route::post('/email-verify',[\App\Http\Controllers\v1\Auth\EmailVerifyController::class,'index']);
    Route::post('/sign-up',[\App\Http\Controllers\v1\Auth\SignUpController::class,'index']);
});
