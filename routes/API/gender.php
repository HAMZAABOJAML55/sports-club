<?php

use App\Http\Controllers\API\GenderController;
use Illuminate\Support\Facades\Route;

Route::get('gender',[GenderController::class ,'index']);
Route::post('gender/add',[GenderController::class ,'store']);
Route::put('gender/update',[GenderController::class ,'update']);
Route::get('gender/show',[GenderController::class ,'show']);
Route::delete('gender/delete',[GenderController::class ,'delete']);
