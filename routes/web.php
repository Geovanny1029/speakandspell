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
Route::get('/login', 'LoginController@login')->name('
	');
Auth::routes();

//menu de opciones index
Route::get('menu',[
			'uses' => 'UserController@menu',
			'as'   => 'user.menu'
]);

//opcion de nivel horario
Route::get('user/horario/{id}','UserController@gethorario');

//lista inactivos
Route::get('inactivos',[
			'uses' => 'UserController@inactivos',
			'as'   => 'user.inactivos'
]);

//listar alumnos por nivel
Route::get('listarxnivel',[
			'uses' => 'UserController@listaxnivel',
			'as'   => 'user.listaxnivel'
]);

//lista pagos
Route::get('pagosalumnos',[
			'uses' => 'UserController@pagos',
			'as'   => 'user.pagosalumnos'
]);

Route::post('pagomesalumnos',[
			'uses' => 'UserController@pagomesalum',
			'as'   => 'user.pagomesalum'
]);

//corte
Route::get('pagos',[
			'uses' => 'UserController@corte',
			'as'   => 'user.corte'
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

//pagos alumnos
Route::get('user/{id}/pagos',[
			'uses' => 'UserController@pagosal',
			'as'   => 'user.pagosal'
]);


//modal edit alumno
	Route::get('userse',[
			'uses' => 'UserController@view',
			'as'   => 'users.view'
		]);


//corte de caja
	Route::get('corteC',[
			'uses' => 'UserController@cortecaja',
			'as'   => 'users.corte'
		]);

//listar usuarios x nivel
	Route::get('ListarUser',[
			'uses' => 'UserController@listaxnivel1',
			'as'   => 'users.listaxnivel'
		]);

//modal edit user
	Route::get('usersChangeView',[
			'uses' => 'UserController@viewU',
			'as'   => 'users.changeU'
		]);

//modal edit nivel
	Route::get('nivele',[
			'uses' => 'UserController@viewn',
			'as'   => 'nivel.view'
		]);


// actualiza alumno
		Route::post('usersu',[
			'uses' => 'UserController@actualiza',
			'as'   => 'users.actualiza'
		]);

// actualiza user
		Route::post('userChange',[
			'uses' => 'UserController@actualizaUser',
			'as'   => 'users.CambioUsuario'
		]);

// actualiza nivel
		Route::post('nivelu',[
			'uses' => 'UserController@actualizan',
			'as'   => 'nivel.actualiza'
		]);

// ruta para generar lista en PDf
		Route::get('nivellista/{id}',[
			'uses' => 'UserController@listarpdf',
			'as'   => 'nivel.listarpdf'
		]);
