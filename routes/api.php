<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\ElectionController;
use App\Http\Controllers\API\VoterController;
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
//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/elections', [ElectionController::class, 'index']);
Route::get('/elections/{election}', [ElectionController::class, 'show']);

Route::get('/elections/{election}/candidates', [CandidateController::class, 'index']);
Route::get('/elections/{election}/candidates/{candidate}', [CandidateController::class, 'show']);



Route::get('/elections/{election}/voters', [VoterController::class, 'index']);
Route::get('/elections/{election}/voters/{voter}', [VoterController::class, 'show']);


// Route::resource('elections', App\Http\Controllers\API\ElectionController::class);
