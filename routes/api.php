<?php

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

// ---------------- OAUTH KEYGEN ROUTES ----------------
Route::post('login', 'Auth\PassportController@login');
Route::post('signup', 'Auth\PassportController@signup');
// -----------------------------------------------------

// ----------------- ROUTES PROTECTED BY PASSPORT -----------------
Route::group(['middleware' => 'auth:api'], function() {
	Route::resource('comments', 'CommentController');
	Route::get('categories', 'CategoryController@index');
	Route::get('approved', 'CommentController@approved');
});
// -----------------------------------------------------------------
