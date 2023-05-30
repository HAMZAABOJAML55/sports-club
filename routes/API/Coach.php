<?php

use App\Http\Controllers\API\CoachsController;
use Illuminate\Support\Facades\Route;

        Route::get('coach',[CoachsController::class ,'index']);
        Route::post('coach/add',[CoachsController::class ,'store']);
        Route::put('coach/update',[CoachsController::class ,'update']);
        Route::get('coach/show',[CoachsController::class ,'show']);
        Route::delete('coach/delete',[CoachsController::class ,'destroy']);
