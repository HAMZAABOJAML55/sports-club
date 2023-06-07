<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'v1' ,'namspace'=>'API'], function()
{
    Route::post('register' ,[AuthController::class , 'register'] );
    Route::post('login' ,[AuthController::class , 'login'] );
    Route::post('logout' ,[AuthController::class , 'login'] );
}
);

Route::group(['prefix'=>'v1' ,'namspace'=>'API'], function()
{
    require 'API\user.php';
    require 'API\location.php';
    require 'API\nationality.php';
    require 'API\SubLocation.php';
    require 'API\team.php';
    require 'API\Prize.php';
    require 'API\tournament.php';
    require 'API\gender.php';
    require 'API\Coach.php';
    require 'API\player.php';
    require 'API\accounting.php';
    require 'API\section.php';
    require 'API\Product.php';
    require 'API\Subscribe.php';
    require 'API\employee.php';
    require 'API\Food.php';


}

);
