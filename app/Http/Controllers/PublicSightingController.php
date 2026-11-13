<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicSightingRequest;
use App\Models\AuditLog;
use App\Models\Location;
use App\Models\Sighting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PublicSightingController extends Controller
{
    /**
     * Límite regulado: máximo 3 envíos por correo / IP en un período de 24 horas.
     */
    protected const MAX_SUBMISSIONS = 3;
    protected const TTL_HOURS = 24;

    public function store(StorePublicSightingRequest $request): RedirectResponse
    {
        $email = Str::lower(trim($request->input('observer_email')));
        $cacheKey = 'sighting_submissions_' . md5($email . '|' . $request->ip());

        $currentCount = (int) Cache::get($cacheKey, 0);

        if ($currentCount >= self::MAX_SUBMISSIONS) {
            return back()
                ->withInput()
                ->with('sighting_error', "Has alcanzado el límite regulado de " . self::MAX_SUBMISSIONS . " envíos permitidos para el correo {$email}. Esta regulación protege el sistema contra saturación.");
        }

        $data = $request->validated();

        // Si no se proporcionaron coordenadas directas, tomar las de la ubicación elegida o el centro de Quilichao
        if (empty($data['latitude']) || empty($data['longitude'])) {
            if (!empty($data['location_id'])) {
                $location = Location::find($data['location_id']);
                $data['latitude'] = $location?->latitude ?? 3.0094;
                $data['longitude'] = $location?->longitude ?? -76.4847;
            } else {
                $data['latitude'] = 3.0094;
                $data['longitude'] = -76.4847;
            }
        }

        $data['status'] = 'pending';
        $data['user_id'] = auth()->id(); // null si es visitante anónimo

        $sighting = Sighting::create($data);

        // Incrementar contador regulado en caché
        $newCount = $currentCount + 1;
        Cache::put($cacheKey, $newCount, now()->addHours(self::TTL_HOURS));

        AuditLog::log('created_public', $sighting, "Avistamiento #{$sighting->id} reportado por {$data['observer_email']} (Envío {$newCount} de " . self::MAX_SUBMISSIONS . ").");

        $remaining = self::MAX_SUBMISSIONS - $newCount;
        $message = "¡Observación de '{$sighting->species?->common_name}' registrada con éxito! (Envío {$newCount} de " . self::MAX_SUBMISSIONS . " permitidos). Tu reporte se encuentra en revisión administrativa para su publicación.";

        return back()->with('sighting_success', $message);
    }
}
