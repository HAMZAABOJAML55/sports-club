<?php


use App\Http\Controllers\API\PlayersController;
use Illuminate\Support\Facades\Route;

Route::get('player' , [PlayersController::class , 'index']);
Route::get('player/show' , [PlayersController::class , 'show']);
Route::post('player/add' , [PlayersController::class , 'store']);
Route::put('player/update' , [PlayersController::class , 'update']);
Route::delete('player/delete' , [PlayersController::class , 'destroy']);


