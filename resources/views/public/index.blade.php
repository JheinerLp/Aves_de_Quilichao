<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="BioAves Quilichao - Prototipo web de baja fidelidad (Low-Fidelity Wireframe) para observación y conservación de aves en Santander de Quilichao, Cauca.">
  <title>BioAves Quilichao | Prototipo de Baja Fidelidad</title>

  <!-- Tailwind CSS CDN para composición de retículas -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Leaflet CSS para el mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

  <!-- Estilos del Wireframe en escala de grises estricta -->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-[#FFFFFF] text-[#333333] font-sans antialiased selection:bg-[#D0D0D0] selection:text-[#333333]">

  <!-- ======================================================================
       3. NAVBAR — NAVEGACIÓN PRINCIPAL
       ====================================================================== -->
  <header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 transition-colors duration-200 border-b border-[#B0B0B0] bg-[#FFFFFF]/90 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 py-3 flex items-center justify-between">
      
      <!-- Logotipo Textual -->
      <a href="{{ route('home') }}#inicio" class="flex flex-col group text-decoration-none">
        <span class="text-lg font-black tracking-widest text-[#333333] uppercase">
          BIOAVES QUILICHAO
        </span>
        <span class="text-[10px] font-mono tracking-wider text-[#777777] uppercase -mt-0.5">
          Santander de Quilichao • Prototipo Wireframe
        </span>
      </a>

      <!-- Navegación Escritorio -->
      <nav class="hidden lg:flex items-center gap-1 sm:gap-2">
        <a href="#inicio" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Inicio
        </a>
        <a href="#carrusel" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Aves Destacadas
        </a>
        <a href="#rutas" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Rutas de Avistamiento
        </a>
        <a href="#mapa" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Mapa de Avistamientos
        </a>
        <a href="#reportar-avistamiento" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Reportar Avistamiento
        </a>
        <a href="#conservacion" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Conservación
        </a>
        <a href="#sobre-nosotros" class="px-3 py-1.5 text-xs font-semibold text-[#333333] hover:bg-[#F2F2F2] border border-transparent hover:border-[#B0B0B0] rounded-sm transition-all">
          Sobre Nosotros
        </a>
        <!-- Enlace que lleva a la página independiente del Catálogo -->
        <a href="{{ route('catalog.index') }}" class="ml-2 px-3.5 py-1.5 text-xs font-bold text-[#FFFFFF] bg-[#333333] hover:bg-[#000000] border border-[#333333] rounded-sm transition-all flex items-center gap-1">
          <span>Catálogo</span>
          <span class="text-[10px] font-mono">↗</span>
        </a>
        @auth
          <a href="{{ route('admin.dashboard') }}" class="ml-1 px-3 py-1.5 text-xs font-bold text-[#333333] bg-[#E0E0E0] hover:bg-[#D0D0D0] border border-[#B0B0B0] rounded-sm transition-all">
            [Panel Admin]
          </a>
        @else
          <a href="{{ route('login') }}" class="ml-1 px-3 py-1.5 text-xs font-semibold text-[#777777] hover:text-[#333333] border border-dashed border-[#B0B0B0] rounded-sm transition-all">
            Acceso
          </a>
        @endauth
      </nav>

      <!-- Botón móvil (Hamburguesa) -->
      <button id="mobile-menu-btn" type="button" class="lg:hidden p-2 border border-[#B0B0B0] bg-[#F2F2F2] text-[#333333] rounded-sm" aria-label="Abrir menú de navegación">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

    </div>

    <!-- Menú Desplegable Móvil -->
    <div id="mobile-menu" class="hidden lg:hidden px-4 pt-2 pb-6 bg-[#FFFFFF] border-b border-[#B0B0B0] space-y-2">
      <a href="#inicio" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Inicio
      </a>
      <a href="#carrusel" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Aves Destacadas
      </a>
      <a href="#rutas" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Rutas de Avistamiento
      </a>
      <a href="#mapa" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Mapa de Avistamientos
      </a>
      <a href="#reportar-avistamiento" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Reportar Avistamiento
      </a>
      <a href="#conservacion" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Conservación
      </a>
      <a href="#sobre-nosotros" class="block px-3 py-2 text-xs font-semibold text-[#333333] bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm">
        Sobre Nosotros
      </a>
      <a href="{{ route('catalog.index') }}" class="block px-3 py-2 text-xs font-bold text-[#FFFFFF] bg-[#333333] border border-[#333333] rounded-sm text-center">
        Abrir Catálogo de Aves (Página Completa ↗)
      </a>
      @auth
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-xs font-bold text-[#333333] bg-[#E0E0E0] border border-[#B0B0B0] rounded-sm text-center">
          Ir al Panel de Administración
        </a>
      @endauth
    </div>
  </header>

  <!-- ======================================================================
       4. HERO — PORTADA PRINCIPAL (85-100% de la altura inicial)
          - Video panorámico en el fondo (Atrás)
          - Cuadrito "Descubre las aves..." adelante y desplazado bien a la izquierda
       ====================================================================== -->
  <section id="inicio" class="min-h-[92vh] flex items-center relative overflow-hidden border-b border-[#B0B0B0] bg-[#333333]">
    
    <!-- Área de fondo completa reservada para video panorámico (Atrás) -->
    <div class="absolute inset-0 w-full h-full wireframe-placeholder-dark flex flex-col items-center justify-center p-6 text-center select-none">
      <div class="w-16 h-16 sm:w-20 sm:h-20 border-2 border-[#D0D0D0] bg-[#111111] flex items-center justify-center mb-4 rounded-sm">
        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#D0D0D0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <span class="text-base sm:text-xl font-bold tracking-widest text-[#FFFFFF] max-w-2xl px-4">
        [VIDEO DE AVE VOLANDO SOBRE SANTANDER DE QUILICHAO]
      </span>
      <span class="text-xs text-[#D0D0D0] mt-2 font-mono max-w-lg px-4">
        Espacio panorámico de fondo en loop (1080p, paisaje de montaña, río y avifauna en vuelo)
      </span>
      
      <!-- Indicador de formato en esquina inferior derecha -->
      <div class="absolute bottom-6 right-6 px-3 py-1 bg-[#111111] border border-[#777777] text-[11px] font-mono text-[#D0D0D0] rounded-sm">
        [PLACEHOLDER DE VIDEO: FONDO COMPLETO]
      </div>
    </div>

    <!-- Contenedor en primer plano (Adelante y desplazado a la izquierda) -->
    <div class="relative z-10 w-full px-4 sm:px-8 lg:px-16 py-28 sm:py-36 flex justify-start">
      
      <!-- Cuadrito "Descubre las aves de nuestro territorio" posicionado bien a la izquierda -->
      <div class="w-full max-w-md lg:max-w-lg bg-[#FFFFFF] border-2 border-[#333333] p-7 sm:p-9 rounded-sm shadow-2xl space-y-5">
        
        <div class="inline-block px-3 py-1 bg-[#D0D0D0] text-[#333333] text-[11px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
          BioAves Quilichao • Santander de Quilichao
        </div>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#333333] leading-tight">
          Descubre las aves de nuestro territorio
        </h1>

        <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
          Plataforma dedicada a la observación, identificación, registro cartográfico y conservación de la avifauna en el municipio de Santander de Quilichao, departamento del Cauca.
        </p>

        <!-- Botón Catálogo lleva a la página independiente catalogo.html -->
        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
          <a href="{{ route('catalog.index') }}" class="btn-wireframe-primary text-center">
            <span>Explorar catálogo de aves ↗</span>
          </a>
          <a href="#sobre-nosotros" class="btn-wireframe-secondary text-center">
            <span>Conoce nuestra misión</span>
          </a>
        </div>

        <div class="pt-3 border-t border-[#B0B0B0] text-[11px] font-mono text-[#777777] flex items-center justify-between">
          <span>Eslogan: Descubre. Escucha. Explora. Conserva.</span>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       5. SECCIÓN — INTRODUCCIÓN A LA BIODIVERSIDAD (Indicadores estadísticos)
       ====================================================================== -->
  <section id="introduccion" class="py-16 bg-[#F2F2F2] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
      
      <div class="max-w-3xl space-y-3">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
          Contexto Biogeográfico
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#333333]">
          Un territorio lleno de vida
        </h2>
        <p class="text-sm sm:text-base text-[#777777] leading-relaxed">
          Santander de Quilichao confluye entre los pisos térmicos cálidos del valle geográfico del Río Cauca y las estribaciones de la Cordillera Central. Esta gradiente altitudinal origina diversos ecosistemas que albergan aves endémicas, residentes y migratorias de gran valor ecológico.
        </p>
      </div>

      <!-- Tres indicadores estadísticos -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="p-6 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2">
          <div class="flex items-baseline gap-2">
            <span class="text-4xl sm:text-5xl font-black text-[#333333]">{{ $species->count() }}</span>
            <span class="text-xs font-mono text-[#777777]">[Catálogo activo]</span>
          </div>
          <h3 class="text-base font-bold text-[#333333]">Especies registradas</h3>
          <p class="text-xs text-[#777777] leading-relaxed">
            Diversidad catalogada con fichas biológicas completas entre áreas urbanas, cuencas hídricas y reservas de montaña.
          </p>
        </div>

        <div class="p-6 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2">
          <div class="flex items-baseline gap-2">
            <span class="text-4xl sm:text-5xl font-black text-[#333333]">{{ $locations->count() }}</span>
            <span class="text-xs font-mono text-[#777777]">[Sectores muestreados]</span>
          </div>
          <h3 class="text-base font-bold text-[#333333]">Lugares de avistamiento</h3>
          <p class="text-xs text-[#777777] leading-relaxed">
            Sectores georreferenciados: humedales, senderos ribereños, bosques de niebla y agroecosistemas cafeteros.
          </p>
        </div>

        <div class="p-6 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2">
          <div class="flex items-baseline gap-2">
            <span class="text-4xl sm:text-5xl font-black text-[#333333]">{{ $sightings->count() }}</span>
            <span class="text-xs font-mono text-[#777777]">[Validación biológica]</span>
          </div>
          <h3 class="text-base font-bold text-[#333333]">Observaciones verificadas</h3>
          <p class="text-xs text-[#777777] leading-relaxed">
            Registros ornitológicos geolocalizados validados por el equipo curador de la plataforma.
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       6. CARRUSEL AUTOMÁTICO DE AVES DESTACADAS
          - Borde animado con doble línea gris en la tarjeta central
          - Desplazamiento automático pausado en hover
       ====================================================================== -->
  <section id="carrusel" class="py-20 bg-[#FFFFFF] border-b border-[#B0B0B0] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
          <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
            Galería Dinámica
          </span>
          <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
            Aves representativas de Santander de Quilichao
          </h2>
          <p class="text-xs sm:text-sm text-[#777777] mt-1">
            Carrusel continuo de especies. La tarjeta central se resalta con doble línea de contorno. Pasa el cursor para pausar el movimiento.
          </p>
        </div>

        <!-- Controles manuales y acceso al catálogo completo -->
        <div class="flex items-center gap-3">
          <a href="{{ route('catalog.index') }}" class="hidden sm:inline-block px-3 py-1 bg-[#FFFFFF] border border-[#B0B0B0] text-[11px] font-mono text-[#333333] hover:bg-[#F2F2F2]">
            Ver Catálogo Completo ↗
          </a>

          <span id="carousel-status-indicator" class="px-3 py-1 bg-[#F2F2F2] border border-[#B0B0B0] text-[11px] font-mono text-[#333333]">
            Auto-Desplazamiento Activo
          </span>

          <div class="flex items-center gap-1">
            <button id="carousel-prev-btn" type="button" class="w-9 h-9 border border-[#B0B0B0] bg-[#F2F2F2] hover:bg-[#D0D0D0] text-[#333333] flex items-center justify-center rounded-sm transition-colors" aria-label="Anterior ave">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>
            </button>
            <button id="carousel-next-btn" type="button" class="w-9 h-9 border border-[#B0B0B0] bg-[#F2F2F2] hover:bg-[#D0D0D0] text-[#333333] flex items-center justify-center rounded-sm transition-colors" aria-label="Siguiente ave">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Contenedor del Carrusel Horizontal Centrado -->
      <div id="carousel-container" class="w-full overflow-x-auto no-scrollbar py-8 px-2 cursor-grab active:cursor-grabbing">
        <div id="carousel-track" class="flex gap-6 items-center w-max">
          <!-- Inyectado por JavaScript mediante BIOAVES_DATA -->
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-between text-xs font-mono text-[#777777] pt-2 border-t border-[#B0B0B0]">
        <span>Pasa el cursor para pausar • En móvil desplaza con el dedo • Clic en "Conocer especie" para ver ficha</span>
        <span class="mt-2 sm:mt-0">[Efecto Arcoíris Wireframe: Borde doble línea gris en tarjeta central]</span>
      </div>

    </div>
  </section>

  <!-- ======================================================================
       7. SECCIÓN — RUTAS Y PUNTOS DE OBSERVACIÓN
       ====================================================================== -->
  <section id="rutas" class="py-20 bg-[#F2F2F2] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
      
      <div class="max-w-3xl space-y-2">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
          Senderos y Rutas
        </span>
        <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
          Dónde pajarear en Santander de Quilichao
        </h2>
        <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
          Recorridos recomendados para avistamiento según el nivel de dificultad, ecosistema y horario recomendado.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Ruta 1 -->
        <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-6 space-y-4 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="wireframe-placeholder-dark h-36 flex flex-col items-center justify-center p-3 text-center rounded-sm">
              <span class="text-xs font-bold font-mono text-[#FFFFFF]">[PLACEHOLDER DE FOTOGRAFÍA: SENDERO RÍO QUILICHAO]</span>
              <span class="text-[10px] text-[#D0D0D0] mt-1">Bosque de ribera y cañadas</span>
            </div>
            <div class="flex items-center justify-between text-[10px] font-mono text-[#777777]">
              <span>Dificultad: Baja</span>
              <span>Distancia: 3.2 km</span>
            </div>
            <h3 class="text-base font-bold text-[#333333]">Ruta Urbana: Sendero Fluvial del Río Quilichao</h3>
            <p class="text-xs text-[#777777] leading-relaxed">
              Recorrido accesible ideal para mañanas tempranas. Posibilidad alta de observar Momoto Andino, Tangaras y Garzas en las orillas sombreadas.
            </p>
          </div>
          <div class="pt-3 border-t border-[#B0B0B0] flex items-center justify-between">
            <span class="text-[11px] font-mono text-[#333333] font-bold">1.060 msnm</span>
            <a href="#mapa" class="text-xs font-bold text-[#333333] underline hover:no-underline">Ver en el mapa →</a>
          </div>
        </div>

        <!-- Ruta 2 -->
        <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-6 space-y-4 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="wireframe-placeholder-dark h-36 flex flex-col items-center justify-center p-3 text-center rounded-sm">
              <span class="text-xs font-bold font-mono text-[#FFFFFF]">[PLACEHOLDER DE FOTOGRAFÍA: RESERVA SAN ANTONIO]</span>
              <span class="text-[10px] text-[#D0D0D0] mt-1">Bosque de niebla altoandino</span>
            </div>
            <div class="flex items-center justify-between text-[10px] font-mono text-[#777777]">
              <span>Dificultad: Media - Alta</span>
              <span>Distancia: 5.8 km</span>
            </div>
            <h3 class="text-base font-bold text-[#333333]">Ruta de Niebla: Vereda San Antonio</h3>
            <p class="text-xs text-[#777777] leading-relaxed">
              Ascenso a las laderas montañosas de la Cordillera Central. Territorio clave para el avistamiento de la Pava Caucana (Penelope perspicax) y tucanes andinos.
            </p>
          </div>
          <div class="pt-3 border-t border-[#B0B0B0] flex items-center justify-between">
            <span class="text-[11px] font-mono text-[#333333] font-bold">1.750 msnm</span>
            <a href="#mapa" class="text-xs font-bold text-[#333333] underline hover:no-underline">Ver en el mapa →</a>
          </div>
        </div>

        <!-- Ruta 3 -->
        <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-6 space-y-4 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="wireframe-placeholder-dark h-36 flex flex-col items-center justify-center p-3 text-center rounded-sm">
              <span class="text-xs font-bold font-mono text-[#FFFFFF]">[PLACEHOLDER DE FOTOGRAFÍA: HUMEDAL EL SAMÁN]</span>
              <span class="text-[10px] text-[#D0D0D0] mt-1">Humedales y meandros de valle</span>
            </div>
            <div class="flex items-center justify-between text-[10px] font-mono text-[#777777]">
              <span>Dificultad: Muy Baja</span>
              <span>Distancia: 1.5 km</span>
            </div>
            <h3 class="text-base font-bold text-[#333333]">Circuito de Humedales: El Samán y Microcuencas</h3>
            <p class="text-xs text-[#777777] leading-relaxed">
              Espejos de agua lénticos con avifauna acuática diversa: Garza Tigre Cuellifasta, pollas de agua, Martín Pescador y aves limícolas migratorias.
            </p>
          </div>
          <div class="pt-3 border-t border-[#B0B0B0] flex items-center justify-between">
            <span class="text-[11px] font-mono text-[#333333] font-bold">1.045 msnm</span>
            <a href="#mapa" class="text-xs font-bold text-[#333333] underline hover:no-underline">Ver en el mapa →</a>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       8. SECCIÓN — MAPA DE AVISTAMIENTOS INTERACTIVO
       ====================================================================== -->
  <section id="mapa" class="py-20 bg-[#FFFFFF] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      
      <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4">
        <div class="max-w-3xl space-y-2">
          <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
            Georreferenciación Territorial
          </span>
          <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
            Mapa interactivo de avistamientos
          </h2>
          <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
            Explora las coordenadas de Santander de Quilichao. Haz clic sobre los marcadores para abrir la ficha del avistamiento con detalles de hábitat y notas biológicas.
          </p>
        </div>

        <div class="flex items-center gap-2">
          <button id="map-reset-btn" type="button" class="btn-wireframe-secondary text-xs">
            Centrar Municipio
          </button>
        </div>
      </div>

      <!-- Contenedor del Mapa en dos columnas: Mapa y Panel de detalle -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Contenedor Leaflet (8 columnas) -->
        <div class="lg:col-span-8 bg-[#F2F2F2] border-2 border-[#B0B0B0] rounded-sm overflow-hidden shadow-sm relative">
          
          <div id="map-container" class="w-full h-[450px] sm:h-[520px] bg-[#E0E0E0]">
            <!-- Leaflet JS inyecta el mapa en este contenedor -->
          </div>

          <div class="p-3 bg-[#FFFFFF] border-t border-[#B0B0B0] flex flex-wrap items-center justify-between gap-2 text-[11px] font-mono text-[#777777]">
            <span>Centro: Santander de Quilichao (3.0094° N, 76.4847° W)</span>
            <span>Marcadores interactivos activos: 8 puntos</span>
          </div>

        </div>

        <!-- Panel lateral del marcador seleccionado (4 columnas) -->
        <div class="lg:col-span-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm p-6 space-y-5">
          
          <div class="flex items-center justify-between pb-3 border-b border-[#B0B0B0]">
            <span class="text-[11px] font-mono font-bold uppercase text-[#777777]">
              Ficha del Avistamiento Seleccionado
            </span>
            <span id="map-point-counter" class="text-[10px] font-mono bg-[#D0D0D0] px-2 py-0.5 rounded-sm text-[#333333]">
              1 / 8
            </span>
          </div>

          <!-- Información dinámica del ave del marcador -->
          <div id="map-point-details" class="space-y-4">
            
            <div class="wireframe-placeholder-dark h-36 flex flex-col items-center justify-center p-3 text-center rounded-sm">
              <span id="map-point-img-label" class="text-xs font-bold font-mono text-[#FFFFFF] text-center">
                [PLACEHOLDER DE FOTOGRAFÍA: MOMOTO EN SENDERO FLUVIAL]
              </span>
              <span class="text-[10px] text-[#D0D0D0] mt-1 font-mono">Registro fotográfico del punto</span>
            </div>

            <div class="space-y-1">
              <span id="map-point-zone" class="text-[10px] font-mono text-[#777777] uppercase block">
                Zona Urbana y Ribereña
              </span>
              <h3 id="map-point-bird-name" class="text-lg font-bold text-[#333333]">
                Momoto Andino (Barranquero)
              </h3>
              <p id="map-point-scientific" class="text-xs italic font-serif text-[#777777]">
                Momotus aequatorialis
              </p>
            </div>

            <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2 text-xs">
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Lugar:</span>
                <span id="map-point-location" class="text-[#333333] font-medium text-right">Cuenca Río Quilichao</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Coordenadas:</span>
                <span id="map-point-coords" class="text-[#333333] font-mono text-right">3.0145, -76.4880</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Elevación:</span>
                <span id="map-point-elevation" class="text-[#333333] font-mono text-right">1.060 msnm</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Fecha del registro:</span>
                <span id="map-point-date" class="text-[#333333] text-right">14 Ene 2026</span>
              </div>
            </div>

            <div class="space-y-1">
              <span class="text-[11px] font-bold text-[#333333]">Notas de observación:</span>
              <p id="map-point-notes" class="text-xs text-[#777777] leading-relaxed bg-[#FFFFFF] p-2.5 border border-[#B0B0B0] rounded-sm">
                Ejemplar adulto observado posado sobre rama de sauce a 3 metros sobre el cauce del río.
              </p>
            </div>

            <div class="pt-2">
              <a href="{{ route('catalog.index') }}" class="w-full btn-wireframe-primary text-center block text-xs">
                Ver ficha completa en el catálogo ↗
              </a>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       8B. SECCIÓN — REPORTE DE AVISTAMIENTOS CIUDADANOS (FORMULARIO REGULADO)
       ====================================================================== -->
  <section id="reportar-avistamiento" class="py-20 bg-[#F2F2F2] border-b border-[#B0B0B0]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      
      <div class="space-y-2 text-center max-w-2xl mx-auto">
        <div class="inline-block px-3 py-1 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
          Formulario Regulado • Ciencia Ciudadana
        </div>
        <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
          Reportar Avistamiento de Ave en Quilichao
        </h2>
        <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
          Registra una observación en territorio quilichagüeño. <strong>El sistema regula un máximo de 3 envíos por correo electrónico</strong> para asegurar la moderación administrativa y evitar saturación.
        </p>
      </div>

      <!-- Alertas de estado -->
      @if(session('sighting_success'))
        <div class="p-4 bg-[#FFFFFF] border-2 border-[#333333] rounded-sm text-xs text-[#333333] space-y-1">
          <div class="flex items-center gap-2">
            <span class="font-mono font-bold text-sm">[REGISTRO EXITOSO]:</span>
            <span class="font-semibold">{{ session('sighting_success') }}</span>
          </div>
          <span class="text-[10px] font-mono text-[#777777] block">Tu reporte será revisado por el administrador antes de publicarse en el mapa territorial.</span>
        </div>
      @endif

      @if(session('sighting_error'))
        <div class="p-4 bg-[#FFFFFF] border-2 border-[#777777] rounded-sm text-xs text-[#333333] space-y-1">
          <div class="flex items-center gap-2">
            <span class="font-mono font-bold text-sm">[LÍMITE REGULADO]:</span>
            <span class="font-semibold">{{ session('sighting_error') }}</span>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="p-4 bg-[#FFFFFF] border-2 border-[#333333] rounded-sm text-xs text-[#333333] space-y-1">
          <span class="font-bold block">[ERRORES EN EL FORMULARIO]:</span>
          <ul class="list-disc list-inside text-[11px] text-[#777777]">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Formulario Wireframe -->
      <form method="POST" action="{{ route('sightings.public.store') }}" class="bg-[#FFFFFF] border-2 border-[#333333] p-6 sm:p-8 rounded-sm space-y-6 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label for="observer_name" class="block text-xs font-mono font-bold text-[#333333]">
              Nombre Completo del Observador (*):
            </label>
            <input
              id="observer_name"
              name="observer_name"
              type="text"
              required
              value="{{ old('observer_name') }}"
              placeholder="Ej: Laura Gómez"
              class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
            >
          </div>

          <div class="space-y-1">
            <label for="observer_email" class="block text-xs font-mono font-bold text-[#333333]">
              Correo Electrónico (*):
            </label>
            <input
              id="observer_email"
              name="observer_email"
              type="email"
              required
              value="{{ old('observer_email') }}"
              placeholder="tu-correo@ejemplo.com"
              class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
            >
            <span class="text-[10px] text-[#777777] font-mono block">Regulación activa: Máximo 3 envíos por correo</span>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label for="species_id" class="block text-xs font-mono font-bold text-[#333333]">
              Especie Observada (*):
            </label>
            <select
              id="species_id"
              name="species_id"
              required
              class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
            >
              <option value="">Selecciona la especie observada...</option>
              @foreach($species as $sp)
                <option value="{{ $sp->id }}" {{ old('species_id') == $sp->id ? 'selected' : '' }}>
                  {{ $sp->common_name }} ({{ $sp->scientific_name }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="space-y-1">
            <label for="location_id" class="block text-xs font-mono font-bold text-[#333333]">
              Sector / Zona de Quilichao (*):
            </label>
            <select
              id="location_id"
              name="location_id"
              class="w-full bg-[#F2F2F2] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:outline-none"
            >
              <option value="">Selecciona la zona...</option>
              @foreach($locations as $loc)
                <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                  {{ $loc->name }} ({{ $loc->zone }})
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label for="sighting_date" class="block text-xs font-mono font-bold text-[#333333]">
              Fecha de la Observación (*):
            </label>
            <input
              id="sighting_date"
              name="sighting_date"
              type="date"
              required
              max="{{ date('Y-m-d') }}"
              value="{{ old('sighting_date', date('Y-m-d')) }}"
              class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
            >
          </div>

          <div class="space-y-1">
            <label for="individuals_count" class="block text-xs font-mono font-bold text-[#333333]">
              Cantidad de Ejemplares (*):
            </label>
            <input
              id="individuals_count"
              name="individuals_count"
              type="number"
              min="1"
              max="500"
              required
              value="{{ old('individuals_count', 1) }}"
              class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
            >
          </div>
        </div>

        <div class="space-y-1">
          <label for="description" class="block text-xs font-mono font-bold text-[#333333]">
            Notas de Observación y Hábitat (*):
          </label>
          <textarea
            id="description"
            name="description"
            rows="3"
            required
            placeholder="Describe qué estaba haciendo el ave (perchada, forrajeando, cantando), el estrato del árbol y la hora aproximada..."
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-3 text-xs rounded-sm focus:border-[#333333] focus:outline-none"
          >{{ old('description') }}</textarea>
        </div>

        <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-[11px] font-mono text-[#777777] flex items-center justify-between">
          <span>• Regulación: Máximo 3 envíos por sesión</span>
          <span>• Moderado por el Administrador</span>
        </div>

        <button type="submit" class="w-full btn-wireframe-primary py-3 text-xs font-bold text-center block">
          Enviar Observación para Revisión Administrativa ↗
        </button>
      </form>

    </div>
  </section>

  <!-- ======================================================================
       9. SECCIÓN — CONSERVACIÓN Y EDUCACIÓN AMBIENTAL
       ====================================================================== -->
  <section id="conservacion" class="py-20 bg-[#F2F2F2] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
      
      <div class="max-w-3xl space-y-2">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
          Acción y Preservación
        </span>
        <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
          Conservar la avifauna de Santander de Quilichao
        </h2>
        <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
          La observación de aves adquiere verdadero valor cuando se vincula con la protección de los ecosistemas locales, la educación comunitaria y el monitoreo científico.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($conservation as $item)
          <div class="bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm p-6 space-y-3 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-8 h-8 bg-[#F2F2F2] border border-[#B0B0B0] flex items-center justify-center font-mono font-black text-xs text-[#333333]">
                0{{ $loop->iteration }}
              </div>
              <h3 class="text-base font-bold text-[#333333]">{{ $item->title }}</h3>
              <p class="text-xs text-[#777777] leading-relaxed">
                {{ $item->summary }}
              </p>
            </div>
            <div class="pt-3 border-t border-[#B0B0B0] text-[10px] font-mono text-[#777777]">
              Categoría: {{ strtoupper($item->category) }}
            </div>
          </div>
        @empty
          <div class="col-span-4 p-8 text-center text-xs font-mono text-[#777777] bg-[#FFFFFF] border border-[#B0B0B0]">
            Contenidos de conservación cargados dinámicamente desde el sistema.
          </div>
        @endforelse
      </div>

      <!-- Módulo de Código Ético -->
      <div class="p-8 bg-[#FFFFFF] border-2 border-[#333333] rounded-sm space-y-4">
        <div class="flex items-center gap-2">
          <span class="px-2.5 py-0.5 bg-[#333333] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase">
            Protocolo de Campo
          </span>
          <span class="text-xs font-mono text-[#777777]">Decálogo del Pajarero Responsable</span>
        </div>
        <h3 class="text-xl font-bold text-[#333333]">
          Código ético del observador de aves en Santander de Quilichao
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs text-[#777777] pt-2">
          <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1">
            <strong class="text-[#333333] block">1. Prioridad al bienestar del ave:</strong>
            <span>Evita reproducir cantos (playback) reiteradamente para no provocar estrés en periodos de anidación.</span>
          </div>
          <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1">
            <strong class="text-[#333333] block">2. Mantén senderos trazados:</strong>
            <span>No abras trochas ni pisotees la vegetación frágil en cañadas, nacimientos de agua y reservas.</span>
          </div>
          <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1">
            <strong class="text-[#333333] block">3. Respeto comunitario:</strong>
            <span>Solicita permiso al transitar predios rurales y apoya a los guías comunitarios locales.</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ======================================================================
       10. SECCIÓN — SOBRE NOSOTROS
       ====================================================================== -->
  <section id="sobre-nosotros" class="py-20 bg-[#FFFFFF] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        
        <div class="lg:col-span-7 space-y-5">
          <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
            Identidad del Proyecto
          </span>
          <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
            Acerca de BioAves Quilichao
          </h2>
          <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
            BioAves Quilichao es una iniciativa ornitológica comunitaria orientada a mapear, registrar y difundir el patrimonio ornitológico de Santander de Quilichao, Cauca.
          </p>
          <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
            A través de metodologías de ciencia ciudadana, combinamos tecnología web accesible, cartografía abierta y rigurosidad taxonómica para fomentar el aviturismo responsable y la conservación de microcuencas y bosques andinos.
          </p>

          <div class="pt-2 flex flex-wrap gap-3">
            <a href="{{ route('catalog.index') }}" class="btn-wireframe-primary text-xs">
              Explorar Catálogo de Aves ↗
            </a>
            <a href="#mapa" class="btn-wireframe-secondary text-xs">
              Ver Mapa de Observaciones
            </a>
          </div>
        </div>

        <div class="lg:col-span-5 bg-[#F2F2F2] border border-[#B0B0B0] p-6 rounded-sm space-y-4">
          <h3 class="text-sm font-bold uppercase font-mono text-[#333333]">Ficha Técnica del Prototipo</h3>
          <div class="space-y-2 text-xs">
            <div class="flex justify-between py-1.5 border-b border-[#B0B0B0]">
              <span class="text-[#777777]">Plataforma:</span>
              <span class="font-bold text-[#333333]">BioAves Quilichao</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#B0B0B0]">
              <span class="text-[#777777]">Backend & Base de Datos:</span>
              <span class="font-bold text-[#333333]">Laravel 12 + PostgreSQL / SQLite</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#B0B0B0]">
              <span class="text-[#777777]">Diseño Estructural:</span>
              <span class="font-bold text-[#333333]">Escala de Grises Estricta</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#B0B0B0]">
              <span class="text-[#777777]">Municipio:</span>
              <span class="font-bold text-[#333333]">Santander de Quilichao, Cauca</span>
            </div>
            <div class="flex justify-between py-1.5">
              <span class="text-[#777777]">Objetivo:</span>
              <span class="font-bold text-[#333333]">Conservación y Aviturismo</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       11. FOOTER — PIE DE PÁGINA
       ====================================================================== -->
  <footer class="bg-[#111111] text-[#FFFFFF] py-12 border-t border-[#777777]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <div class="space-y-3 md:col-span-2">
          <span class="text-lg font-black tracking-widest uppercase block">
            BIOAVES QUILICHAO
          </span>
          <p class="text-xs text-[#D0D0D0] max-w-md leading-relaxed">
            Plataforma digital para la observación, monitoreo participativo y conservación de las aves de Santander de Quilichao, Cauca, Colombia.
          </p>
          <span class="text-[11px] font-mono text-[#777777] block">
            Descubre. Escucha. Explora. Conserva.
          </span>
        </div>

        <div class="space-y-2">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-[#FFFFFF]">Enlaces Rápidos</h4>
          <ul class="space-y-1.5 text-xs text-[#D0D0D0]">
            <li><a href="#inicio" class="hover:underline">Inicio</a></li>
            <li><a href="#carrusel" class="hover:underline">Aves Destacadas</a></li>
            <li><a href="{{ route('catalog.index') }}" class="hover:underline">Catálogo General</a></li>
            <li><a href="#mapa" class="hover:underline">Mapa de Avistamientos</a></li>
            <li><a href="#conservacion" class="hover:underline">Conservación</a></li>
          </ul>
        </div>

        <div class="space-y-2">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-[#FFFFFF]">Acceso Privado</h4>
          <ul class="space-y-1.5 text-xs text-[#D0D0D0]">
            @auth
              <li><a href="{{ route('admin.dashboard') }}" class="hover:underline font-bold text-[#FFFFFF]">[Panel de Administración]</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="hover:underline text-[#D0D0D0] text-xs">Cerrar Sesión</button>
                </form>
              </li>
            @else
              <li><a href="{{ route('login') }}" class="hover:underline">Inicio de Sesión Administrativo</a></li>
            @endauth
            <li><span class="text-[11px] text-[#777777]">Santander de Quilichao, Cauca</span></li>
          </ul>
        </div>

      </div>

      <div class="pt-6 border-t border-[#333333] flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] font-mono text-[#777777]">
        <span>© 2026 BioAves Quilichao • Prototipo de Baja Fidelidad</span>
        <span>Escala de Grises Monocromática Estricta</span>
      </div>

    </div>
  </footer>

  <!-- ======================================================================
       FICHA DETALLADA MODAL EN INDEX (Para abrir especies desde el carrusel y mapa)
       ====================================================================== -->
  <div id="modal-detalle-ave" class="fixed inset-0 z-50 hidden bg-[#333333]/70 backdrop-blur-xs flex items-center justify-center p-3 sm:p-5 overflow-y-auto">
    <div class="relative w-full max-w-4xl bg-[#FFFFFF] border-2 border-[#333333] rounded-sm overflow-hidden my-auto shadow-2xl">
      
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

      <div class="p-6 space-y-8 max-h-[78vh] overflow-y-auto">
        
        <!-- B. Galería Multimedia (3 Fotos pasables con botones) -->
        <div class="space-y-3">
          <div class="flex items-center justify-between text-xs font-mono border-b border-[#B0B0B0] pb-1">
            <span class="font-bold uppercase text-[#333333]">B. Galería Multimedia (3 Fotografías Pasables con Botones)</span>
            <span id="modal-photo-indicator" class="text-[#777777]">Foto 1 de 3</span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 relative h-64 sm:h-72 wireframe-placeholder rounded-sm flex flex-col items-center justify-center p-4">
              <span id="modal-photo-label" class="text-sm font-bold text-[#333333] text-center max-w-sm">
                [PLACEHOLDER DE FOTOGRAFÍA 1 DE 3]
              </span>
              <span class="text-[11px] text-[#777777] font-mono mt-1">
                Representación wireframe sin imágenes reales
              </span>

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

        <!-- C. Sonidos y Cantos -->
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

        <!-- A. Información General -->
        <div class="space-y-3">
          <h3 class="text-xs font-mono font-bold uppercase text-[#333333] border-b border-[#B0B0B0] pb-1">
            A. Información General y Morfología
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-8 space-y-2">
              <h4 class="text-xs font-mono font-bold text-[#333333]">Descripción de la especie:</h4>
              <p id="modal-description" class="text-xs sm:text-sm text-[#777777] leading-relaxed">
                Descripción...
              </p>
            </div>
            <div class="md:col-span-4 p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1 text-xs">
              <span class="font-bold text-[#333333] font-mono block">Características Físicas:</span>
              <p id="modal-physical" class="text-[#777777]">Características...</p>
            </div>
          </div>
        </div>

        <!-- D. Información Biológica -->
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

        <!-- E. Ubicación -->
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
              <button id="modal-go-to-map-btn" type="button" class="btn-wireframe-primary text-xs py-2 w-full text-center">
                Ver en el mapa →
              </button>
            </div>
          </div>
        </div>

      </div>

      <div class="p-4 bg-[#F2F2F2] border-t border-[#B0B0B0] flex items-center justify-between text-xs font-mono text-[#777777]">
        <span>BioAves Quilichao • Prototipo de Baja Fidelidad</span>
        <button onclick="document.getElementById('modal-detalle-ave').classList.add('hidden'); document.body.classList.remove('overflow-hidden');" class="btn-wireframe-secondary text-xs py-1 px-4">
          Cerrar Ficha
        </button>
      </div>

    </div>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="{{ asset('js/birds-data.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
