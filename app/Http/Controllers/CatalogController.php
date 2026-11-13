<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Habitat;
use App\Models\Species;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $query = Species::active()
            ->with(['family', 'habitat', 'photos', 'audios', 'videos', 'approvedSightings.location']);

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        if ($habitatSlug = $request->input('habitat')) {
            $query->whereHas('habitat', function ($q) use ($habitatSlug) {
                $q->where('slug', $habitatSlug);
            });
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($familyId = $request->input('family_id')) {
            $query->where('family_id', $familyId);
        }

        $species = $query->orderBy('common_name')->get();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'total' => $species->count(),
                'data' => $species,
            ]);
        }

        $habitats = Habitat::all();
        $families = Family::all();

        return view('public.catalog', compact('species', 'habitats', 'families'));
    }

    public function show(string $slug): View|JsonResponse
    {
        $species = Species::active()
            ->with(['family', 'habitat', 'photos', 'audios', 'videos', 'approvedSightings.location'])
            ->where('slug', $slug)
            ->firstOrFail();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $species,
            ]);
        }

        return view('public.species-detail', compact('species'));
    }
}
