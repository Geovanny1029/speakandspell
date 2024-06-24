<?php

Route::get('/', function () {
	return view('index');
});

Route::resource('user', 'UserController');

Route::namespace('Auth')->group(function () {

    Route::view('/login', 'auth.login')->name('login');

    Route::post('/login', 'LoginController@login');

    Route::post('/logout', 'LoginController@logout')->name('logout');
	
});


Route::middleware('auth')->group(function()
{
    
	Route::get('/home', 'HomeController@index')->name('home');

	Route::namespace('V1')->group(function(){

		Route::namespace('Students')->group(function () {

			Route::get('/pdf/students', 'PdfController')->name('students.pdf');

			Route::prefix('students')->group(function () {

				Route::get('/', 'StudentsController@index')->name('students');

				Route::get('/create', 'StudentsController@create')->name('student.create');

				Route::post('/store', 'StudentsController@store')->name('student.store');

				Route::get('/{student}', 'StudentsController@show')->name('student.show');

				Route::get('/{student}/edit', 'StudentsController@edit')->name('student.edit');

				Route::put('/{student}', 'StudentsController@update')->name('student.update');

				Route::post('/datatable', 'DataTableController')->name('student.datatable');
				
			});

		});

		Route::namespace('Levels')->prefix('levels')->group(function () {

			Route::get('/', 'LevelsController@index')->name('levels');

			Route::get('/{level}', 'LevelsController@show')->name('level.show');

			Route::post('/store', 'LevelsController@store')->name('level.store');

			Route::post('/datatable','DataTableController')->name('level.datatable');

		});

		Route::namespace('Schedule')->prefix('schedule')->group(function (){

			Route::post('/store', 'ScheduleController@store')->name('schedule.store');

		});

	});	

});


//menu de opciones index
Route::get('menu', 'UserController@menu')->name('user.menu');

//opcion de nivel horario
Route::get('user/horario/{id}', 'UserController@gethorario');

//opcion de nivel horario
Route::get('listaAlumno/{id}', 'UserController@listado');

//opcion de nivel horario
Route::get('user/horariomax/{id}', 'UserController@gethorariomax');

//lista inactivos
Route::get('inactivos', [
	'uses' => 'UserController@inactivos',
	'as'   => 'user.inactivos'
]);

//listar alumnos por nivel
Route::get('listarxnivel', [
	'uses' => 'UserController@listaxnivel',
	'as'   => 'user.listaxnivel'
]);

//lista pagos
Route::get('pagosalumnos', [
	'uses' => 'UserController@pagos',
	'as'   => 'user.pagosalumnos'
]);

Route::post('pagomesalumnos', [
	'uses' => 'UserController@pagomesalum',
	'as'   => 'user.pagomesalum'
]);

//corte
Route::get('pagos', [
	'uses' => 'UserController@corte',
	'as'   => 'user.corte'
]);

//lista niveles
Route::get('listaNivel', [
	'uses' => 'UserController@listaNivel',
	'as'   => 'user.listaNivel'
]);

//form nivel
Route::get('altaLevel', [
	'uses' => 'UserController@createNivel',
	'as'   => 'user.createNivel'
]);

//alta nivel
Route::post('altaNivel', [
	'uses' => 'UserController@altaNivel',
	'as'   => 'user.altaNivel'
]);






//dar baja alumno
Route::get('user/{id}/destroy', [
	'uses' => 'UserController@destroy',
	'as'   => 'user.destroy'
]);

//pagos alumnos
Route::get('user/{id}/pagos', [
	'uses' => 'UserController@pagosal',
	'as'   => 'user.pagosal'
]);


//modal edit alumno
Route::get('userse', [
	'uses' => 'UserController@view',
	'as'   => 'users.view'
]);


//corte de caja
Route::get('corteC', [
	'uses' => 'UserController@cortecaja',
	'as'   => 'users.corte'
]);

//listar usuarios x nivel
Route::get('ListarUser', [
	'uses' => 'UserController@listaxnivel1',
	'as'   => 'users.listaxnivel'
]);


//listar deudores
Route::get('ListarDeudores', [
	'uses' => 'UserController@ListaDeudores',
	'as'   => 'users.listadeudores'
]);

//listar deudores datos
Route::get('ListarxDeudores', [
	'uses' => 'UserController@ListaDeudores1',
	'as'   => 'users.listadeudores1'
]);


//modal edit user
Route::get('usersChangeView', [
	'uses' => 'UserController@viewU',
	'as'   => 'users.changeU'
]);

//modal edit nivel
Route::get('nivele', [
	'uses' => 'UserController@viewn',
	'as'   => 'nivel.view'
]);


//modal edit last pago
Route::get('/lastpago', [
	'uses' => 'UserController@lastpago',
	'as'   => 'nivel.lastpago'
]);


// actualiza alumno
Route::post('usersu', [
	'uses' => 'UserController@actualiza',
	'as'   => 'users.actualiza'
]);

// cambio de usuario a otro nivel
Route::post('/userchangelevel', [
	'uses' => 'UserController@cambionivel',
	'as'   => 'users.cambionivel'
]);

// editar ultimo pago por equivocacion
Route::post('/editlastpago', [
	'uses' => 'UserController@editlastpago',
	'as'   => 'users.editlastpago'
]);

// actualiza user
Route::post('userChange', [
	'uses' => 'UserController@actualizaUser',
	'as'   => 'users.CambioUsuario'
]);

// actualiza nivel
Route::post('nivelu', [
	'uses' => 'UserController@actualizan',
	'as'   => 'nivel.actualiza'
]);

// ruta para generar lista en PDf
Route::get('nivellista/{id}', [
	'uses' => 'UserController@listarpdf',
	'as'   => 'nivel.listarpdf'
]);
