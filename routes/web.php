<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StandController;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return view('home');
});

// Vitrine publique : liste des exposants et détail d'un stand
use App\Http\Controllers\ExposantController;
Route::get('/exposants', [ExposantController::class, 'index'])->name('exposants.index');
Route::get('/exposants/{stand}', [ExposantController::class, 'show'])->name('exposants.show');





Route::get('/auth', function () {
    return view('auth.connexion-inscription');
});

use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');

use App\Http\Controllers\LoginController;

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('auth.connexion-inscription');
})->name('login.form');

// Page d'attente pour les entrepreneurs non approuvés
Route::get('/attente', function () {
    return view('attente');
})->name('attente');

// Dashboard admin (protégé par le middleware de rôle)
use App\Http\Controllers\AdminController;
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])
    ->name('admin.dashboard');
Route::post('/admin/approve/{user}', [AdminController::class, 'approve'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin']);
Route::post('/admin/reject/{user}', [AdminController::class, 'reject'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin']);
Route::get('/admin/commandes', [AdminController::class, 'commandes'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])
    ->name('admin.commandes');

// Dashboard entrepreneur approuvé (protégé par le middleware de rôle et de statut)
use App\Http\Controllers\EntrepreneurController;
Route::get('/entrepreneur/dashboard', [EntrepreneurController::class, 'dashboard'])
    ->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve', \App\Http\Middleware\CheckEntrepreneurStatus::class])
    ->name('entrepreneur.dashboard');

    use Illuminate\Support\Facades\DB;

// Route::get('/db-check', function () {
//     return 'Connected to database: ' . DB::connection()->getDatabaseName();
// });

use App\Http\Controllers\AdminDashboardController;

// Je supprime tous les autres doublons de routes dashboard admin/entrepreneur

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// CRUD Produits pour entrepreneur
use App\Http\Controllers\ProductController;
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve', \App\Http\Middleware\CheckEntrepreneurStatus::class])
    ->prefix('entrepreneur')
    ->group(function () {
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });



Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':entrepreneur_approuve', \App\Http\Middleware\CheckEntrepreneurStatus::class])
    ->prefix('entrepreneur')
    ->group(function () {
        Route::get('stands', [StandController::class, 'index'])->name('entrepreneur.stands.index');
        Route::get('stands/create', [StandController::class, 'create'])->name('entrepreneur.stands.create');
        Route::post('stands', [StandController::class, 'store'])->name('entrepreneur.stands.store');
        Route::get('stands/{stand}/edit', [StandController::class, 'edit'])->name('entrepreneur.stands.edit');
        Route::put('stands/{stand}', [StandController::class, 'update'])->name('entrepreneur.stands.update');
        Route::delete('stands/{stand}', [StandController::class, 'destroy'])->name('entrepreneur.stands.destroy');
    });

// Panier
use App\Http\Controllers\PanierController;
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');
Route::post('/panier/valider', [PanierController::class, 'validerCommande'])->name('panier.valider');


Route::get('/run-migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return '✅ Migration exécutée avec succès !';
    } catch (\Exception $e) {
        return '❌ Erreur : ' . $e->getMessage();
    }
});
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Config cleared and cached";
});
