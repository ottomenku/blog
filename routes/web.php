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

\Route::any('test/taskChange/{task}', 'ControllerM@taskChange');
Auth::routes();


Route::get('admin', 'Admin\AdminController@index');

//workadmin---------------------------------------------------------------
Route::group(['prefix' => '/workadmin', 'middleware' => ['auth', 'roles'], 'roles' => 'workadmin'], function () {

    Route::resource('/workertimes', 'Workadmin\\WorkertimesController');
    Route::resource('/workerdays', 'Workadmin\\WorkerdaysController');

    Route::any('/wroles/addtime/{wroleid}', 'Workadmin\\WrolesController@addtime');
    Route::any('/wroles/deltime/{timeid}/{wroleid}', 'Workadmin\\WrolesController@deltime');
});
//worker---------------------------------------------------------------
Route::group(['prefix' => '/worker', 'middleware' => ['auth', 'roles'], 'roles' => 'worker'], function () {
    Route::resource('/workertimes', 'Worker\\WorkertimesController');
    Route::resource('/workerdays', 'Worker\\WorkerdaysController');
    Route::resource('/naptar', 'Worker\\NaptarController');

});
