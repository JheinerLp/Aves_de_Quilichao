<?php

namespace App\Http\Controllers;

use App\Models\ConservationContent;
use App\Models\Location;
use App\Models\Sighting;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Active species for carousel & previews
        $species = Species::active()
            ->with(['family', 'habitat', 'photos', 'audios', 'videos'])
            ->get();

        // Featured sightings for map
        $sightings = Sighting::approved()
            ->with(['species', 'location', 'habitat'])
            ->get();

        // Conservation contents
        $conservation = ConservationContent::published()->get();

        // Locations
        $locations = Location::all();

        return view('public.index', compact('species', 'sightings', 'conservation', 'locations'));
    }
}
