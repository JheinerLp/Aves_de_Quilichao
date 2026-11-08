@extends('admin.layout')

@section('title', 'Moderación de Avistamientos')

@section('content')
<div class="space-y-6">

  <!-- Encabezado -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div class="space-y-1">
      <div class="inline-block px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
        Control Comunitario y Científico
      </div>
      <h1 class="text-2xl font-black text-[#333333]">Moderación de Avistamientos</h1>
      <p class="text-xs text-[#777777]">
        Validación técnica de registros de campo reportados en Santander de Quilichao.
      </p>
    </div>
  </div>

  <!-- Pestañas de Estado (Filtros Rápidos) -->
  <div class="flex flex-wrap items-center gap-2 border-b border-[#B0B0B0] pb-2 text-xs font-mono font-bold">
    <a href="{{ route('admin.sightings.index') }}" class="px-3 py-1.5 rounded-sm border {{ !request('status') ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'bg-[#FFFFFF] text-[#333333] border-[#B0B0B0] hover:bg-[#F2F2F2]' }}">
      Todos los Registros
    </a>
    <a href="{{ route('admin.sightings.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-sm border {{ request('status') === 'pending' ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'bg-[#FFFFFF] text-[#333333] border-[#B0B0B0] hover:bg-[#F2F2F2]' }}">
      Pendientes de Moderación
    </a>
    <a href="{{ route('admin.sightings.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-sm border {{ request('status') === 'approved' ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'bg-[#FFFFFF] text-[#333333] border-[#B0B0B0] hover:bg-[#F2F2F2]' }}">
      Aprobados / Públicos
    </a>
    <a href="{{ route('admin.sightings.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 rounded-sm border {{ request('status') === 'rejected' ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'bg-[#FFFFFF] text-[#333333] border-[#B0B0B0] hover:bg-[#F2F2F2]' }}">
      Rechazados
    </a>
  </div>

  <!-- Tabla de Avistamientos -->
  <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse">
        <thead>
          <tr class="border-b border-[#B0B0B0] bg-[#F2F2F2] font-mono text-[11px] text-[#777777]">
            <th class="py-3 px-4"># ID</th>
            <th class="py-3 px-3">Especie Observada</th>
            <th class="py-3 px-3">Observador</th>
            <th class="py-3 px-3">Ubicación / Coordenadas</th>
            <th class="py-3 px-3">Ejemplares</th>
            <th class="py-3 px-3">Fecha</th>
            <th class="py-3 px-3">Estado</th>
            <th class="py-3 px-4 text-right">Acción</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#E0E0E0]">
          @forelse($sightings as $s)
            <tr class="hover:bg-[#F2F2F2]/50">
              <td class="py-3 px-4 font-mono font-bold text-[#777777]">
                #{{ $s->id }}
              </td>
              <td class="py-3 px-3">
                <span class="font-bold text-[#333333] block">{{ $s->species?->common_name }}</span>
                <span class="text-[10px] text-[#777777] font-serif italic">{{ $s->species?->scientific_name }}</span>
              </td>
              <td class="py-3 px-3 text-[#777777]">
                {{ $s->user?->name ?? 'Anónimo' }}
              </td>
              <td class="py-3 px-3">
                <span class="text-[#333333] font-medium block">{{ $s->location?->name ?? 'Punto libre' }}</span>
                <span class="text-[10px] font-mono text-[#777777]">{{ number_format($s->latitude, 4) }}, {{ number_format($s->longitude, 4) }}</span>
              </td>
              <td class="py-3 px-3 font-mono text-[11px] text-[#333333]">
                {{ $s->individuals_count }}
              </td>
              <td class="py-3 px-3 font-mono text-[11px] text-[#777777]">
                {{ $s->sighting_date?->format('d/m/Y') }}
              </td>
              <td class="py-3 px-3">
                @if($s->status === 'approved')
                  <span class="px-2 py-0.5 bg-[#333333] text-[#FFFFFF] text-[10px] font-mono rounded-xs">Aprobado</span>
                @elseif($s->status === 'pending')
                  <span class="px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono rounded-xs border border-[#B0B0B0]">Pendiente</span>
                @else
                  <span class="px-2 py-0.5 bg-[#E0E0E0] text-[#777777] text-[10px] font-mono rounded-xs">Rechazado</span>
                @endif
              </td>
              <td class="py-3 px-4 text-right">
                <div class="inline-flex items-center gap-1.5">
                  <a href="{{ route('admin.sightings.show', $s) }}" class="btn-wireframe-secondary text-[11px] py-1 px-2.5">
                    Revisar
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="py-8 text-center text-xs text-[#777777] font-mono">
                No hay avistamientos en este estado.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($sightings->hasPages())
      <div class="p-4 border-t border-[#B0B0B0] bg-[#F2F2F2]">
        {{ $sightings->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
