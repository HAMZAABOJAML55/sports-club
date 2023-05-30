<?php

use App\Http\Controllers\API\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('employee',[EmployeeController::class ,'index']);
Route::get('employee/show',[EmployeeController::class ,'show']);
Route::post('employee/add',[EmployeeController::class ,'store']);
Route::put('employee/update',[EmployeeController::class ,'update']);
Route::delete('employee/delete',[EmployeeController::class ,'destroy']);
