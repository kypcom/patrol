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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [
   'as' => 'log.index',
    'uses' => 'LogController@ingreso'
]);

    Route::post('/check',[
    'as' => 'log.check',
    'uses' => 'LogController@check'
]);

        Route::get('/changef/{frac}',[
    'as' => 'user.change',
    'uses' => 'UserController@change_frac'
]);

Route::get('logout','LogController@logout');


//Panel Administraccion
Route::resource('users','UserController');
Route::resource('fraccionamiento','FraccionamientoController');
Route::resource('calle','CalleController');
Route::resource('casa','CasaController');
Route::resource('evento','EventoController');
Route::resource('reporte','ReporteController');
Route::resource('visita','VisitaController');




Route::post('/addcoment', [
        'as'   => 'reporte.addcoment',
        'uses' => 'ReporteController@add_coment',
       ]);


//RUTAS DE BORRADO
 Route::get('/users/borrar/{user}', [
        'as'   => 'users.destroy',
        'uses' => 'UserController@destroy',
    ]);
Route::get('/fraccionamiento/borrar/{frac}', [
        'as'   => 'frac.destroy',
        'uses' => 'FraccionamientoController@destroy',
    ]);
 Route::get('/evento/borrar/{evento}', [
        'as'   => 'evento.destroy',
        'uses' => 'EventoController@destroy',
    ]);

 Route::get('/reporte/borrar/{reporte}', [
        'as'   => 'reporte.destroy',
        'uses' => 'ReporteController@destroy',
    ]);

   Route::get('/calle/borrar/{calle}', [
        'as'   => 'calle.destroy',
        'uses' => 'CalleController@destroy',
    ]);

     Route::get('/casa/borrar/{casa}', [
        'as'   => 'casa.destroy',
        'uses' => 'CasaController@destroy',
    ]);

       Route::get('/registro/borrar/{registro}', [
        'as'   => 'registro.destroy',
        'uses' => 'VisitaController@destroy',
    ]);


//Rutas de servicio

Route::get('close-eventos','ServiciosController@close_evento');
Route::get('clear-eventos','ServiciosController@clear_evento');
Route::get('clear-registros','ServiciosController@clear_registro');
Route::get('inactive-report','ServiciosController@inactive_report');
