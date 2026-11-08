<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Catálogo Completo de Aves de Santander de Quilichao - BioAves Quilichao. Prototipo de baja fidelidad en escala de grises.">
  <title>Catálogo Completo de Aves | BioAves Quilichao (Low-Fidelity Wireframe)</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Estilos del Wireframe en escala de grises estricta -->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-[#FFFFFF] text-[#333333] font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-[#D0D0D0] selection:text-[#333333]">

  <!-- ======================================================================
       NAVBAR CATÁLOGO
       ====================================================================== -->
  <header class="sticky top-0 z-40 bg-[#FFFFFF] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 py-3 flex items-center justify-between">
      
      <div class="flex items-center gap-3 sm:gap-4">
        <a href="{{ route('home') }}" class="btn-wireframe-secondary text-xs py-1.5 px-3 flex items-center gap-1.5">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          <span>← Volver al Inicio</span>
        </a>

        <div class="hidden sm:block h-6 w-px bg-[#B0B0B0]"></div>

        <div>
          <span class="text-base font-black tracking-wider uppercase text-[#333333]">
            BIOAVES QUILICHAO
          </span>
          <span class="hidden md:inline-block text-[11px] font-mono text-[#777777] ml-2">
            • Catálogo General de Especies
          </span>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('home') }}#mapa" class="btn-wireframe-ghost text-xs">
          Ver Mapa de Avistamientos
        </a>
        @auth
          <a href="{{ route('admin.dashboard') }}" class="btn-wireframe-primary text-xs">
            [Panel Admin]
          </a>
        @endauth
      </div>

    </div>
  </header>

  <!-- ======================================================================
       CONTENIDO PRINCIPAL DEL CATÁLOGO
       ====================================================================== -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-1 space-y-8">
    
    <!-- Encabezado de la Página -->
    <div class="p-6 sm:p-8 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-3">
      <div class="inline-block px-2.5 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
        Página Exclusiva de Catálogo • Prototipo de Baja Fidelidad
      </div>
      <h1 class="text-3xl sm:text-4xl font-black text-[#333333] tracking-tight">
        Catálogo de Aves de Santander de Quilichao
      </h1>
      <p class="text-xs sm:text-sm text-[#777777] max-w-3xl leading-relaxed">
        Inventario ornitológico con fichas detalladas de identificación. Selecciona cualquier ave para consultar su ficha técnica con <strong>3 fotografías pasables con botones</strong>, <strong>reproductor con el sonido de la especie</strong> y <strong>datos de ubicación territorial</strong>.
      </p>
    </div>

    <!-- Barra de Búsqueda y Filtros -->
    <div class="p-6 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-4">
      
      <!-- Fila 1: Búsqueda y Ordenamiento -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
          <label for="catalog-search" class="block text-xs font-bold uppercase font-mono text-[#333333] mb-1">
            Barra de Búsqueda (Nombre común o científico):
          </label>
          <input id="catalog-search" type="text" placeholder="Ejemplo: Momoto, Penelope perspicax, Barranquero, Tangara..." class="w-full bg-[#FFFFFF] border border-[#B0B0B0] text-xs sm:text-sm text-[#333333] px-3 py-2.5 rounded-sm focus:outline-none focus:border-[#333333]">
        </div>

        <div class="md:col-span-4">
          <label for="catalog-sort" class="block text-xs font-bold uppercase font-mono text-[#333333] mb-1">
            Selector de Ordenamiento:
          </label>
          <select id="catalog-sort" class="w-full bg-[#FFFFFF] border border-[#B0B0B0] text-xs sm:text-sm text-[#333333] px-3 py-2.5 rounded-sm focus:outline-none focus:border-[#333333]">
            <option value="name-asc">Nombre Común (A - Z)</option>
            <option value="name-desc">Nombre Común (Z - A)</option>
            <option value="scientific">Nombre Científico (A - Z)</option>
            <option value="family">Familia Taxonómica</option>
          </select>
        </div>
      </div>

      <!-- Fila 2: Filtros desplegables -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3 border-t border-[#B0B0B0]">
        <div>
          <label for="filter-habitat" class="block text-xs font-mono text-[#777777] mb-1">
            Filtro por Tipo de Hábitat:
          </label>
          <select id="filter-habitat" class="w-full bg-[#F2F2F2] border border-[#B0B0B0] text-xs text-[#333333] p-2 rounded-sm">
            <option value="all">Todos los hábitats</option>
            <option value="bosque-andino">Bosque andino y de niebla</option>
            <option value="humedal-rio">Humedales y ríos</option>
            <option value="cafetal-agroecosistema">Cafetales y agroecosistemas</option>
            <option value="urbano-jardines">Urbano y jardines</option>
          </select>
        </div>

        <div>
          <label for="filter-category" class="block text-xs font-mono text-[#777777] mb-1">
            Filtro por Categoría:
          </label>
          <select id="filter-category" class="w-full bg-[#F2F2F2] border border-[#B0B0B0] text-xs text-[#333333] p-2 rounded-sm">
            <option value="all">Todas las categorías</option>
            <option value="endemica">Endémica / Amenazada</option>
            <option value="residente">Residente común</option>
          </select>
        </div>

        <div class="flex items-end">
          <button id="reset-filters-btn" type="button" class="w-full btn-wireframe-secondary text-xs py-2">
            Limpiar filtros
          </button>
        </div>
      </div>

    </div>

    <!-- Contador de resultados -->
    <div class="flex items-center justify-between text-xs font-mono text-[#777777]">
      <span id="catalog-count-label">Cargando especies...</span>
      <span>Base demostrativa de Santander de Quilichao</span>
    </div>

    <!-- Cuadrícula de Tarjetas del Catálogo -->
    <div id="catalog-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <!-- Inyectado por JavaScript y renderizable por Blade -->
      @foreach($species as $sp)
        <div class="catalog-card-ssr hidden">
          <span>{{ $sp->common_name }}</span>
        </div>
      @endforeach
    </div>

  </main>

  <!-- ======================================================================
       FICHA DETALLADA DE CADA AVE (MODAL MULTI-BLOQUE A, B, C, D, E)
       ====================================================================== -->
  <div id="modal-detalle-ave" class="fixed inset-0 z-50 hidden bg-[#333333]/70 backdrop-blur-xs flex items-center justify-center p-3 sm:p-5 overflow-y-auto">
    <div class="relative w-full max-w-4xl bg-[#FFFFFF] border-2 border-[#333333] rounded-sm overflow-hidden my-auto shadow-2xl">
      
      <!-- Encabezado del Modal -->
      <div class="p-5 border-b border-[#B0B0B0] bg-[#F2F2F2] flex items-start justify-between">
        <div>
          <span class="text-[10px] font-mono uppercase tracking-wider text-[#777777]">Ficha Técnica Detallada • BioAves Quilichao</span>
          <div class="flex flex-wrap items-center gap-3 mt-0.5">
            <h2 id="modal-common-name" class="text-2xl font-black text-[#333333]">Nombre Común</h2>
            <span id="modal-status-badge" class="px-2 py-0.5 bg-[#D0D0D0] border border-[#B0B0B0] text-xs font-mono text-[#333333]">
              Estado UICN
            </span>
          </div>
          <p id="modal-scientific-name" class="text-xs font-mono italic text-[#777777]">Nombre Científico • Familia</p>
        </div>

        <button id="modal-close-btn" type="button" class="px-3 py-1 bg-[#D0D0D0] hover:bg-[#B0B0B0] text-[#333333] font-mono text-xs font-bold border border-[#B0B0B0] rounded-sm transition-colors" aria-label="Cerrar modal">
          [ CERRAR X ]
        </button>
      </div>

      <!-- Contenido en bloques (A, B, C, D, E) -->
      <div class="p-6 space-y-8 max-h-[78vh] overflow-y-auto">
        
        <!-- B. GALERÍA MULTIMEDIA (3 Fotos con botones + Video) -->
        <div class="space-y-3">
          <div class="flex items-center justify-between text-xs font-mono border-b border-[#B0B0B0] pb-1">
            <span class="font-bold uppercase text-[#333333]">B. Galería Multimedia (3 Fotografías Pasables con Botones)</span>
            <span id="modal-photo-indicator" class="text-[#777777]">Foto 1 de 3</span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            
            <!-- Visor de Fotos con botones Prev y Next (8 cols) -->
            <div class="md:col-span-8 relative h-64 sm:h-72 wireframe-placeholder rounded-sm flex flex-col items-center justify-center p-4">
              <span id="modal-photo-label" class="text-sm font-bold text-[#333333] text-center max-w-sm">
                [PLACEHOLDER DE FOTOGRAFÍA 1 DE 3]
              </span>
              <span class="text-[11px] text-[#777777] font-mono mt-1">
                Representación wireframe sin imágenes reales
              </span>

              <!-- Botones de navegación de fotografías -->
              <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between">
                <button id="modal-photo-prev" type="button" class="btn-wireframe-secondary text-xs py-1 px-3">
                  ← Anterior
                </button>
                <div class="flex gap-1.5">
                  <span class="photo-dot-indicator w-3 h-3 bg-[#333333] rounded-xs inline-block"></span>
                  <span class="photo-dot-indicator w-2.5 h-2.5 bg-[#B0B0B0] rounded-xs inline-block"></span>
                  <span class="photo-dot-indicator w-2.5 h-2.5 bg-[#B0B0B0] rounded-xs inline-block"></span>
                </div>
                <button id="modal-photo-next" type="button" class="btn-wireframe-secondary text-xs py-1 px-3">
                  Siguiente →
                </button>
              </div>
            </div>

            <!-- Placeholder de Video (4 cols) -->
            <div class="md:col-span-4 h-64 sm:h-72 wireframe-placeholder-dark rounded-sm p-4 flex flex-col justify-between text-center">
              <span class="text-[10px] font-mono text-[#D0D0D0] uppercase">Registro de Video</span>
              <span id="modal-video-label" class="text-xs font-bold text-[#FFFFFF]">
                [PLACEHOLDER DE VIDEO: COMPORTAMIENTO]
              </span>
              <span class="text-[10px] text-[#D0D0D0] font-mono">
                Demostración de etología en Santander de Quilichao
              </span>
            </div>

          </div>
        </div>

        <!-- C. SONIDOS Y CANTOS (Reproductor de Audio) -->
        <div class="p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-3">
          <div class="flex items-center justify-between text-xs font-mono">
            <span class="font-bold uppercase text-[#333333]">C. Sonidos y Cantos de la Especie</span>
            <span id="audio-duration-display" class="text-[#777777]">0:00 / 0:28</span>
          </div>

          <audio id="modal-species-audio" preload="none"></audio>

          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
            <button id="modal-audio-toggle-btn" type="button" class="btn-wireframe-primary text-xs py-2 px-4 flex-shrink-0">
              <span id="audio-btn-icon">▶</span>
              <span id="audio-btn-text">Reproducir Canto</span>
            </button>

            <div class="flex-1 space-y-1">
              <div class="flex items-center justify-between text-[11px] font-mono text-[#777777]">
                <span id="audio-state-text">Reproductor en espera [PLACEHOLDER DE AUDIO]</span>
              </div>
              <div class="w-full bg-[#D0D0D0] h-2 border border-[#B0B0B0] rounded-xs overflow-hidden">
                <div id="audio-progress-bar" class="bg-[#333333] h-full w-0 transition-all duration-150"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- A. INFORMACIÓN GENERAL -->
        <div class="space-y-3">
          <h3 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
            A. Información General y Morfología
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 space-y-2">
              <p id="modal-description" class="text-xs text-[#333333] leading-relaxed"></p>
              <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
                <span class="text-[11px] font-bold text-[#333333] block mb-0.5">Rasgos Morfológicos:</span>
                <p id="modal-physical" class="text-xs text-[#777777] leading-relaxed"></p>
              </div>
            </div>

            <div class="md:col-span-4 bg-[#F2F2F2] border border-[#B0B0B0] p-3 rounded-sm space-y-2 text-xs">
              <div>
                <span class="text-[#777777] text-[10px] font-mono block">HÁBITAT PRINCIPAL</span>
                <span id="modal-habitat" class="font-bold text-[#333333]"></span>
              </div>
              <div>
                <span class="text-[#777777] text-[10px] font-mono block">CATEGORÍA ECOLÓGICA</span>
                <span id="modal-category" class="font-bold text-[#333333]"></span>
              </div>
              <div>
                <span class="text-[#777777] text-[10px] font-mono block">DISTRIBUCIÓN ALTITUDINAL</span>
                <span id="modal-distribution" class="text-[#333333]"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- D. INFORMACIÓN BIOLÓGICA -->
        <div class="space-y-3">
          <h3 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
            D. Información Biológica y Ecológica
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
              <span class="font-mono font-bold text-[#333333] block">Hábitat:</span>
              <p id="modal-habitat-text" class="text-[#777777] mt-1">Hábitat...</p>
            </div>
            <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
              <span class="font-mono font-bold text-[#333333] block">Alimentación:</span>
              <p id="modal-diet-text" class="text-[#777777] mt-1">Alimentación...</p>
            </div>
            <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
              <span class="font-mono font-bold text-[#333333] block">Comportamiento:</span>
              <p id="modal-behavior-text" class="text-[#777777] mt-1">Comportamiento...</p>
            </div>
            <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
              <span class="font-mono font-bold text-[#333333] block">Distribución:</span>
              <p id="modal-distribution-text" class="text-[#777777] mt-1">Distribución...</p>
            </div>
          </div>
        </div>

        <!-- E. UBICACIÓN GEOGRÁFICA -->
        <div class="space-y-3">
          <h3 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
            E. Ubicación y Lugares Registrados en Santander de Quilichao
          </h3>
          
          <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <div class="md:col-span-8 p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-2 text-xs">
              <div class="flex items-center justify-between">
                <span class="font-bold text-[#333333]">Punto de Registro Documentado:</span>
                <span id="modal-sighting-date" class="font-mono text-[#777777]">Fecha</span>
              </div>
              <p id="modal-sighting-loc" class="text-[#333333] font-bold text-sm">Lugar</p>
              <p id="modal-sighting-notes" class="text-[#777777]">Notas de campo...</p>
              <div class="text-[11px] font-mono text-[#777777] flex gap-4 pt-1">
                <span id="modal-sighting-coords">Coord: 0.0, 0.0</span>
                <span id="modal-sighting-elevation">Alt: 0 msnm</span>
              </div>
            </div>

            <div class="md:col-span-4 h-full flex flex-col justify-center gap-2">
              <div class="h-20 wireframe-placeholder">
                [PLACEHOLDER DE MAPA DE REGISTRO]
              </div>
              <a href="{{ route('home') }}#mapa" class="btn-wireframe-primary text-xs py-2 w-full text-center">
                Ver en el Mapa Principal →
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Pie del modal -->
      <div class="p-4 bg-[#F2F2F2] border-t border-[#B0B0B0] flex items-center justify-between text-[11px] font-mono text-[#777777]">
        <span>Santander de Quilichao • Prototipo de Baja Fidelidad</span>
        <button id="modal-footer-close" type="button" class="btn-wireframe-secondary text-xs py-1 px-3">
          Cerrar Ficha
        </button>
      </div>

    </div>
  </div>

  <!-- Pie de Página del Catálogo -->
  <footer class="bg-[#111111] text-[#FFFFFF] py-6 border-t border-[#777777] mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-[#D0D0D0]">
      <span>BioAves Quilichao • Catálogo Ornitológico Territorial</span>
      <div class="flex items-center gap-4">
        <a href="{{ route('home') }}" class="hover:underline text-[#FFFFFF]">Inicio</a>
        <a href="{{ route('home') }}#mapa" class="hover:underline text-[#FFFFFF]">Mapa de Avistamientos</a>
        <a href="{{ route('login') }}" class="hover:underline text-[#777777]">Acceso</a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ asset('js/birds-data.js') }}"></script>
  <script src="{{ asset('js/catalogo.js') }}"></script>
</body>
</html>
