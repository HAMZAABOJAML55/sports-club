<?php

use App\Http\Controllers\API\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('team',[TeamController::class ,'index']);
    Route::post('team/add',[TeamController::class ,'store']);
    Route::put('team/update',[TeamController::class ,'update']);
    Route::get('team/show',[TeamController::class ,'show']);
    Route::delete('team/delete',[TeamController::class ,'delete']);
