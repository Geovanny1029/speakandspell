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
    return view('index');
});

Route::resource('user','UserController');
Route::get('/login', 'LoginController@login')->name('login');
Auth::routes();

//menu de opciones index
Route::get('menu',[
			'uses' => 'UserController@menu',
			'as'   => 'user.menu'
]);

//lista inactivos
Route::get('inactivos',[
			'uses' => 'UserController@inactivos',
			'as'   => 'user.inactivos'
]);


//lista niveles
Route::get('listaNivel',[
			'uses' => 'UserController@listaNivel',
			'as'   => 'user.listaNivel'
]);

//form nivel
Route::get('altaLevel',[
			'uses' => 'UserController@createNivel',
			'as'   => 'user.createNivel'
]);

//alta nivel
Route::post('altaNivel',[
			'uses' => 'UserController@altaNivel',
			'as'   => 'user.altaNivel'
]);


Route::get('/home', 'HomeController@index')->name('home');

//dar baja alumno
Route::get('user/{id}/destroy',[
			'uses' => 'UserController@destroy',
			'as'   => 'user.destroy'
]);

//modal edit usuario
	Route::get('userse',[
			'uses' => 'UsersController@view',
			'as'   => 'users.view'
		]);


// actualiza alumno
		Route::post('usersu',[
			'uses' => 'UsersController@actualiza',
			'as'   => 'users.actualiza'
		]);
