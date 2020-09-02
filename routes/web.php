<?php

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

Auth::routes();

// ---------------------------------------- DASHBOARD ROUTES ----------------------------------------
Route::group(['middleware' => ['auth']], function() {
	Route::get('docs', 'DocsController@index');
    Route::get('/', 'CommentController@dashboard');
    Route::get('comments', 'CommentController@index');
	Route::get('tokens', 'Auth\PassportController@tokens');
    Route::get('comments/all', 'CommentController@display');
    Route::get('comments/weekly', 'CommentController@getThisWeeksComments');
	Route::get('comments/{id}/image', 'CommentController@fetchCommentImageById');
    Route::get('comments/{id}/toggle', 'CommentController@toggleCommentApproval');
    Route::get('comments/{email}/email', 'CommentController@returnCommentsWithSimilarEmails');
	Route::get('comments/daterange/{start}/{end}', 'CommentController@returnCommentsBetweenDates');
});
// ---------------------------------------------------------------------------------------------------
