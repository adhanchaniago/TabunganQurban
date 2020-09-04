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
    Route::get('/getdata', 'ChartController@indexchart');
    Route::get('/anggaran_pakan', 'admin\DashboardController@anggaran_pakan');
    Route::get('/belanja_sapi', 'admin\DashboardController@getdatasapi');
    Route::get('/belanja_pakan/{date}', 'admin\DashboardController@getdatapakan');
    Route::get('/get_berat/{data}', 'admin\JualSapiController@get_berat');
    Route::post('/jual_sapi', 'admin\JualSapiController@jual_sapi');
    Route::get('/jual_sapi/list_chart/{id_chart}', 'admin\JualSapiController@list_chart');
    Route::get('/jual_sapi/list_chart/{id}/delete', 'admin\JualSapiController@delete_list');
    Route::get('/jual_sapi/list_chart/{id_chart}/total', 'admin\JualSapiController@total_h_b');
    Route::get('/jual_sapi/list_chart/{id_chart}/data', 'admin\JualSapiController@get_data');
//Route::post('/coba','RfidController@index');
