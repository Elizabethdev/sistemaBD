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
Route::view('/saneamiento', 'website/saneamiento/saneamiento')->name('saneamiento');
Route::view('/calidadagua', 'website/calidad/calidadagua')->name('calidadagua');

Route::prefix('/aguapotable')->group(function () {
    Route::get('/demanda', 'AguaPotableController@index')->name('aguapotable');
    Route::get('/cobertura', 'AguaPotableController@cobertura')->name('ap.cobertura');

});
Route::prefix('/alcantarillado')->group(function () {
    Route::get('/demanda', 'AlcantarilladoController@index')->name('alcantarillado');

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

});
