@extends('admin.layout')

@section('title', 'Editar Especie: ' . $species->common_name)

@section('content')
<div class="space-y-6">

  <div class="flex items-center justify-between p-6 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
    <div>
      <span class="text-[10px] font-mono text-[#777777] uppercase block">Edición Taxonómica</span>
      <h1 class="text-2xl font-black text-[#333333]">Editar Especie: {{ $species->common_name }}</h1>
      <span class="text-xs font-serif italic text-[#777777]">{{ $species->scientific_name }}</span>
    </div>
    <a href="{{ route('admin.species.index') }}" class="btn-wireframe-secondary text-xs py-1.5 px-3">
      ← Volver al Listado
    </a>
  </div>

  @if($errors->any())
    <div class="p-4 bg-[#F2F2F2] border-2 border-[#333333] rounded-sm text-xs text-[#333333] space-y-1">
      <span class="font-bold block">[ERRORES DE VALIDACIÓN]:</span>
      <ul class="list-disc list-inside text-[11px] text-[#777777]">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.species.update', $species) }}" enctype="multipart/form-data" class="bg-[#FFFFFF] border-2 border-[#333333] p-6 sm:p-8 rounded-sm space-y-6">
    @csrf
    @method('PUT')

    <!-- Bloque 1: Identificación Taxonómica -->
    <div class="space-y-4">
      <h2 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
        1. Identificación y Taxonomía
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-1">
          <label for="common_name" class="block text-xs font-mono font-bold text-[#333333]">
            Nombre Común (*):
          </label>
          <input
            id="common_name"
            name="common_name"
            type="text"
            required
            value="{{ old('common_name', $species->common_name) }}"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >
        </div>

        <div class="space-y-1">
          <label for="scientific_name" class="block text-xs font-mono font-bold text-[#333333]">
            Nombre Científico (*):
          </label>
          <input
            id="scientific_name"
            name="scientific_name"
            type="text"
            required
            value="{{ old('scientific_name', $species->scientific_name) }}"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs font-serif italic rounded-sm focus:border-[#333333] focus:outline-none"
          >
        </div>

        <div class="space-y-1">
          <label for="family_id" class="block text-xs font-mono font-bold text-[#333333]">
            Familia Taxonómica (*):
          </label>
          <select
            id="family_id"
            name="family_id"
            required
            class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
          >
            @foreach($families as $fam)
              <option value="{{ $fam->id }}" {{ old('family_id', $species->family_id) == $fam->id ? 'selected' : '' }}>
                {{ $fam->name }} (Orden: {{ $fam->scientific_order }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="space-y-1">
          <label for="habitat_id" class="block text-xs font-mono font-bold text-[#333333]">
            Hábitat Principal:
          </label>
          <select
            id="habitat_id"
            name="habitat_id"
            class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
          >
            <option value="">Seleccionar hábitat...</option>
            @foreach($habitats as $hab)
              <option value="{{ $hab->id }}" {{ old('habitat_id', $species->habitat_id) == $hab->id ? 'selected' : '' }}>
                {{ $hab->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="space-y-1">
          <label for="category" class="block text-xs font-mono font-bold text-[#333333]">
            Categoría Biológica (*):
          </label>
          <select
            id="category"
            name="category"
            required
            class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
          >
            <option value="residente" {{ old('category', $species->category) == 'residente' ? 'selected' : '' }}>Residente Común</option>
            <option value="endemica" {{ old('category', $species->category) == 'endemica' ? 'selected' : '' }}>Endémica</option>
            <option value="migratoria" {{ old('category', $species->category) == 'migratoria' ? 'selected' : '' }}>Migratoria</option>
            <option value="amenazada" {{ old('category', $species->category) == 'amenazada' ? 'selected' : '' }}>Amenazada</option>
          </select>
        </div>

        <div class="space-y-1">
          <label for="uicn_status" class="block text-xs font-mono font-bold text-[#333333]">
            Estado UICN (*):
          </label>
          <select
            id="uicn_status"
            name="uicn_status"
            required
            class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
          >
            <option value="LC" {{ old('uicn_status', $species->uicn_status) == 'LC' ? 'selected' : '' }}>LC - Preocupación Menor</option>
            <option value="NT" {{ old('uicn_status', $species->uicn_status) == 'NT' ? 'selected' : '' }}>NT - Casi Amenazada</option>
            <option value="VU" {{ old('uicn_status', $species->uicn_status) == 'VU' ? 'selected' : '' }}>VU - Vulnerable</option>
            <option value="EN" {{ old('uicn_status', $species->uicn_status) == 'EN' ? 'selected' : '' }}>EN - En Peligro</option>
            <option value="CR" {{ old('uicn_status', $species->uicn_status) == 'CR' ? 'selected' : '' }}>CR - En Peligro Crítico</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Bloque 2: Ficha Técnica -->
    <div class="space-y-4">
      <h2 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
        2. Información Biológica y Ficha Técnica
      </h2>

      <div class="space-y-1">
        <label for="description" class="block text-xs font-mono font-bold text-[#333333]">
          Descripción General (*):
        </label>
        <textarea
          id="description"
          name="description"
          rows="3"
          required
          class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-3 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
        >{{ old('description', $species->description) }}</textarea>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-1">
          <label for="physical_characteristics" class="block text-xs font-mono font-bold text-[#333333]">
            Características Físicas y Dimensiones:
          </label>
          <textarea
            id="physical_characteristics"
            name="physical_characteristics"
            rows="2"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >{{ old('physical_characteristics', $species->physical_characteristics) }}</textarea>
        </div>

        <div class="space-y-1">
          <label for="diet" class="block text-xs font-mono font-bold text-[#333333]">
            Dieta y Alimentación:
          </label>
          <textarea
            id="diet"
            name="diet"
            rows="2"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >{{ old('diet', $species->diet) }}</textarea>
        </div>

        <div class="space-y-1">
          <label for="behavior" class="block text-xs font-mono font-bold text-[#333333]">
            Comportamiento y Etología:
          </label>
          <textarea
            id="behavior"
            name="behavior"
            rows="2"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >{{ old('behavior', $species->behavior) }}</textarea>
        </div>

        <div class="space-y-1">
          <label for="distribution" class="block text-xs font-mono font-bold text-[#333333]">
            Distribución Geográfica y Altitudinal:
          </label>
          <textarea
            id="distribution"
            name="distribution"
            rows="2"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >{{ old('distribution', $species->distribution) }}</textarea>
        </div>
      </div>
    </div>

    <!-- Bloque 3: Multimedia y Visibilidad -->
    <div class="space-y-4">
      <h2 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
        3. Multimedia y Opciones
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div class="space-y-1">
          <label for="photo" class="block text-xs font-mono font-bold text-[#333333]">
            Agregar Nueva Fotografía (Opcional):
          </label>
          <input
            id="photo"
            name="photo"
            type="file"
            accept="image/*"
            class="w-full bg-[#F2F2F2] border border-[#B0B0B0] p-1.5 text-xs rounded-sm"
          >
        </div>

        <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
          <label class="flex items-center gap-2 cursor-pointer select-none">
            <input
              type="checkbox"
              name="is_featured"
              value="1"
              {{ old('is_featured', $species->is_featured) ? 'checked' : '' }}
              class="border border-[#B0B0B0]"
            >
            <span class="text-xs font-bold text-[#333333]">Destacar en Carrusel Principal de la Portada</span>
          </label>
        </div>
      </div>

      <!-- Fotos existentes asociadas -->
      <div class="space-y-2 pt-2 border-t border-[#B0B0B0]">
        <span class="text-xs font-mono font-bold text-[#777777] block">Fotografías Asociadas ({{ $species->photos->count() }}):</span>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
          @forelse($species->photos as $ph)
            <div class="p-2.5 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-xs space-y-1">
              <span class="font-mono text-[10px] block text-[#777777]">Foto #{{ $loop->iteration }}</span>
              <strong class="text-[#333333] block text-[11px] truncate">{{ $ph->caption ?: $ph->file_name }}</strong>
            </div>
          @empty
            <div class="col-span-3 text-xs text-[#777777] font-mono">Sin fotografías adicionales adjuntas.</div>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Botones de Acción -->
    <div class="pt-4 border-t border-[#B0B0B0] flex items-center justify-end gap-3">
      <a href="{{ route('admin.species.index') }}" class="btn-wireframe-secondary text-xs py-2 px-4">
        Cancelar
      </a>
      <button type="submit" class="btn-wireframe-primary text-xs py-2 px-6">
        Actualizar Datos de la Especie
      </button>
    </div>

  </form>

</div>
@endsection
