<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
--------------------------------------------------------------------------
 API Routes
--------------------------------------------------------------------------


 Here is where you can register API routes for your application. These
 routes are loaded by the RouteServiceProvider and all of them will
 be assigned to the "api" middleware group. Make something great!
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('registration', [AuthController::class , 'registration']);
Route::get('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('addOrder', [OrderController::class, 'addOrder']);  
Route::get('showOrder', [OrderController::class, 'showOrder']);