<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{postid}', 'HomeController@showPost')->name('post');
Route::get('/', 'HomeController@index')->name('home');

Route::resource('test/res', 'ControllerM');
Route::any('test/viewjson', 'ControllerM\\ControllerM@ViewJson');
Route::any('testdir', '\\Tests\\Unit\\Controllerm\\CrudTestController@ViewJson');
Route::any('test/taskChange/{task}', 'ControllerM@taskChange');
Auth::routes();

Route::group(['prefix' => '/backend', 'middleware' => ['auth', 'roles'], 'roles' => 'manager'], function () {
  Route::get('/', 'manager\\PostsController@index');  
});


//workadmin---------------------------------------------------------------
Route::group(['prefix' => '/manager', 'middleware' => ['auth', 'roles'], 'roles' => 'manager'], function () {
    Route::get('/', 'manager\\PostsController@index');
    Route::resource('/posts', 'manager\\PostsController');
    Route::get('/posts/del', 'manager\\PostsController@del');
    Route::get('/posts/pub{id}', 'manager\\PostsController@pub');
    Route::get('/posts/unpub{id}', 'manager\\PostsController@unpub');
    //Route::any('/posts/upload', 'manager\\PostsController@upload');
});

Route::group(['middleware' => config('laradrop.middleware') ? config('laradrop.middleware') : null], function () {
    
    Route::get('laradrop/containers', [
        'as' => 'laradrop.containers',
        'uses' => 'Jasekz\\Laradrop\\Http\\Controllers\\LaradropController@getContainers'
    ]);
    
    Route::post('laradrop/move', [
        'as' => 'laradrop.move',
        'uses' => 'Jasekz\\Laradrop\\Http\\Controllers\\LaradropController@move'
    ]);
    
    Route::post('laradrop/create', [
        'as' => 'laradrop.create',
        'uses' => 'Jasekz\\Laradrop\\Http\\Controllers\\LaradropController@create'
    ]);
    
    Route::resource('laradrop', 'Jasekz\\Laradrop\\Http\\Controller\\LaradropController');
    
});
