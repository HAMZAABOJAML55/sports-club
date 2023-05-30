<?php
use App\Http\Controllers\API\FoodsController;
use Illuminate\Support\Facades\Route;

        Route::get('Food',[FoodsController::class ,'index']);
        Route::post('Food/add',[FoodsController::class ,'store']);
        Route::put('Food/update',[FoodsController::class ,'update']);
        Route::get('Food/show',[FoodsController::class ,'show']);
        Route::delete('Food/delete',[FoodsController::class ,'destroy']);
