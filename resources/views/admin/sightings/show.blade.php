@extends('admin.layout')

@section('title', 'Revisar Avistamiento #' . $sighting->id)

@section('content')
<div class="space-y-6">

  <div class="flex items-center justify-between p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div>
      <span class="text-[10px] font-mono text-[#777777] uppercase block">Moderación de Observación</span>
      <h1 class="text-2xl font-black text-[#333333]">Avistamiento #{{ $sighting->id }}</h1>
      <span class="text-xs text-[#777777]">Registrado por: <strong>{{ $sighting->user?->name ?? 'Usuario' }}</strong> el {{ $sighting->sighting_date?->format('d/m/Y') }}</span>
    </div>
    <a href="{{ route('admin.sightings.index') }}" class="btn-wireframe-secondary text-xs py-1.5 px-3">
      ← Volver al Listado
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    <!-- Detalle de la Observación (8 columnas) -->
    <div class="lg:col-span-8 bg-[#FFFFFF] border-2 border-[#333333] p-6 rounded-sm space-y-6">
      
      <!-- Ficha de la especie asociada -->
      <div class="p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-2">
        <span class="text-[10px] font-mono font-bold uppercase text-[#777777]">Especie Reportada</span>
        <div class="flex items-baseline justify-between">
          <div>
            <h2 class="text-xl font-black text-[#333333]">{{ $sighting->species?->common_name }}</h2>
            <p class="text-xs font-serif italic text-[#777777]">{{ $sighting->species?->scientific_name }} (Familia: {{ $sighting->species?->family?->name }})</p>
          </div>
          <span class="px-2.5 py-0.5 bg-[#D0D0D0] border border-[#B0B0B0] text-xs font-mono font-bold text-[#333333]">
            UICN: {{ $sighting->species?->uicn_status }}
          </span>
        </div>
      </div>

      <!-- Datos geográficos y temporales -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
        <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
          <span class="text-[#777777] font-mono text-[10px] uppercase block">Ubicación / Sector</span>
          <strong class="text-[#333333] block text-sm">{{ $sighting->location?->name ?? 'Sector rural abierto' }}</strong>
          <span class="text-[#777777] block">Zona: {{ $sighting->location?->zone ?? 'Santander de Quilichao' }}</span>
        </div>

        <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
          <span class="text-[#777777] font-mono text-[10px] uppercase block">Coordenadas y Altitud</span>
          <strong class="text-[#333333] block font-mono">{{ $sighting->latitude }}, {{ $sighting->longitude }}</strong>
          <span class="text-[#777777] font-mono block">Elevación: {{ $sighting->location?->elevation_msnm ?? '1.050' }} msnm</span>
        </div>

        <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
          <span class="text-[#777777] font-mono text-[10px] uppercase block">Cantidad de Ejemplares</span>
          <strong class="text-[#333333] block text-sm">{{ $sighting->individuals_count }} individuo(s)</strong>
        </div>

        <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
          <span class="text-[#777777] font-mono text-[10px] uppercase block">Hábitat Observado</span>
          <strong class="text-[#333333] block text-sm">{{ $sighting->habitat?->name ?? 'Bosque / Cañada' }}</strong>
        </div>
      </div>

      <!-- Notas descriptivas del observador -->
      <div class="space-y-1">
        <label class="block text-xs font-mono font-bold uppercase text-[#333333]">
          Descripción y Notas de Campo del Observador:
        </label>
        <div class="p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-xs text-[#333333] leading-relaxed">
          {{ $sighting->description ?: 'Sin notas descriptivas adicionales reportadas por el observador.' }}
        </div>
      </div>

      <!-- Estado actual de revisión -->
      <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2 text-xs">
        <span class="text-[10px] font-mono font-bold uppercase text-[#777777] block">Historial de Moderación</span>
        <div class="flex items-center gap-2">
          <span class="font-bold text-[#333333]">Estado actual:</span>
          @if($sighting->status === 'approved')
            <span class="px-2 py-0.5 bg-[#333333] text-[#FFFFFF] font-mono text-xs font-bold rounded-xs">Aprobado / Público</span>
          @elseif($sighting->status === 'pending')
            <span class="px-2 py-0.5 bg-[#D0D0D0] text-[#333333] font-mono text-xs font-bold rounded-xs border border-[#B0B0B0]">Pendiente de Revisión</span>
          @else
            <span class="px-2 py-0.5 bg-[#E0E0E0] text-[#777777] font-mono text-xs font-bold rounded-xs">Rechazado</span>
          @endif
        </div>
        @if($sighting->reviewer)
          <div class="text-[11px] text-[#777777]">
            Revisado por <strong>{{ $sighting->reviewer->name }}</strong> el {{ $sighting->reviewed_at?->format('d/m/Y H:i') }}.
          </div>
        @endif
        @if($sighting->rejection_reason)
          <div class="p-2.5 bg-[#F2F2F2] border border-[#B0B0B0] text-[11px] text-[#777777]">
            <strong>Motivo de rechazo:</strong> {{ $sighting->rejection_reason }}
          </div>
        @endif
      </div>

    </div>

    <!-- Panel de Decisión y Moderación (4 columnas) -->
    <div class="lg:col-span-4 bg-[#F2F2F2] border-2 border-[#333333] p-6 rounded-sm space-y-6">
      
      <div class="space-y-1 border-b border-[#B0B0B0] pb-3">
        <span class="text-[10px] font-mono font-bold uppercase text-[#777777]">Acción Administrativa</span>
        <h3 class="text-base font-black text-[#333333]">Dictamen de Revisión</h3>
        <p class="text-[11px] text-[#777777]">
          Solo los avistamientos en estado <strong>Aprobado</strong> serán visibles públicamente en el mapa y catálogo.
        </p>
      </div>

      <form method="POST" action="{{ route('admin.sightings.review', $sighting) }}" class="space-y-4">
        @csrf

        <div class="space-y-2">
          <label class="block text-xs font-mono font-bold uppercase text-[#333333]">
            Seleccionar Decisión:
          </label>
          <div class="space-y-2">
            <label class="flex items-center gap-2 p-2.5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm cursor-pointer text-xs">
              <input type="radio" name="status" value="approved" {{ $sighting->status === 'approved' ? 'checked' : '' }} required>
              <div>
                <strong class="text-[#333333] block">Aprobar Observación</strong>
                <span class="text-[10px] text-[#777777] block">Publicar en el mapa geográfico municipal</span>
              </div>
            </label>

            <label class="flex items-center gap-2 p-2.5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm cursor-pointer text-xs">
              <input type="radio" name="status" value="rejected" {{ $sighting->status === 'rejected' ? 'checked' : '' }} required>
              <div>
                <strong class="text-[#333333] block">Rechazar Observación</strong>
                <span class="text-[10px] text-[#777777] block">Inconsistencia en identificación o coordenadas</span>
              </div>
            </label>
          </div>
        </div>

        <div class="space-y-1">
          <label for="rejection_reason" class="block text-xs font-mono font-bold uppercase text-[#333333]">
            Motivo / Comentarios (Obligatorio al rechazar):
          </label>
          <textarea
            id="rejection_reason"
            name="rejection_reason"
            rows="3"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
            placeholder="Indica el motivo de la corrección o rechazo..."
          >{{ old('rejection_reason', $sighting->rejection_reason) }}</textarea>
        </div>

        <button type="submit" class="w-full btn-wireframe-primary text-xs py-2.5 text-center block">
          Guardar Dictamen de Revisión
        </button>
      </form>

      @can('delete', $sighting)
        <div class="pt-4 border-t border-[#B0B0B0]">
          <form method="POST" action="{{ route('admin.sightings.destroy', $sighting) }}">
            @csrf
            @method('DELETE')
            <button
              type="submit"
              onclick="return confirm('¿Seguro que deseas eliminar definitivamente este avistamiento?');"
              class="w-full btn-wireframe-ghost text-xs py-1.5 text-center text-[#777777] hover:text-[#333333]"
            >
              Eliminar registro del sistema
            </button>
          </form>
        </div>
      @endcan

    </div>

  </div>

</div>
@endsection
