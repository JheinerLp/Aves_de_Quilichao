<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sighting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SightingsApiController extends Controller
{
    public function geojson(Request $request): JsonResponse
    {
        $sightings = Sighting::approved()
            ->with(['species', 'location', 'habitat', 'photos'])
            ->get();

        $features = $sightings->map(function ($s) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float) $s->longitude, (float) $s->latitude],
                ],
                'properties' => [
                    'id' => $s->id,
                    'species_id' => $s->species_id,
                    'common_name' => $s->species?->common_name,
                    'scientific_name' => $s->species?->scientific_name,
                    'location_name' => $s->location?->name ?? 'Santander de Quilichao',
                    'zone' => $s->location?->zone ?? 'Área rural / urbana',
                    'elevation' => $s->location?->elevation_msnm ? $s->location->elevation_msnm . ' msnm' : null,
                    'sighting_date' => $s->sighting_date?->format('d/m/Y'),
                    'individuals_count' => $s->individuals_count,
                    'description' => $s->description,
                    'photo_placeholder' => $s->species?->photos->first()?->caption ?? '[PLACEHOLDER DE FOTOGRAFÍA]',
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    public function stats(): JsonResponse
    {
        return response()->json([
            'total_approved' => Sighting::approved()->count(),
            'total_species_recorded' => Sighting::approved()->distinct('species_id')->count('species_id'),
            'total_locations' => Sighting::approved()->distinct('location_id')->count('location_id'),
        ]);
    }
}
