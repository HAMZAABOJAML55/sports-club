<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users',[UserController::class ,'index']);
Route::post('user/add' , [UserController::class , 'store']);
Route::get('user/show/{id}',[UserController::class ,'show']);
Route::put('user/update/{id}',[UserController::class ,'update']);
Route::delete('user/delete/{id}',[UserController::class ,'destroy']);

