<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/exposants', [App\Http\Controllers\ExposantController::class, 'index'])->name('exposants.index');
Route::get('/exposants/{stand}', [App\Http\Controllers\ExposantController::class, 'show'])->name('exposants.show');





Route::get('/auth', function () {
    return view('auth.connexion-inscription');
});
