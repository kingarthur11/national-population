<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Citizencontroller;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/authorised', function (Request $request) {
    return $response()->json(["status" => "failure", "message" => "unauthorised"]);
});

Route::prefix('user')->group(function() {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/signup', [UserController::class, 'signup']);
    
    Route::group( ['middleware' => 'auth:user-api' ],function(){
        Route::put('/register-citizens', [Citizencontroller::class, 'registerCitizen']);
        Route::get('/create-state', [Citizencontroller::class, 'createStates']);
        Route::post('/create-lga', [Citizencontroller::class, 'createLGA']);
        Route::get('/create-ward', [Citizencontroller::class, 'createWard']);
        Route::post('/getall-citizens', [Citizencontroller::class, 'getAllCitizins']);
        Route::post('/getall-citizens-inward', [Citizencontroller::class, 'getAllWardCitizins']);
        Route::get('/getall-citizens-inlag', [Citizencontroller::class, 'getAllLGACitizins']);
        Route::post('/getall-citizens-instate', [Citizencontroller::class, 'getAllStateCitizins']);

    });
});