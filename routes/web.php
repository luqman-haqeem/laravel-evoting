<?php

use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {


    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'ElectionController@index')->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // Route::post('/voters/import', 'VoterController@import')->name('voters.import');
    // Route::resource('voters', 'VoterController');

    Route::resource('elections', 'ElectionController');

    // Candidate
    Route::get('/elections/{election}/candidates/', 'CandidateController@index')->name('candidates.index');
    Route::post('/elections/{election}/candidates/', 'CandidateController@store')->name('candidates.store');
    Route::get('/elections/{election}/candidates/create', 'CandidateController@create')->name('candidates.create');
    Route::get('/elections/{election}/candidates/{candidate}', 'CandidateController@edit')->name('candidates.edit');
    Route::put('/elections/{election}/candidates/{candidate}', 'CandidateController@update')->name('candidates.update');
    Route::put('/elections/{election}/candidates-image/{candidate}', 'CandidateController@update_image')->name('candidates.update_image');
    Route::delete('/elections/{election}/candidates/{candidate}', 'CandidateController@destroy')->name('candidates.delete');

    // Voter
    Route::get('/elections/{election}/voters/', 'VoterController@index')->name('voters.index');
    Route::post('/elections/{election}/voters/', 'VoterController@store')->name('voters.store');
    Route::get('/elections/{election}/voters/create', 'VoterController@create')->name('voters.create');
    Route::get('/elections/{election}/voters/{voter}', 'VoterController@edit')->name('voters.edit');
    Route::put('/elections/{election}/voters/{voter}', 'VoterController@update')->name('voters.update');
    Route::delete('/elections/{election}/voters/{voter}', 'VoterController@destroy')->name('voters.destroy');
    Route::post('/elections/{election}/voters/import', 'VoterController@import')->name('voters.import');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});
