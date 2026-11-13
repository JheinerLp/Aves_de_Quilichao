<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $species->common_name }} ({{ $species->scientific_name }}) - Ficha biológica de BioAves Quilichao, Cauca.">
  <title>{{ $species->common_name }} | BioAves Quilichao</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bv-inner bg-[#FFFFFF] text-[#333333] font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-[#D0D0D0] selection:text-[#333333]">

  <!-- Header -->
  @include('partials.header')

  <!-- Contenido de la Ficha -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-1 space-y-8">
    
    <!-- Encabezado de la Ficha -->
    <div class="p-6 sm:p-8 bg-[#F2F2F2] border-2 border-[#333333] rounded-sm space-y-3">
      <div class="flex flex-wrap items-center justify-between gap-2">
        <span class="text-[10px] font-mono uppercase tracking-wider text-[#777777]">
          Ficha Biológica Oficial • Santander de Quilichao
        </span>
        <span class="px-2.5 py-0.5 bg-[#D0D0D0] border border-[#B0B0B0] text-xs font-mono font-bold text-[#333333]">
          Estado UICN: {{ $species->uicn_status }}
        </span>
      </div>

      <h1 class="text-3xl sm:text-4xl font-black text-[#333333]">
        {{ $species->common_name }}
      </h1>
      <p class="text-base font-serif italic text-[#777777]">
        {{ $species->scientific_name }} • Familia: {{ $species->family?->name }} (Orden: {{ $species->family?->scientific_order }})
      </p>
    </div>

    <!-- Galería de la Ficha -->
    <div class="space-y-4">
      <h2 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
        Galería de Registros (Wireframe Low-Fidelity)
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($species->photos as $ph)
          <div
            class="wireframe-placeholder media-frame h-56 rounded-sm p-4 flex flex-col justify-between text-center overflow-hidden {{ !str_starts_with($ph->storage_path, 'placeholders/') ? 'media-photo-stage has-photo' : '' }}"
          >
            <span class="absolute z-10 top-2 left-1/2 -translate-x-1/2 px-2 py-1 rounded-full bg-white/80 text-[10px] font-mono text-[#31533b]">FOTOGRAFÍA #{{ $loop->iteration }}</span>
            @if(!str_starts_with($ph->storage_path, 'placeholders/'))
              <img
                src="{{ $ph->url }}"
                alt="{{ $species->common_name }}"
                class="absolute inset-0 w-full h-full object-cover"
                style="object-position: {{ str_contains($ph->file_name, '-detalle') ? 'center top' : 'center 35%' }}"
              >
            @else
              <strong class="text-xs font-mono text-[#333333]">{{ $ph->caption ?: $ph->file_name }}</strong>
              <span class="text-[10px] font-mono text-[#777777]">[PLACEHOLDER DE FOTOGRAFÍA]</span>
            @endif
          </div>
        @empty
          <div class="col-span-3 p-8 text-center text-xs font-mono text-[#777777] wireframe-placeholder">
            [PLACEHOLDER DE FOTOGRAFÍA REGISTRADA]
          </div>
        @endforelse
      </div>
      @php
        $availableVideos = $species->videos
          ->reject(fn ($video) => str_starts_with($video->storage_path, 'placeholders/'));
      @endphp
      @if($availableVideos->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @foreach($availableVideos as $video)
            <div class="media-video-card relative bg-black border border-[#B0B0B0]">
              <p class="media-caption">{{ $video->caption ?: ($loop->first ? 'Ave vocalizando' : 'Registro del canto') }}</p>
              <video controls preload="metadata" playsinline class="media-video w-full aspect-video object-cover bg-black" src="{{ $video->url }}" aria-label="{{ $species->common_name }}: {{ $video->caption ?: 'video' }}"></video>
            </div>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Información Biológica en Detalle -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
      
      <div class="md:col-span-8 space-y-6">
        <div class="space-y-2">
          <h3 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
            Descripción de la Especie
          </h3>
          <p class="text-sm text-[#333333] leading-relaxed">
            {{ $species->description }}
          </p>
        </div>

        @if($species->physical_characteristics)
          <div class="p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1">
            <strong class="text-xs font-bold text-[#333333] block">Rasgos Morfológicos y Dimensiones:</strong>
            <p class="text-xs text-[#777777] leading-relaxed">{{ $species->physical_characteristics }}</p>
          </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          @if($species->diet)
            <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
              <strong class="text-xs font-mono font-bold text-[#333333] block">Dieta y Alimentación:</strong>
              <p class="text-xs text-[#777777] leading-relaxed">{{ $species->diet }}</p>
            </div>
          @endif

          @if($species->behavior)
            <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-1">
              <strong class="text-xs font-mono font-bold text-[#333333] block">Comportamiento:</strong>
              <p class="text-xs text-[#777777] leading-relaxed">{{ $species->behavior }}</p>
            </div>
          @endif
        </div>
      </div>

      <div class="md:col-span-4 bg-[#F2F2F2] border border-[#B0B0B0] p-5 rounded-sm space-y-4 text-xs">
        <h4 class="font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
          Parámetros Biogeográficos
        </h4>

        <div>
          <span class="text-[10px] font-mono text-[#777777] block uppercase">Hábitat Principal:</span>
          <strong class="text-[#333333] text-sm">{{ $species->habitat?->name ?? 'Bosque Andino' }}</strong>
        </div>

        <div>
          <span class="text-[10px] font-mono text-[#777777] block uppercase">Categoría Ecológica:</span>
          <strong class="text-[#333333]">{{ ucfirst($species->category) }}</strong>
        </div>

        <div>
          <span class="text-[10px] font-mono text-[#777777] block uppercase">Distribución:</span>
          <span class="text-[#333333]">{{ $species->distribution ?? 'Cordillera Central y vertientes andinas del Cauca.' }}</span>
        </div>

        @if($species->approvedSightings->isNotEmpty())
          <div class="pt-3 border-t border-[#B0B0B0] space-y-1">
            <span class="text-[10px] font-mono text-[#777777] block uppercase">Avistamientos Validados:</span>
            <span class="font-mono font-bold text-[#333333]">{{ $species->approvedSightings->count() }} reporte(s) en Quilichao</span>
          </div>
        @endif
      </div>

    </div>

  </main>

  @include('partials.footer')

</body>
</html>
