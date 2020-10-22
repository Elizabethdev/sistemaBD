<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::view('/inicio', 'website/home')->name('inicio');
Route::view('/', 'website/home')->name('/');

Route::get('/saneamiento', 'SaneamientoController@index')->name('saneamiento');
Route::get('/calidadagua', 'CalidadController@index')->name('calidadagua');

Route::prefix('/aguapotable')->group(function () {
    Route::get('/demanda', 'AguaPotableController@index')->name('aguapotable');
    Route::get('/cobertura', 'AguaPotableController@cobertura')->name('ap.cobertura');
    Route::get('/poblacion', 'AguaPotableController@poblacion')->name('ap.poblacion');

});
Route::prefix('/alcantarillado')->group(function () {
    Route::get('/demanda', 'AlcantarilladoController@index')->name('alcantarillado');
    Route::get('/cobertura', 'AlcantarilladoController@cobertura')->name('alc.cobertura');
    Route::get('/poblacion', 'AlcantarilladoController@poblacion')->name('alc.poblacion');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/subirarchivo', 'DatosController@cargarArchivo')->name('uploadfile');
    Route::post('/importarExcel', 'DatosController@importExcel')->name('importarExcel');
    Route::get('/verdatos', 'DatosController@verDatos')->name('verdatos');
    Route::get('/resumendemandas', 'DatosController@filtrarDatosdemanda')->name('resumendemanda');
    Route::get('/resumenservicios', 'DatosController@filtrarDatosServicio')->name('resumenservicios');
    Route::get('/resumenrango', 'DatosController@filtrarDatosRango')->name('resumenrango');
});

Route::prefix('api')->group(function () {
    Route::post('/ap/consultabyvista', 'AguaPotableController@consultarByvista')->name('consultarapByvista');
    Route::post('/ap/consultarmunbyfiltros', 'AguaPotableController@consultarMunByFiltros')->name('consultarMunByFiltros');
    Route::post('/ap/consultarbyfiltros', 'AguaPotableController@consultarByFiltros')->name('ap.consultarByFiltros');
    // Route::post('/ap/cobertura/consultarbyfiltros', 'AguaPotableController@consultarCoberturaByFiltros')->name('ap.CoberturaByFiltros');

    Route::post('/alc/consultarbyfiltros', 'AlcantarilladoController@consultarByFiltros')->name('consultaralcByFiltros');

    Route::post('/san/consultarbyfiltros', 'SaneamientoController@consultarByFiltros')->name('consultarsanByFiltros');
    Route::post('/cal/consultarbyfiltros', 'CalidadController@consultarByFiltros')->name('consultarcalByFiltros');

});
