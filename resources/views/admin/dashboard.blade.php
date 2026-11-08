@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

  <!-- Encabezado de Sección -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div class="space-y-1">
      <div class="inline-block px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
        Control Central
      </div>
      <h1 class="text-2xl font-black text-[#333333]">Panel General de BioAves Quilichao</h1>
      <p class="text-xs text-[#777777]">
        Métricas del catálogo biológico, monitoreo de avistamientos y registros de seguridad.
      </p>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.species.create') }}" class="btn-wireframe-primary text-xs py-2 px-3">
        + Registrar Nueva Especie
      </a>
      <a href="{{ route('admin.sightings.index', ['status' => 'pending']) }}" class="btn-wireframe-secondary text-xs py-2 px-3">
        Revisar Pendientes ({{ $metrics['pending_sightings'] }})
      </a>
    </div>
  </div>

  <!-- Métricas Principales (Grid Wireframe) -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    
    <div class="p-5 bg-[#FFFFFF] border-2 border-[#333333] rounded-sm space-y-1">
      <span class="text-[10px] font-mono text-[#777777] uppercase block">Especies en Catálogo</span>
      <div class="text-3xl font-black text-[#333333]">{{ $metrics['total_species'] }}</div>
      <span class="text-[11px] text-[#777777] block">{{ $metrics['active_species'] }} especies activas</span>
    </div>

    <div class="p-5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
      <span class="text-[10px] font-mono text-[#777777] uppercase block">Avistamientos Totales</span>
      <div class="text-3xl font-black text-[#333333]">{{ $metrics['total_sightings'] }}</div>
      <span class="text-[11px] text-[#777777] block">{{ $metrics['approved_sightings'] }} publicados</span>
    </div>

    <div class="p-5 bg-[#F2F2F2] border-2 border-[#777777] rounded-sm space-y-1">
      <span class="text-[10px] font-mono text-[#333333] font-bold uppercase block">Pendientes de Revisión</span>
      <div class="text-3xl font-black text-[#333333]">{{ $metrics['pending_sightings'] }}</div>
      <span class="text-[11px] text-[#777777] block">Requieren validación</span>
    </div>

    <div class="p-5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
      <span class="text-[10px] font-mono text-[#777777] uppercase block">Archivos Multimedia</span>
      <div class="text-3xl font-black text-[#333333]">{{ $metrics['total_media'] }}</div>
      <span class="text-[11px] text-[#777777] block">Fotos, cantos y videos</span>
    </div>

  </div>

  <!-- Tablas de Acciones Recientes -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Avistamientos Recientes (7 columnas) -->
    <div class="lg:col-span-7 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-5 space-y-4">
      <div class="flex items-center justify-between border-b border-[#B0B0B0] pb-3">
        <h2 class="text-sm font-bold uppercase font-mono text-[#333333]">Últimos Avistamientos Reportados</h2>
        <a href="{{ route('admin.sightings.index') }}" class="text-xs font-semibold text-[#333333] underline">
          Ver todos →
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs border-collapse">
          <thead>
            <tr class="border-b border-[#B0B0B0] bg-[#F2F2F2] font-mono text-[11px] text-[#777777]">
              <th class="py-2 px-3">Especie</th>
              <th class="py-2 px-3">Sector</th>
              <th class="py-2 px-3">Fecha</th>
              <th class="py-2 px-3">Estado</th>
              <th class="py-2 px-3 text-right">Acción</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-[#E0E0E0]">
            @forelse($recentSightings as $s)
              <tr class="hover:bg-[#F2F2F2]/50">
                <td class="py-2.5 px-3">
                  <span class="font-bold block text-[#333333]">{{ $s->species?->common_name }}</span>
                  <span class="text-[10px] text-[#777777] italic">{{ $s->species?->scientific_name }}</span>
                </td>
                <td class="py-2.5 px-3 text-[#777777]">
                  {{ $s->location?->name ?? 'Coordenadas libres' }}
                </td>
                <td class="py-2.5 px-3 font-mono text-[11px] text-[#777777]">
                  {{ $s->sighting_date?->format('d/m/Y') }}
                </td>
                <td class="py-2.5 px-3">
                  @if($s->status === 'approved')
                    <span class="px-2 py-0.5 bg-[#333333] text-[#FFFFFF] text-[10px] font-mono rounded-xs">Aprobado</span>
                  @elseif($s->status === 'pending')
                    <span class="px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono rounded-xs border border-[#B0B0B0]">Pendiente</span>
                  @else
                    <span class="px-2 py-0.5 bg-[#E0E0E0] text-[#777777] text-[10px] font-mono rounded-xs">Rechazado</span>
                  @endif
                </td>
                <td class="py-2.5 px-3 text-right">
                  <a href="{{ route('admin.sightings.show', $s) }}" class="btn-wireframe-secondary text-[11px] py-0.5 px-2">
                    Detalle
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-4 text-center text-xs text-[#777777] font-mono">
                  No hay avistamientos registrados en el sistema.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Registro de Actividad y Auditoría Reciente (5 columnas) -->
    <div class="lg:col-span-5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-5 space-y-4">
      <div class="flex items-center justify-between border-b border-[#B0B0B0] pb-3">
        <h2 class="text-sm font-bold uppercase font-mono text-[#333333]">Registro de Auditoría</h2>
        @if(auth()->user()->isAdmin())
          <a href="{{ route('admin.audit-logs.index') }}" class="text-xs font-semibold text-[#333333] underline">
            Historial completo →
          </a>
        @endif
      </div>

      <div class="space-y-3">
        @forelse($recentLogs as $log)
          <div class="p-2.5 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-xs space-y-1">
            <div class="flex items-center justify-between">
              <span class="font-mono font-bold text-[10px] uppercase text-[#333333]">
                [{{ strtoupper($log->action) }}]
              </span>
              <span class="text-[10px] font-mono text-[#777777]">
                {{ $log->created_at?->diffForHumans() }}
              </span>
            </div>
            <p class="text-[#333333] text-xs">
              {{ $log->description ?: 'Operación del sistema' }}
            </p>
            <div class="text-[10px] font-mono text-[#777777] flex items-center justify-between">
              <span>Usuario: {{ $log->user?->name ?? 'Sistema' }}</span>
              <span>IP: {{ $log->ip_address }}</span>
            </div>
          </div>
        @empty
          <p class="text-xs text-[#777777] font-mono py-4 text-center">
            No hay eventos de auditoría registrados.
          </p>
        @endforelse
      </div>
    </div>

  </div>

</div>
@endsection
