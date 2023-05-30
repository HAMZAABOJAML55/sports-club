<?php

use App\Http\Controllers\API\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('section' , [SectionController::class , 'index']);
Route::get('section/show' , [SectionController::class , 'show']);
Route::post('section/add' , [SectionController::class , 'store']);
Route::put('section/update' , [SectionController::class , 'update']);
Route::delete('section/delete' , [SectionController::class , 'destroy']);


