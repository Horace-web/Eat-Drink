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

use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');

use App\Http\Controllers\LoginController;

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Page d'attente pour les entrepreneurs non approuvés
Route::get('/attente', function () {
    return view('attente');
})->name('attente');

// Dashboard admin (protégé par le middleware de rôle)
use App\Http\Controllers\AdminController;
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin']);

// Dashboard entrepreneur approuvé (protégé par le middleware de rôle et de statut)
use App\Http\Controllers\EntrepreneurController;
Route::get('/entrepreneur/dashboard', [EntrepreneurController::class, 'dashboard'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve', \App\Http\Middleware\CheckEntrepreneurStatus::class]);
