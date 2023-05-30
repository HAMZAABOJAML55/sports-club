<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('logout' ,[AuthController::class , 'logout'])->middleware('auth:sanctum');
Route::get('users',[UserController::class ,'index']);
Route::post('user/add' , [UserController::class , 'store']);
Route::get('user/show/{id}',[UserController::class ,'show']);
Route::put('user/update/{id}',[UserController::class ,'update']);
Route::delete('user/delete/{id}',[UserController::class ,'destroy']);

