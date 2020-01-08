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

Route::post('datosEtiqueta', 'GuiaController@datosEtiqueta');
Route::post('obtenerDespachosPorMes', 'ReportesController@obtenerDespachosPorMes');
Route::post('obtenerDespachosPorAno', 'ReportesController@obtenerDespachosPorAno');
Route::post('obtenerNotasdeVentaMargenes', 'ReportesController@obtenerNotasdeVentaMargenes');