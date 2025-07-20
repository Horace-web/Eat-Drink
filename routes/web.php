<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StandController;

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

    use Illuminate\Support\Facades\DB;

// Route::get('/db-check', function () {
//     return 'Connected to database: ' . DB::connection()->getDatabaseName();
// });

use App\Http\Controllers\AdminDashboardController;

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/utilisateurs/{id}/valider', [AdminController::class, 'valider'])->name('admin.utilisateur.valider');
});



Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/valider/{id}', [AdminController::class, 'valider'])->name('admin.valider');
    Route::post('/admin/rejeter/{id}', [AdminController::class, 'rejeter'])->name('admin.rejeter');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProductController;


Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve'])->group(function () {

    // Routes Produits
    Route::get('/entrepreneur/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Routes Stands
    Route::get('/entrepreneur/stands', [StandController::class, 'index'])->name('entrepreneur.stands.index');
    Route::get('/entrepreneur/stands/create', [StandController::class, 'create'])->name('entrepreneur.stands.create');
    Route::post('/entrepreneur/stands', [StandController::class, 'store'])->name('entrepreneur.stands.store');
    Route::get('/entrepreneur/stands/{stand}/edit', [StandController::class, 'edit'])->name('entrepreneur.stands.edit');
    Route::put('/entrepreneur/stands/{stand}', [StandController::class, 'update'])->name('entrepreneur.stands.update');
    Route::delete('/entrepreneur/stands/{stand}', [StandController::class, 'destroy'])->name('entrepreneur.stands.destroy');
});


Route::get('/entrepreneur/dashboard', [EntrepreneurController::class, 'dashboard'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve', \App\Http\Middleware\CheckEntrepreneurStatus::class])
    ->name('entrepreneur.dashboard');
