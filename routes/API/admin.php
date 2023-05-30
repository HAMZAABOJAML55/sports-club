<?php


use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('admins/logout' ,[AuthController::class , 'logout'])->middleware('auth:sanctum');
Route::get('admins',[AdminController::class ,'index']);

Route::post('admins/login' , [AdminController::class , 'store']);

