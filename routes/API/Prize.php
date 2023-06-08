<?php

use App\Http\Controllers\API\PrizesController;
use Illuminate\Support\Facades\Route;

        Route::get('Prize',[PrizesController::class ,'index']);
        Route::get('Prize/show',[PrizesController::class ,'show']);
        Route::delete('Prize/delete',[PrizesController::class ,'destroy']);
