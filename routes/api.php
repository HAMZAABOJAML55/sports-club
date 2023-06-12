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

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/login', function () {
    echo 'some thing went wrong';
});

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'v1'], function ($router) {
    Route::post('login/admin' ,'App\Http\Controllers\API\AuthController@login')->withoutMiddleware('auth:api');
    Route::post('logout/admin', 'App\Http\Controllers\API\AuthController@logout');
    Route::post('refresh/admin', 'App\Http\Controllers\API\AuthController@refresh');
    Route::get('userProfile/admin', 'App\Http\Controllers\API\AuthController@userProfile');
});



Route::group(['middleware' => ['auth:api'],'prefix'=>'v1' ,'namspace'=>'API'], function()
{
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


Route::group(['middleware' => ['api', 'auth:api_player'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/player', 'App\Http\Controllers\API\player\PlayerController@login')->withoutMiddleware('auth:api_player');;
    Route::post('register/player', 'App\Http\Controllers\API\player\PlayerController@register')->withoutMiddleware('auth:api_player');
    Route::post('logout/player', 'App\Http\Controllers\API\player\PlayerController@logout');
    Route::post('refresh/player', 'App\Http\Controllers\API\player\PlayerController@refresh');
    Route::post('myData/player', 'App\Http\Controllers\API\player\PlayerController@myData');
});


Route::group(['middleware' => ['api', 'auth:api_coach'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/coach', 'App\Http\Controllers\API\coach\CoachController@login')->withoutMiddleware('auth:api_coach');;
    Route::post('register/coach', 'App\Http\Controllers\API\coach\CoachController@register')->withoutMiddleware('auth:api_coach');
    Route::post('logout/coach', 'App\Http\Controllers\API\coach\CoachController@logout');
    Route::post('refresh/coach', 'App\Http\Controllers\API\coach\CoachController@refresh');
    Route::post('myData/coach', 'App\Http\Controllers\API\coach\CoachController@myData');
});

Route::group(['middleware' => ['api', 'auth:api_employe'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/employee', 'App\Http\Controllers\API\employee\EmployeeController@login')->withoutMiddleware('auth:api_employe');;
    Route::post('register/employee', 'App\Http\Controllers\API\employee\EmployeeController@register')->withoutMiddleware('auth:api_employe');
    Route::post('logout/employee', 'App\Http\Controllers\API\employee\EmployeeController@logout');
    Route::post('refresh/employee', 'App\Http\Controllers\API\employee\EmployeeController@refresh');
    Route::post('myData/employee', 'App\Http\Controllers\API\employee\EmployeeController@myData');
});

