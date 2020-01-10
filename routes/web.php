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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout');

//USUARIO NORMAL
//Carga la vista si no entra con un email de plaiaundi
Route::get('/loginerror', function () {
    return view('loginerror');
});

//Cargar la vista de ver las incidencias y ordena por id
Route::get('/verincidencia', 'ControladorIncidencias@verDatos')->middleware('profesor');
Route::get('/verincidencia2', 'ControladorIncidencias@verDatosDesc');
//Cargar la vista de las incidencias y ordena por fechas
Route::get('/verincidenciafecha', 'ControladorIncidencias@verDatosFecha');
Route::get('/verincidenciafecha2', 'ControladorIncidencias@verDatosFechaDesc');



//Carga la vista de cada incidencia seleccionada de las vistas hechas para detalles, eliminaciones y modificaciones
Route::get('/detalle/{i}', 'ControladorIncidencias@verDetalle');
Route::get('/modifica/{i}', 'ControladorIncidencias@verModificarDatos');
Route::get('/elimina/{i}', 'ControladorIncidencias@eliminarDatos');

Route::post('/modificarincidencia/{i}', 'ControladorIncidencias@ModificarDatos');

//Carga la vista para crear una nueva incidencia
Route::get('/nuevaincidencia', 'ControladorIncidencias@nuevaIncidencia');

//Ruta para pasar los datos a la vista de ver las incidencias
Route::post('/pasarincidencia', 'ControladorIncidencias@pasarincidencia');




//USUARIO ADMINISTRADOR
    Route::get('/homeadmin', 'HomeController@admin');
    Route::get('/verincidenciasadmin', 'ControladorIncidencias@verDatosAdmin')->middleware('admin');
    Route::get('/verincidenciasadmin2', 'ControladorIncidencias@verDatosDescAdmin');
    //Cargar la vista de las incidencias y ordena por fechas
    Route::get('/verincidenciasfechaadmin', 'ControladorIncidencias@verDatosFechaAdmin');
    Route::get('/verincidenciasfechaadmin2', 'ControladorIncidencias@verDatosFechaDescAdmin');

    Route::get('/detalleadmin/{i}', 'ControladorIncidencias@verDetalleAdmin');
    Route::get('/modificaadmin/{i}', 'ControladorIncidencias@verModificarDatosAdmin');

    Route::post('/modificarincidenciaadmin/{i}', 'ControladorIncidencias@ModificarDatosAdmin');