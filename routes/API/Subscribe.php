<?php

use App\Http\Controllers\API\SubscripesController;
use Illuminate\Support\Facades\Route;

        Route::get('subscripe',[SubscripesController::class ,'index']);
//        Route::post('subscripe/add',[SubscripesController::class ,'store']);
//        Route::put('subscripe/update/{id}',[SubscripesController::class ,'update']);
        Route::get('subscripe/show',[SubscripesController::class ,'show']);
        Route::delete('subscripe/delete',[SubscripesController::class ,'destroy']);
