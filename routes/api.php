<?php

use App\Http\Controllers\API\AccountingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\CoachsController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\FoodsController;
use App\Http\Controllers\API\GenderController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\NationalityController;
use App\Http\Controllers\API\PlayersController;
use App\Http\Controllers\API\PrizesController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\Sub_LocationController;
use App\Http\Controllers\API\SubscripesController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TournamentController;
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



Route::group(['middleware' => ['api','auth:api'],'prefix'=>'v1' ,'namspace'=>'API'], function()
{
    Route::get('location',[LocationController::class ,'index']);
    Route::get('location/show',[LocationController::class ,'show']);
    Route::delete('location/delete',[LocationController::class ,'delete']);

    Route::get('nationality',[NationalityController::class ,'index']);
    Route::get('nationality/show',[NationalityController::class ,'show']);
    Route::delete('nationality/delete/$id',[NationalityController::class ,'delete']);

    Route::get('SubLocation',[Sub_LocationController::class ,'index']);
    Route::get('SubLocation/show',[Sub_LocationController::class ,'show']);
    Route::delete('SubLocation/delete',[Sub_LocationController::class ,'delete']);

    Route::get('team',[TeamController::class ,'index']);
    Route::post('team/add',[TeamController::class ,'store']);
    Route::put('team/update',[TeamController::class ,'update']);
    Route::get('team/show',[TeamController::class ,'show']);
    Route::delete('team/delete',[TeamController::class ,'delete']);

    Route::get('Prize',[PrizesController::class ,'index']);
    Route::get('Prize/show',[PrizesController::class ,'show']);
    Route::delete('Prize/delete',[PrizesController::class ,'destroy']);

    Route::get('tournament',[TournamentController::class ,'index']);
    Route::post('tournament/add',[TournamentController::class ,'store']);
    Route::put('tournament/update',[TournamentController::class ,'update']);
    Route::get('tournament/show',[TournamentController::class ,'show']);
    Route::delete('tournament/delete',[TournamentController::class ,'destroy']);

    Route::get('gender',[GenderController::class ,'index']);
    Route::post('gender/add',[GenderController::class ,'store']);
    Route::put('gender/update',[GenderController::class ,'update']);
    Route::get('gender/show',[GenderController::class ,'show']);
    Route::delete('gender/delete',[GenderController::class ,'delete']);

    Route::get('coach',[CoachsController::class ,'index']);
    Route::post('coach/add',[CoachsController::class ,'store']);
    Route::put('coach/update',[CoachsController::class ,'update']);
    Route::get('coach/show',[CoachsController::class ,'show']);
    Route::delete('coach/delete',[CoachsController::class ,'destroy']);

    Route::get('player' , [PlayersController::class , 'index']);
    Route::get('player/show' , [PlayersController::class , 'show']);
    Route::post('player/add' , [PlayersController::class , 'store']);
    Route::put('player/update' , [PlayersController::class , 'update']);
    Route::delete('player/delete' , [PlayersController::class , 'destroy']);

    Route::get('accounting',[AccountingController::class ,'index']);
    Route::post('accounting/add',[AccountingController::class ,'store']);
    Route::put('accounting/update',[AccountingController::class ,'update']);
    Route::get('accounting/show',[AccountingController::class ,'show']);
    Route::delete('accounting/delete',[AccountingController::class ,'destroy']);

    Route::get('section' , [SectionController::class , 'index']);
    Route::get('section/show' , [SectionController::class , 'show']);
    Route::post('section/add' , [SectionController::class , 'store']);
    Route::put('section/update' , [SectionController::class , 'update']);
    Route::delete('section/delete' , [SectionController::class , 'destroy']);

    Route::get('subscripe',[SubscripesController::class ,'index']);
//        Route::post('subscripe/add',[SubscripesController::class ,'store']);
//        Route::put('subscripe/update/{id}',[SubscripesController::class ,'update']);
    Route::get('subscripe/show',[SubscripesController::class ,'show']);
    Route::delete('subscripe/delete',[SubscripesController::class ,'destroy']);

    Route::get('employee',[EmployeeController::class ,'index']);
    Route::get('employee/show',[EmployeeController::class ,'show']);
    Route::post('employee/add',[EmployeeController::class ,'store']);
    Route::put('employee/update',[EmployeeController::class ,'update']);
    Route::delete('employee/delete',[EmployeeController::class ,'destroy']);

    Route::get('Food',[FoodsController::class ,'index']);
    Route::post('Food/add',[FoodsController::class ,'store']);
    Route::put('Food/update',[FoodsController::class ,'update']);
    Route::get('Food/show',[FoodsController::class ,'show']);
    Route::delete('Food/delete',[FoodsController::class ,'destroy']);

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

