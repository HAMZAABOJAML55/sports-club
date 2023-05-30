<?php

use App\Http\Controllers\API\NationalityController;
use Illuminate\Support\Facades\Route;

Route::get('nationality',[NationalityController::class ,'index']);
Route::post('nationality/add',[NationalityController::class ,'store']);
Route::put('nationality/update',[NationalityController::class ,'update']);
Route::get('nationality/show/$id',[NationalityController::class ,'show']);
Route::delete('nationality/delete/$id',[NationalityController::class ,'delete']);
