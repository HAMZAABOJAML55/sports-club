<?php

use App\Http\Controllers\API\NationalityController;
use Illuminate\Support\Facades\Route;

Route::get('nationality',[NationalityController::class ,'index']);
Route::get('nationality/show',[NationalityController::class ,'show']);
Route::delete('nationality/delete/$id',[NationalityController::class ,'delete']);
