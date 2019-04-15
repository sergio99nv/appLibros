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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return view('spa/index');
});


///Route::get('/getData', 'SetDataCtrl@getData');


// users admin
//Route::group("usersAdmin")

//Route::get('/usersAdmin', 'UserAdminCtrl@index');
//Route::get('/getData', 'UserAdminCtrl@getData');

 
Route::group(['prefix'=>'admins'], function(){

    Route::group(['prefix'=>'users'], function(){
        Route::get('/',  'Admins\AdminCtrl@index');

        Route::post('/getAll',  'Admins\AdminCtrl@getAll');
    });

    Route::group(['prefix'=>'books'], function(){

        Route::group(['prefix'=>'categories'], function(){
            Route::get('/',  'Admins\BookCategoryCtrl@index');
            Route::post('/getAll',  'Admins\BookCategoryCtrl@getAll');
            Route::post('/store',  'Admins\BookCategoryCtrl@store');
            Route::post('/update',  'Admins\BookCategoryCtrl@update');
       });
    });
});
