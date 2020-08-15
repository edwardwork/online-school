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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'topics'], function () {

    Route::get('/', 'TopicController@index')->name('list_topics');

    Route::get('/create', 'TopicController@create');

    Route::get('/edit/{topic}', 'TopicController@edit');

    Route::get('/{topic}', 'TopicController@show')->name('show_topic');

    Route::post('/', 'TopicController@store');

    Route::put('/{topic}', 'TopicController@update');

    Route::delete('/{topic}', 'TopicController@destroy');

});

Route::group(['prefix' => 'lessons'], function () {

    Route::post('/getQuestionsAndAnswers', 'LessonController@getQuestionsAndAnswers')->name('loadData');

    Route::get('/create/{topic_id}', 'LessonController@create');

    Route::get('/{lesson_id}', 'LessonController@show')->name('show_lesson');

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

Route::get('/home', 'HomeController@index')->name('home');
