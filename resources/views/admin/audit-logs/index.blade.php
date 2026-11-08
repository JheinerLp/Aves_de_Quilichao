@extends('admin.layout')

@section('title', 'Historial de Auditoría')

@section('content')
<div class="space-y-6">

  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div class="space-y-1">
      <div class="inline-block px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
        Seguridad y Trazabilidad
      </div>
      <h1 class="text-2xl font-black text-[#333333]">Registro de Auditoría del Sistema</h1>
      <p class="text-xs text-[#777777]">
        Trazabilidad inmutable de inicios de sesión, cambios en especies, moderación de avistamientos y archivos.
      </p>
    </div>
  </div>

  <!-- Tabla de Auditoría -->
  <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse">
        <thead>
          <tr class="border-b border-[#B0B0B0] bg-[#F2F2F2] font-mono text-[11px] text-[#777777]">
            <th class="py-3 px-4">Fecha / Hora</th>
            <th class="py-3 px-3">Usuario Responsable</th>
            <th class="py-3 px-3">Acción</th>
            <th class="py-3 px-3">Entidad / Recurso</th>
            <th class="py-3 px-4">Detalle / Descripción</th>
            <th class="py-3 px-3 font-mono text-right">Dirección IP</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#E0E0E0]">
          @forelse($logs as $log)
            <tr class="hover:bg-[#F2F2F2]/50">
              <td class="py-3 px-4 font-mono text-[11px] text-[#777777] whitespace-nowrap">
                {{ $log->created_at?->format('d/m/Y H:i:s') }}
              </td>
              <td class="py-3 px-3">
                <span class="font-bold text-[#333333] block">{{ $log->user?->name ?? 'Sistema' }}</span>
                <span class="text-[10px] text-[#777777]">{{ $log->user?->email }}</span>
              </td>
              <td class="py-3 px-3">
                <span class="px-2 py-0.5 bg-[#F2F2F2] border border-[#B0B0B0] font-mono text-[10px] font-bold text-[#333333] rounded-xs uppercase">
                  {{ $log->action }}
                </span>
              </td>
              <td class="py-3 px-3 text-[#777777] font-mono text-[11px]">
                {{ class_basename($log->auditable_type) }} #{{ $log->auditable_id }}
              </td>
              <td class="py-3 px-4 text-[#333333]">
                {{ $log->description }}
              </td>
              <td class="py-3 px-3 font-mono text-[11px] text-[#777777] text-right whitespace-nowrap">
                {{ $log->ip_address }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-8 text-center text-xs text-[#777777] font-mono">
                No hay eventos registrados en la bitácora de auditoría.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($logs->hasPages())
      <div class="p-4 border-t border-[#B0B0B0] bg-[#F2F2F2]">
        {{ $logs->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
