<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpeciesApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Species::active()->with(['family', 'habitat', 'photos', 'audios', 'videos']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('habitat')) {
            $query->whereHas('habitat', fn($q) => $q->where('slug', $request->habitat));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        return response()->json([
            'success' => true,
            'count' => $query->count(),
            'data' => $query->get(),
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $species = Species::active()
            ->with(['family', 'habitat', 'photos', 'audios', 'videos', 'approvedSightings.location'])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $species,
        ]);
    }
}
