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
	Route::get('docs', 'DocsController@index')->name('api_docs');
    Route::get('/', 'CommentController@dashboard')->name('dashboard');
    Route::get('comments', 'CommentController@index')->name('comments');
	Route::get('tokens', 'Auth\PassportController@tokens')->name('tokens');
    Route::get('comments/all', 'CommentController@display')->name('all_comments');
    Route::get('comments/weekly', 'CommentController@getThisWeeksComments')->name('weekly_comments');
	Route::get('comments/{id}/image', 'CommentController@fetchCommentImageById')->name('comment_image');
    Route::get('comments/{id}/toggle', 'CommentController@toggleCommentApproval')->name('comment_toggle');
    Route::get('comments/{email}/email', 'CommentController@returnCommentsWithSimilarEmails')->name('comments_by_email');
	Route::get('comments/daterange/{start}/{end}', 'CommentController@returnCommentsBetweenDates')->name('comments_by_date');
});
// ---------------------------------------------------------------------------------------------------
