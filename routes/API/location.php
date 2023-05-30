<?php

use App\Http\Controllers\API\LocationController;
use Illuminate\Support\Facades\Route;

        Route::get('location',[LocationController::class ,'index']);
        Route::post('location/add',[LocationController::class ,'store']);
        Route::put('location/update',[LocationController::class ,'update']);
        Route::get('location/show',[LocationController::class ,'show']);
        Route::delete('location/delete',[LocationController::class ,'delete']);
