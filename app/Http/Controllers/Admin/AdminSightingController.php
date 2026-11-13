<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewSightingRequest;
use App\Models\AuditLog;
use App\Models\Sighting;
use App\Models\Species;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSightingController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Sighting::class);

        $query = Sighting::with(['species', 'user', 'location', 'reviewer']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($speciesId = $request->input('species_id')) {
            $query->where('species_id', $speciesId);
        }

        $sightings = $query->latest('id')->paginate(12)->withQueryString();
        $speciesList = Species::active()->orderBy('common_name')->get();

        return view('admin.sightings.index', compact('sightings', 'speciesList'));
    }

    public function show(Sighting $sighting): View
    {
        $this->authorize('view', $sighting);

        $sighting->load(['species', 'user', 'location', 'habitat', 'reviewer', 'photos']);

        return view('admin.sightings.show', compact('sighting'));
    }

    public function review(ReviewSightingRequest $request, Sighting $sighting): RedirectResponse
    {
        $this->authorize('review', $sighting);

        $oldStatus = $sighting->status;
        $status = $request->input('status');

        $sighting->update([
            'status' => $status,
            'reviewer_id' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $status === 'rejected' ? $request->input('rejection_reason') : null,
        ]);

        $actionDesc = $status === 'approved' ? 'aprobado para publicación' : 'rechazado';
        AuditLog::log($status, $sighting, "Avistamiento #{$sighting->id} ({$sighting->species?->common_name}) {$actionDesc}.");

        return redirect()->route('admin.sightings.index')
            ->with('success', "Avistamiento #{$sighting->id} {$actionDesc} correctamente.");
    }

    public function destroy(Sighting $sighting): RedirectResponse
    {
        $this->authorize('delete', $sighting);

        AuditLog::log('deleted', $sighting, "Avistamiento #{$sighting->id} eliminado.");
        $sighting->delete();

        return redirect()->route('admin.sightings.index')
            ->with('success', "Avistamiento eliminado.");
    }
}
