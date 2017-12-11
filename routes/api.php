<?php

use Illuminate\Http\Request;

//Route::middleware(['cors'])->group(function (){
//    Route::resource('voos', 'VooController');
//});



Route::resource('voos', 'VooController');
Route::resource('aeronaves', 'AeronaveController');
Route::resource('aeroportos', 'AeroportoController');


//Rota para buscar o voo pelo aeroporto de origem
//Route::get('voos/{airport}', 'VooController@showByAirport')->name('voos.airport');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
