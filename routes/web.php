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

Route::redirect('/', '/categories');
Route::redirect('/home', '/categories')->name('home');

Route::group(['prefix' => 'topics', 'middleware' => 'auth'], function () {

    Route::get('/', 'TopicController@index')->name('topics.list');

    Route::get('/create', 'TopicController@create');

    Route::get('/edit/{topic}', 'TopicController@edit');

    Route::get('/{topic}', 'TopicController@show')->name('topics.show');

    Route::post('/', 'TopicController@store');

    Route::put('/{topic}', 'TopicController@update');

    Route::delete('/{topic}', 'TopicController@destroy');

});

Route::group(['prefix' => 'lessons', 'middleware' => 'auth'], function () {

    Route::get('/{lesson}', 'LessonController@show')->name('lesson.show');

});

Route::group(['prefix' => 'userStatus', 'middleware' => 'auth'], function () {

    Route::post('/', 'UserStatusController@store');

    Route::post('/update', 'UserStatusController@update');

    Route::post('/updateDuration', 'UserStatusController@updateDuration');

});

Route::group(['prefix' => 'categories', 'middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@showCategories')->name("category.list");

    Route::get('/{category}', 'HomeController@showCategory')->name("category.show");

});

Route::get('/introduction', 'IntroductionVideoController@index');

Auth::routes();
