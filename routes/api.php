<?php

use App\Http\Controllers\Api\SightingsApiController;
use App\Http\Controllers\Api\SpeciesApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Species endpoints
    Route::get('/species', [SpeciesApiController::class, 'index'])->name('api.species.index');
    Route::get('/species/{slug}', [SpeciesApiController::class, 'show'])->name('api.species.show');

    // Sightings & GeoJSON map endpoints
    Route::get('/sightings/geojson', [SightingsApiController::class, 'geojson'])->name('api.sightings.geojson');
    Route::get('/sightings/stats', [SightingsApiController::class, 'stats'])->name('api.sightings.stats');
});
