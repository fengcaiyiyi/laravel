<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::any('/feimo/main', ['as' => 'feimo/main', 'uses' => "IndexController@main"]);
    Route::any('/feimo', ['as' => 'feimo', 'uses' => 'IndexController@index']);
    Route::any('/feimo/addArticle', ['as' => 'feimo/addArticle', 'uses' => 'ArticleController@addartcile']);
    Route::any('/feimo/category', ['as' => 'feimo/category', 'uses' => 'CategoryController@index']);
    Route::match(['get', 'post'], 'feimo/addCategory', ['as' => 'feimo/addCategory', 'uses' => 'CategoryController@addCategory']);
    Route::match(['get', 'post'], 'feimo/editCategory/{id}', ['as' => 'feimo/editCategory', 'uses' => 'CategoryController@editCategory']);
    Route::match(['get', 'post'], 'feimo/delCategory/{id}', ['as' => 'feimo/delCategory', 'uses' => 'CategoryController@delCategory']);
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
