<?php

use App\Http\Controllers\Admin\AdminAuditLogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSightingController;
use App\Http\Controllers\Admin\AdminSpeciesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (BioAves Quilichao)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/especie/{slug}', [CatalogController::class, 'show'])->name('catalog.show');
Route::post('/avistamientos/reportar', [\App\Http\Controllers\PublicSightingController::class, 'store'])->name('sightings.public.store');

/*
|--------------------------------------------------------------------------
| Autenticación Administrativa
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Administrativo Privado (RBAC protegido)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Módulo de Especies
    Route::get('/species', [AdminSpeciesController::class, 'index'])->name('species.index');
    Route::get('/species/create', [AdminSpeciesController::class, 'create'])->name('species.create');
    Route::post('/species', [AdminSpeciesController::class, 'store'])->name('species.store');
    Route::get('/species/{species}/edit', [AdminSpeciesController::class, 'edit'])->name('species.edit');
    Route::put('/species/{species}', [AdminSpeciesController::class, 'update'])->name('species.update');
    Route::patch('/species/{species}/toggle-archive', [AdminSpeciesController::class, 'toggleArchive'])->name('species.archive');

    // Módulo de Avistamientos y Moderación
    Route::get('/sightings', [AdminSightingController::class, 'index'])->name('sightings.index');
    Route::get('/sightings/{sighting}', [AdminSightingController::class, 'show'])->name('sightings.show');
    Route::post('/sightings/{sighting}/review', [AdminSightingController::class, 'review'])->name('sightings.review');
    Route::delete('/sightings/{sighting}', [AdminSightingController::class, 'destroy'])->name('sightings.destroy');

    // Módulo de Auditoría
    Route::get('/audit-logs', [AdminAuditLogController::class, 'index'])->name('audit-logs.index');
});
