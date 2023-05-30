<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\Sub_LocationController;
use Illuminate\Support\Facades\Route;

        Route::get('SubLocation',[Sub_LocationController::class ,'index']);
        Route::post('SubLocation/add',[Sub_LocationController::class ,'store']);
        Route::put('SubLocation/update',[Sub_LocationController::class ,'update']);
        Route::get('SubLocation/show',[Sub_LocationController::class ,'show']);
        Route::delete('SubLocation/delete',[Sub_LocationController::class ,'delete']);
