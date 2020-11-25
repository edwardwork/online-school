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

Route::view('/', 'index')->name('home');

Route::redirect('/home', '/');

Route::group(['prefix' => 'topics', 'middleware' => 'auth'], function () {
    Route::get('/', 'TopicController@index')->name('topics.list');
    Route::get('/{topic}', 'TopicController@show')->name('topics.show');
});

Route::group(['prefix' => 'lessons', 'middleware' => 'auth'], function () {
    Route::post('/getQuestionsAndAnswers', 'LessonController@getQuestionsAndAnswers')->name('loadData');
    Route::get('/create/{topic_id}', 'LessonController@create');
    Route::get('/{lesson_id}', 'LessonController@show')->name('lessons.show');
    Route::post('/', 'LessonController@store');
    Route::put('/{lesson}', 'LessonController@update');
    Route::delete('/{lesson}', 'LessonController@destroy');
});

Route::group(['prefix' => 'userStatus'], function () {
    Route::post('/', 'UserStatusController@store');
    Route::post('/update', 'UserStatusController@update');
    Route::post('/updateDuration', 'UserStatusController@updateDuration');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/{category}', 'CategoryController@show');
});

Route::get('/introduction', 'IntroductionVideoController@index');

Auth::routes();
