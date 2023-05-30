<?php

use App\Http\Controllers\API\AccountingController;
use Illuminate\Support\Facades\Route;

        Route::get('accounting',[AccountingController::class ,'index']);
        Route::post('accounting/add',[AccountingController::class ,'store']);
        Route::put('accounting/update',[AccountingController::class ,'update']);
        Route::get('accounting/show',[AccountingController::class ,'show']);
        Route::delete('accounting/delete',[AccountingController::class ,'destroy']);
