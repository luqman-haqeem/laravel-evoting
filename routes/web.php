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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::post('/voters/import', 'VoterController@import')->name('voters.import');
Route::resource('voters', 'VoterController');

Route::get('/elections/{election}/candidates/','CandidateController@index')->name('candidates.index');
Route::post('/elections/{election}/candidates/','CandidateController@store')->name('candidates.store');
Route::get('/elections/{election}/candidates/create','CandidateController@create')->name('candidates.create');
Route::get('/elections/{election}/candidates/{candidate}','CandidateController@edit')->name('candidates.edit');
Route::put('/elections/{election}/candidates/{candidate}','CandidateController@update')->name('candidates.update');
Route::delete('/elections/{election}/candidates/{candidate}','CandidateController@destroy')->name('candidates.delete');

Route::post('/upload','CandidateController@uploadimage');

// Route::resource('candidates', 'CandidateController');
Route::resource('elections', 'ElectionController');


Route::get('/about', function () {
    return view('about');
})->name('about');
