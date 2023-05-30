<?php
use App\Http\Controllers\API\TournamentController;
use Illuminate\Support\Facades\Route;

Route::get('tournament',[TournamentController::class ,'index']);
        Route::post('tournament/add',[TournamentController::class ,'store']);
        Route::put('tournament/update',[TournamentController::class ,'update']);
        Route::get('tournament/show',[TournamentController::class ,'show']);
        Route::delete('tournament/delete',[TournamentController::class ,'destroy']);
