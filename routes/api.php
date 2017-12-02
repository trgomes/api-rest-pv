<?php

use Illuminate\Http\Request;

Route::resource('voos', 'VooController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
