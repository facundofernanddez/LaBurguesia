<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoCotroller;

Route::get('/', function () {
    return view('/frontend/home');
});

Route::get('/quienessomos', function () {
    return view('/frontend/quienessomos');
});

Route::get('/terminosusos', function () {
    return view('/frontend/terminosusos');
});

Route::get('/contacto', function () {
    return view('/frontend/contacto');
});

Route::post('/contacto', [ContactoCotroller::class, 'contacto']);

Route::get('/comercializacion', function () {
    return view('/frontend/comercializacion');
});

Route::get('/catalogo', function () {
    return view('/frontend/catalogo');
});

