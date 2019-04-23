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


Route::get('/login',  'Students\LoginCtrl@index');
Route::post('/login/validateLogin',  'Students\LoginCtrl@validateLogin');
Route::get('/login/closeSession',  'Students\LoginCtrl@closeSession');

Route::group(['prefix'=>'register'], function(){
    Route::get('/',  'Students\RegisterCtrl@index');
    Route::post('/store',  'Students\RegisterCtrl@store');
    Route::get('/sussess',  'Students\RegisterCtrl@sussess');

    Route::post('/checkField',  'Students\RegisterCtrl@checkField');
    
});

/**
 *  Rutas del estudiante
 * 
 */
// Route::group(['middleware' => 'StudentSession'],function(){  
// });
    
    Route::get('/categories/list',  'Students\AppCtrl@index');


    Route::get('/categories/',  'Students\BookCategoryCtrl@getCategories');
    Route::get('/categories/listbooks/{categoryId}',  'Students\BookCategoryCtrl@getCategories');
    Route::get('/categories/listbooks/{categoryId}/{nombre?}/{author?}',  'Students\BookCategoryCtrl@getCategories');


    Route::get('/categories/book/{bookId}',  'Students\BookCategoryCtrl@getBook');


   
 


/**
 *  Rutas del administrador
 * 
 */
Route::group(['prefix'=>'admins'], function(){
    Route::group(['prefix'=>'login'], function(){
        Route::get('/',  'Admins\LoginCtrl@index');
        Route::post('/validateLogin',  'Admins\LoginCtrl@validateLogin');
        Route::get('/closeSession',  'Admins\LoginCtrl@closeSession');
    });

    
    //middleware
    Route::group(['middleware' => 'AdminSession'],function(){  


        Route::get('/main',  'Admins\MainCtrl@index');
        //usuarios
        Route::group(['prefix'=>'users'], function(){
            Route::get('/',  'Admins\AdminCtrl@index');
            Route::post('/getAll',  'Admins\AdminCtrl@getAll');
        });


        //categorias de libros
        Route::group(['prefix'=>'bookCategories'], function(){
            
            Route::group(['prefix'=>'/'], function(){
                Route::get('/',  'Admins\BookCategoryCtrl@index');
                Route::post('/getAll',  'Admins\BookCategoryCtrl@getAll');
                Route::post('/store',  'Admins\BookCategoryCtrl@store');
                Route::post('/update',  'Admins\BookCategoryCtrl@update');
            });


            Route::group(['prefix'=>'/books'], function(){
                Route::get('/',  'Admins\BookCtrl@index');
                Route::get('/test',  'Admins\BookCtrl@test');
                Route::post('/getAll',  'Admins\BookCtrl@getAll');
                Route::post('/store',  'Admins\BookCtrl@store');
                Route::post('/update',  'Admins\BookCtrl@update');
                Route::post('/storeCover',  'Admins\BookCtrl@storeCover');
                Route::post('/storeFile',  'Admins\BookCtrl@storeFile');
            });
         });
    });//fin middleware

});



/*Route::get('storageBook/{filename}', function ($filename)
{
    $path = storage_path('app/public/adminBooks/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});*/


