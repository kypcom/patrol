<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signin','ALogController@signin');


Route::group(['middleware' => 'auth.jwt'], function () {


    //CERRAR SESSION
    Route::get('bye','ALogController@logout');


	//VERIFICAR ESTATUS DEL USUARIO
    Route::get('check','ALogController@check');

    //AGREGAR UN COMENTARIO A LOS REPORTES
    Route::post('comentario','AReportesController@add_coment');

    // RESOLVER UN REPORTE
    Route::post('resolver','AReportesController@add_resuelto');

    //VER SALIDAD DE AUTOS
    Route::get('salidas/{frac}','AVisitasController@salidas');

    //MARCAR SALIDAS DE AUTOS
    Route::post('salida','AVisitasController@salir');

    //INFORMCION DE TODAS LAS CASAS
    Route::get('casas','AGeneralController@get_casas');

    //AGREGAR UN NUEVO REPORTE 
     Route::post('add-reporte','AReportesController@add_reporte');

     //VER TODOS LOS REGISTROS
     Route::get('registros','AVisitasController@g_visitas');

     //GUARDAR NUEVO REGISTRO
     Route::post('visita-store','AVisitasController@store_visita');

     //CARGAR DATOS PARA LLENAR UN NUEVO REGISTRO
     Route::get('visita-create','AVisitasController@create_visita');

     //OBTENER TODOS LOS REPORTES
     Route::get('reportes','AReportesController@reportes');

     //OBTENER INFORMACION REPORTE EN ESPECIFICO
     Route::get('reporte/{reporte}','AReportesController@reporte');

     //OBTENER INFORMACION DE COLONO
     Route::get('misdatos','AColonoController@misdatos');

     //CAMBIAR ESTATUS INVIATADO
     Route::post('update-invitado/{invitado}','AColonoController@update_invitado');

     //CAMBIAR ESTSTUS AUTORIZA
     Route::post('update-autoriza/{autoriza}','AColonoController@update_autoriza');

     //CAMBIAR NOMBRE DE AUTORIZA O FRECUENTE 
     Route::post('update-name','AColonoController@update_name');

      //VER TODOS LOS REGISTROS DE COLONO EN ESPECIAL
     Route::get('misregistros','AColonoController@g_visitas');

    // AGREGAR UN NUEVO EVENTO
      Route::post('create-evento','AColonoController@create_evento');

      //AUTORIZAN UN EVENTO
      Route::get('auto-evento','AColonoController@auto_evento');

      //VER TODOS LOS EVENTOS DE UN COLONO
        Route::get('miseventos','AColonoController@g_eventos');

       //CANCELAR EVENTO
       Route::post('cancel-evento/{evento}','AColonoController@cancel_evento');

       //VER TODOS LOS EVENTOS DE UN FRACCIONAMIENTO
        Route::get('eventos','AGeneralController@g_eventos');

        //UPDATE DE INVITADOS DEL UN EVENTO
        Route::post('update-einvitados','AColonoController@update_invitados_evento');
        //STORE SUBS TO WEB PUSH
        Route::post('store-push','AColonoController@store_push');


});


Route::get('test-metodo','AVisitasController@test_metodo');

Route::get('test-push','ServiciosController@test_push');
