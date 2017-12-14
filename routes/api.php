<?php

use Illuminate\Http\Request;


Route::resource('voos', 'VooController');
Route::resource('aeronaves', 'AeronaveController');
Route::resource('tipos', 'TipoController');
Route::resource('aeroportos', 'AeroportoController');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
