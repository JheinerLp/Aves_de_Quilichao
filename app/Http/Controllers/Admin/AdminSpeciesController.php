<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\AuditLog;
use App\Models\Family;
use App\Models\Habitat;
use App\Models\Species;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminSpeciesController extends Controller
{
    public function __construct(protected MediaUploadService $mediaService)
    {
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Species::class);

        $query = Species::with(['family', 'habitat', 'photos']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('family_id')) {
            $query->where('family_id', $request->family_id);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $species = $query->latest('id')->paginate(10)->withQueryString();
        $families = Family::all();

        return view('admin.species.index', compact('species', 'families'));
    }

    public function create(): View
    {
        $this->authorize('create', Species::class);

        $families = Family::all();
        $habitats = Habitat::all();

        return view('admin.species.create', compact('families', 'habitats'));
    }

    public function store(StoreSpeciesRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['common_name'] . '-' . Str::random(4));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_archived'] = false;

        $species = Species::create($data);

        // Handle uploaded photo if present
        if ($request->hasFile('photo')) {
            $this->mediaService->upload(
                $request->file('photo'),
                $species,
                'photo',
                "[FOTOGRAFÍA: {$species->common_name}]",
                1
            );
        }

        AuditLog::log('created', $species, "Especie {$species->common_name} registrada en el catálogo.");

        return redirect()->route('admin.species.index')
            ->with('success', "Especie '{$species->common_name}' registrada exitosamente.");
    }

    public function edit(Species $species): View
    {
        $this->authorize('update', $species);

        $families = Family::all();
        $habitats = Habitat::all();

        return view('admin.species.edit', compact('species', 'families', 'habitats'));
    }

    public function update(UpdateSpeciesRequest $request, Species $species): RedirectResponse
    {
        $oldValues = $species->toArray();
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        $species->update($data);

        if ($request->hasFile('photo')) {
            $this->mediaService->upload(
                $request->file('photo'),
                $species,
                'photo',
                "[FOTOGRAFÍA ACTUALIZADA: {$species->common_name}]",
                $species->photos()->count() + 1
            );
        }

        AuditLog::log('updated', $species, "Especie {$species->common_name} actualizada.", $oldValues, $species->fresh()->toArray());

        return redirect()->route('admin.species.index')
            ->with('success', "Especie '{$species->common_name}' actualizada correctamente.");
    }

    public function toggleArchive(Species $species): RedirectResponse
    {
        $this->authorize('delete', $species);

        $species->is_archived = !$species->is_archived;
        $species->save();

        $action = $species->is_archived ? 'archivada' : 'restaurada';
        AuditLog::log('archived', $species, "Especie {$species->common_name} {$action}.");

        return back()->with('success', "Especie {$species->common_name} {$action} correctamente.");
    }
}
