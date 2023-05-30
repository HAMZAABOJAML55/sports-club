<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

        Route::get('product',[ProductController::class ,'index']);
        Route::post('product/add',[ProductController::class ,'store']);
        Route::put('product/update',[ProductController::class ,'update']);
        Route::get('product/show',[ProductController::class ,'show']);
        Route::delete('product/delete',[ProductController::class ,'destroy']);
