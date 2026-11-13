@extends('admin.layout')

@section('title', 'Catálogo de Especies')

@section('content')
<div class="space-y-6">

  <!-- Encabezado con Botón de Creación -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div class="space-y-1">
      <div class="inline-block px-2 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
        Módulo Taxonómico
      </div>
      <h1 class="text-2xl font-black text-[#333333]">Gestión de Especies del Catálogo</h1>
      <p class="text-xs text-[#777777]">
        Control de fichas biológicas, estado de conservación UICN y clasificación.
      </p>
    </div>

    @can('create', App\Models\Species::class)
      <a href="{{ route('admin.species.create') }}" class="btn-wireframe-primary text-xs py-2 px-4 text-center">
        + Registrar Nueva Especie
      </a>
    @endcan
  </div>

  <!-- Barra de Filtros y Búsqueda -->
  <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm">
    <form method="GET" action="{{ route('admin.species.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end">
      
      <div class="sm:col-span-5">
        <label for="search" class="block text-xs font-mono font-bold text-[#333333] mb-1">
          Buscar Especie:
        </label>
        <input
          id="search"
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Nombre común o científico..."
          class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-1.5 text-xs text-[#333333] rounded-sm focus:outline-none focus:border-[#333333]"
        >
      </div>

      <div class="sm:col-span-4">
        <label for="family_id" class="block text-xs font-mono font-bold text-[#333333] mb-1">
          Familia Taxonómica:
        </label>
        <select
          id="family_id"
          name="family_id"
          class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-1.5 text-xs text-[#333333] rounded-sm focus:outline-none"
        >
          <option value="">Todas las familias</option>
          @foreach($families as $fam)
            <option value="{{ $fam->id }}" {{ request('family_id') == $fam->id ? 'selected' : '' }}>
              {{ $fam->name }} ({{ $fam->scientific_order }})
            </option>
          @endforeach
        </select>
      </div>

      <div class="sm:col-span-3 flex gap-2">
        <button type="submit" class="w-full btn-wireframe-primary text-xs py-1.5">
          Filtrar
        </button>
        <a href="{{ route('admin.species.index') }}" class="btn-wireframe-secondary text-xs py-1.5 px-3">
          Limpiar
        </a>
      </div>

    </form>
  </div>

  <!-- Tabla de Especies -->
  <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse">
        <thead>
          <tr class="border-b border-[#B0B0B0] bg-[#F2F2F2] font-mono text-[11px] text-[#777777]">
            <th class="py-3 px-4">Especie / Nombre Científico</th>
            <th class="py-3 px-3">Familia</th>
            <th class="py-3 px-3">Hábitat</th>
            <th class="py-3 px-3">Estado UICN</th>
            <th class="py-3 px-3">Categoría</th>
            <th class="py-3 px-3">Estado</th>
            <th class="py-3 px-4 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#E0E0E0]">
          @forelse($species as $sp)
            <tr class="hover:bg-[#F2F2F2]/50 {{ $sp->is_archived ? 'opacity-60 bg-[#FAFAFA]' : '' }}">
              <td class="py-3 px-4">
                <span class="font-bold text-[#333333] text-sm block">{{ $sp->common_name }}</span>
                <span class="font-serif italic text-xs text-[#777777]">{{ $sp->scientific_name }}</span>
                @if($sp->is_featured)
                  <span class="ml-1 px-1.5 py-0.2 bg-[#D0D0D0] text-[9px] font-mono border border-[#B0B0B0]">Destacada</span>
                @endif
              </td>
              <td class="py-3 px-3 text-[#777777]">
                {{ $sp->family?->name ?? 'No asignada' }}
              </td>
              <td class="py-3 px-3 text-[#777777]">
                {{ $sp->habitat?->name ?? 'Múltiples' }}
              </td>
              <td class="py-3 px-3">
                <span class="px-2 py-0.5 bg-[#F2F2F2] border border-[#B0B0B0] font-mono text-[10px] font-bold text-[#333333] rounded-xs">
                  {{ $sp->uicn_status }}
                </span>
              </td>
              <td class="py-3 px-3 font-mono text-[11px] text-[#777777]">
                {{ ucfirst($sp->category) }}
              </td>
              <td class="py-3 px-3">
                @if($sp->is_archived)
                  <span class="px-2 py-0.5 bg-[#D0D0D0] text-[#777777] font-mono text-[10px] rounded-xs">Archivada</span>
                @else
                  <span class="px-2 py-0.5 bg-[#333333] text-[#FFFFFF] font-mono text-[10px] rounded-xs">Activa</span>
                @endif
              </td>
              <td class="py-3 px-4 text-right">
                <div class="inline-flex items-center gap-1.5">
                  @can('update', $sp)
                    <a href="{{ route('admin.species.edit', $sp) }}" class="btn-wireframe-secondary text-[11px] py-1 px-2.5">
                      Editar
                    </a>
                  @endcan

                  @can('delete', $sp)
                    <form method="POST" action="{{ route('admin.species.archive', $sp) }}" class="inline">
                      @csrf
                      @method('PATCH')
                      <button
                        type="submit"
                        onclick="return confirm('¿Seguro que deseas cambiar el estado de {{ $sp->common_name }}?');"
                        class="btn-wireframe-ghost text-[11px] py-1 px-2"
                      >
                        {{ $sp->is_archived ? 'Restaurar' : 'Archivar' }}
                      </button>
                    </form>
                  @endcan
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-8 text-center text-xs text-[#777777] font-mono">
                No se encontraron especies que coincidan con los criterios de búsqueda.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($species->hasPages())
      <div class="p-4 border-t border-[#B0B0B0] bg-[#F2F2F2]">
        {{ $species->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
