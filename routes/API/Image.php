<?php
use App\Http\Controllers\API\ImagesController;
use Illuminate\Support\Facades\Route;

        Route::get('clients',[ImagesController::class ,'index']);
        Route::post('client/add',[ImagesController::class ,'store']);
        Route::put('client/{id}/update',[ImagesController::class ,'update']);
        Route::get('client/show/{id}',[ImagesController::class ,'show']);
        Route::delete('client/delete/{id}',[ImagesController::class ,'destroy']);
