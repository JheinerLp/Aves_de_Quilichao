<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com; img-src 'self' data: blob: https: http:; media-src 'self' data: blob: http: https:; connect-src 'self' https: http:; font-src 'self' data: https:;">
  <meta name="description" content="BioAves Quilichao: observación, identificación y conservación de las aves de Santander de Quilichao, Cauca.">
  <title>BioAves Quilichao | Descubre las aves de nuestro territorio</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="text-[#333333] antialiased">

  @include('partials.header')

  <!-- HERO: video en video/hero.mp4 -->
  <section id="inicio" class="bv-hero">
    <video class="bv-video" autoplay muted loop playsinline preload="auto">
      <source src="{{ asset('video/hero.mp4') }}" type="video/mp4">
    </video>
    <div class="bv-hero-in">
      <h1>Descubre las aves de nuestro <span class="bv-script">territorio</span></h1>
      <p>Plataforma dedicada a la observación, identificación, registro cartográfico y conservación de la avifauna en el municipio de Santander de Quilichao, Cauca.</p>
      <div class="bv-btns">
        <a href="{{ route('catalog.index') }}" class="bv-btn bv-btn-fill"> Explorar catálogo de aves</a>
        <a href="{{ route('home') }}#sobre-nosotros" class="bv-btn bv-btn-line"> Conoce nuestra misión</a>
      </div>
    </div>
    <svg class="bv-wave" viewBox="0 0 1440 140" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40C300 120 600 110 900 70s400-40 540 10v60H0z" fill="#f4f9e6"/><path d="M0 70C300 150 620 140 920 100s400-40 520 0" fill="none" stroke="#ffd21f" stroke-width="7"/><path d="M0 100C280 160 600 150 900 120s400-30 540-10" fill="none" stroke="#2e9b3a" stroke-width="12"/></svg>
  </section>

  <!-- CONTEXTO + INDICADORES -->
  <section id="introduccion" class="bv-wrap bv-contexto">
    <div class="bv-context-text">
      <span class="bv-tag">Contexto biogeográfico</span>
      <h2>Un territorio lleno de vida</h2>
      <p>Santander de Quilichao confluye entre los pisos térmicos cálidos del valle geográfico del Río Cauca y las estribaciones de la Cordillera Central. Esta gradiente altitudinal origina diversos ecosistemas que albergan aves endémicas, residentes y migratorias de gran valor ecológico.</p>
    </div>
    <div class="bv-stat"><span class="bv-ico c1">🐦</span><b>{{ $species->count() }}</b><h3>Especies registradas</h3><p>Diversidad acumulada de aves reportadas entre áreas urbanas, cuencas y reservas.</p></div>
    <div class="bv-stat"><span class="bv-ico c2">📍</span><b>{{ $locations->count() }}</b><h3>Lugares de avistamiento</h3><p>Rutas y puntos geográficos en el municipio.</p></div>
    <div class="bv-stat"><span class="bv-ico c3">📊</span><b>{{ $sightings->count() }}</b><h3>Registros de observación</h3><p>Fichas documentadas por expertos y comunidad.</p></div>
  </section>

  <!-- CARRUSEL -->
  <section id="carrusel" class="bv-carousel-sec">
    <div class="bv-wrap">
      <div class="bv-head">
        <div><span class="bv-tag bv-tag-sun">Muestreo representativo</span><h2><i>🌿</i> Descubre nuestras aves <i>🌿</i></h2></div>
        <a href="{{ route('catalog.index') }}" class="bv-btn bv-btn-fill bv-small">Ver Catálogo Completo →</a>
      </div>
      <div class="bv-controls">
        <span id="carousel-status-indicator">Auto-desplazamiento activo</span>
        <button id="carousel-prev-btn" type="button" aria-label="Anterior ave">‹</button>
        <button id="carousel-next-btn" type="button" aria-label="Siguiente ave">›</button>
      </div>
      <div id="carousel-container" class="w-full overflow-x-auto no-scrollbar py-8 px-2 cursor-grab active:cursor-grabbing">
        <div id="carousel-track" class="flex gap-6 items-center w-max"></div>
      </div>
    </div>
  </section>

  <!-- MISIÓN (foto: Chicao) -->
  <section class="bv-mision bv-wrap">
    <div class="bv-mision-img"></div>
    <div class="bv-mision-text">
      <span class="bv-tag bv-tag-sun">Nuestra misión</span>
      <h2>Conservar para el futuro</h2>
      <p>Trabajamos por la protección de las aves y sus hábitats en Santander de Quilichao, promoviendo el conocimiento, la educación ambiental y la participación ciudadana.</p>
      <a href="{{ route('home') }}#sobre-nosotros" class="bv-btn bv-btn-fill">Conoce más →</a>
    </div>
    <div class="bv-lema">Descubre.<br>Escucha.<br>Explora.<br>Conserva.</div>
  </section>

  <!-- ======================================================================
       7. SECCIÓN — PRIMERA CIUDAD DE LAS AVES DE SURAMÉRICA
       ====================================================================== -->
  <section id="rutas" class="py-20 bg-[#F2F2F2] border-b border-[#B0B0B0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- Texto -->
        <div class="space-y-5">
          <span class="inline-block px-3 py-1 bg-[#D0D0D0] border border-[#B0B0B0] text-[11px] font-mono font-bold uppercase tracking-wider text-[#333333] rounded-full">
            Nuestro orgullo
          </span>
          <h2 class="text-3xl sm:text-4xl font-black text-[#333333] leading-tight">
            Primera Ciudad de las Aves de Suramérica
          </h2>
          <p class="text-sm sm:text-base text-[#777777] leading-relaxed">
            Santander de Quilichao recibió el reconocimiento internacional de <strong>Ciudad de las Aves</strong>, otorgado por Environment for the Americas y American Bird Conservancy. Es la primera de Suramérica, y eso nos llena de orgullo.
          </p>
          <p class="text-sm sm:text-base text-[#777777] leading-relaxed">
            Este título honra a la comunidad que cuida sus aves y su entorno, y nos recuerda que conocerlas y protegerlas es tarea de todos: niños, jóvenes y adultos.
          </p>

          <div class="grid grid-cols-2 gap-3 pt-2">
            <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-2xl text-center">
              <span class="block text-xl font-black text-[#333333]">1.ª</span>
              <span class="text-[11px] font-mono text-[#777777]">de Suramérica</span>
            </div>
            <div class="p-4 bg-[#FFFFFF] border border-[#B0B0B0] rounded-2xl text-center">
              <span class="block text-xl font-black text-[#333333]">2023</span>
              <span class="text-[11px] font-mono text-[#777777]">año del reconocimiento</span>
            </div>
          </div>

          <a href="{{ route('catalog.index') }}" class="btn-wireframe-primary text-xs py-2 px-6 inline-block">
            Conocer nuestras aves ↗
          </a>
        </div>

        <!-- Espacio para tu imagen con bordes redondeados -->
        <figure class="relative">
          <div class="relative h-72 sm:h-96 rounded-[2rem] overflow-hidden border-4 border-[#FFFFFF] shadow-xl bg-[#D0D0D0] flex items-center justify-center">

      <img src="{{ asset('img/ciudad-de-las-aves.png') }}"
          alt="Santander de Quilichao, primera Ciudad de las Aves de Suramérica"
          class="absolute inset-0 w-full h-full object-cover"
          onerror="this.style.display='none'">
    </div>
          <figcaption class="mt-3 text-center text-[11px] font-mono text-[#777777]">
            
          </figcaption>
        </figure>

      </div>

      <!-- ======================================================================
           MÓDULO: SENDEROS Y RUTAS INTERACTIVAS
           ====================================================================== -->
      <div class="mt-16 pt-16 border-t border-[#B0B0B0] space-y-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div class="max-w-3xl space-y-2">
            <span class="text-xs font-mono font-bold uppercase tracking-wider text-[#777777]">
              Turismo de Naturaleza y Ecoturismo Comunitario
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-[#333333]">
              Senderos Ecológicos y Rutas de Naturaleza
            </h2>
            <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
              Descubre lugares naturales y reservas cercanas en Santander de Quilichao. Selecciona un sendero para consultar su ficha técnica, aves observables y visualizar el trazado interactivo del recorrido desde el centro histórico.
            </p>
          </div>

          <!-- Filtros de Categoría -->
          <div class="flex flex-wrap items-center gap-2">
            <button type="button" data-filter="all" class="route-filter-btn px-3 py-1.5 text-xs font-mono font-bold rounded-sm border bg-[#333333] text-[#FFFFFF] border-[#333333] transition-colors cursor-pointer">
              Todos los destinos
            </button>
            <button type="button" data-filter="Fluvial" class="route-filter-btn px-3 py-1.5 text-xs font-mono font-bold rounded-sm border bg-[#FFFFFF] text-[#777777] border-[#B0B0B0] hover:border-[#333333] transition-colors cursor-pointer">
              Ríos y Cuencas
            </button>
            <button type="button" data-filter="Bosque" class="route-filter-btn px-3 py-1.5 text-xs font-mono font-bold rounded-sm border bg-[#FFFFFF] text-[#777777] border-[#B0B0B0] hover:border-[#333333] transition-colors cursor-pointer">
              Bosques y Reservas
            </button>
            <button type="button" data-filter="Humedal" class="route-filter-btn px-3 py-1.5 text-xs font-mono font-bold rounded-sm border bg-[#FFFFFF] text-[#777777] border-[#B0B0B0] hover:border-[#333333] transition-colors cursor-pointer">
              Humedales
            </button>
            <button type="button" data-filter="Mirador" class="route-filter-btn px-3 py-1.5 text-xs font-mono font-bold rounded-sm border bg-[#FFFFFF] text-[#777777] border-[#B0B0B0] hover:border-[#333333] transition-colors cursor-pointer">
              Miradores
            </button>
          </div>
        </div>

        <!-- Colección de Tarjetas Visuales de Destinos (6 Rutas) -->
        <div id="routes-cards-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
          
          <!-- Tarjeta 1: Sendero Río Quilichao -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="sendero-rio-quilichao" data-route-type="Sendero Fluvial y Parque Lineal">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/sendero-rio-quilichao.jpg') }}" alt="Sendero Ecológico Río Quilichao" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Sendero Fluvial
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#2e9b3a] border border-[#2e9b3a] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Fácil
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Santander de Quilichao, Cauca
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Sendero Ecológico Río Quilichao
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Paseo ribereño sombreado por sauces, yarumos y vegetación de galería a lo largo del Río Quilichao. Excelente para observación matutina de aves acuáticas y paseriformes.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">2.4 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">1 h 15 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+15 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

          <!-- Tarjeta 2: Reserva San Antonio -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="reserva-san-antonio" data-route-type="Reserva Natural y Bosque de Niebla">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/reserva-san-antonio.jpg') }}" alt="Reserva Forestal Vereda San Antonio" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Reserva Natural
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#d97706] border border-[#d97706] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Moderado
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Vereda San Antonio, Cauca
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Reserva Forestal Vereda San Antonio
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Fragmento de bosque andino y de niebla en las estribaciones de la Cordillera Central. Refugio vital de especies amenazadas como la Pava Caucana y orquídeas nativas.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">6.8 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">2 h 45 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+690 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

          <!-- Tarjeta 3: Humedal El Samán -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="humedal-el-saman" data-route-type="Humedal y Ecosistema Acuático">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/humedal-el-saman.jpg') }}" alt="Humedal El Samán y Microcuenca Sur" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Humedal
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#2e9b3a] border border-[#2e9b3a] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Fácil
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Santander de Quilichao, Cauca
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Humedal El Samán y Microcuenca Sur
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Ecosistema léntico con lagunas someras, juncales y franjas de samanes centenarios. Punto estratégico de descanso para aves migratorias boreales y zancudas.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">3.1 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">1 h 30 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+11 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

          <!-- Tarjeta 4: Cerro y Mirador de Belén -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="cerro-belen" data-route-type="Mirador Panorámico y Cerro Tutelar">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/cerro-belen.jpg') }}" alt="Sendero Cerro y Mirador de Belén" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Mirador
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#d97706] border border-[#d97706] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Moderado
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Santander de Quilichao, Cauca
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Sendero Cerro y Mirador de Belén
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Ascenso hacia el cerro tutelar coronado por la Capilla de Belén. Ofrece una vista panorámica de 360 grados sobre el valle geográfico y avistamiento de rapaces nocturnas.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">1.8 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">50 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+74 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

          <!-- Tarjeta 5: Faldas de Mondomo -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="faldas-mondomo" data-route-type="Zona Cafetera y Piedemonte Andino">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/faldas-mondomo.jpg') }}" alt="Ruta Agroecológica Faldas de Mondomo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Zona Cafetera
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#d97706] border border-[#d97706] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Moderado
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Mondomo, Santander de Quilichao
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Ruta Agroecológica Faldas de Mondomo
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Circuito entre fincas agroecológicas, cafetales bajo sombra y cañadas naturales en el corregimiento de Mondomo. Gran densidad de tráupidos y carpinteros.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">8.5 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">3 h 15 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+224 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

          <!-- Tarjeta 6: Guaduales Santa Inés -->
          <article class="route-card bg-[#FFFFFF] border-2 border-[#B0B0B0] hover:border-[#333333] rounded-sm overflow-hidden transition-all duration-200 cursor-pointer flex flex-col justify-between group shadow-xs" data-route-id="guaduales-santa-ines" data-route-type="Bosque de Guadua y Vía Rural">
            <div>
              <div class="h-48 relative overflow-hidden bg-[#333333]">
                <img src="{{ asset('img/rutas/guaduales-santa-ines.jpg') }}" alt="Ruta de los Guaduales Vereda Santa Inés" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm border border-[#B0B0B0]">
                  Bosque de Guadua
                </span>
                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 bg-[#FFFFFF] text-[#2e9b3a] border border-[#2e9b3a] text-[10px] font-mono font-bold uppercase rounded-sm">
                  Fácil
                </span>
                <span class="active-route-indicator hidden absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-[#2e9b3a] text-[#FFFFFF] text-[10px] font-mono font-bold uppercase rounded-sm shadow-sm">
                  ✓ Ruta Activa
                </span>
              </div>

              <div class="p-5 space-y-3">
                <div class="space-y-1">
                  <span class="text-[10px] font-mono text-[#777777] uppercase block">
                    📍 Vereda Santa Inés, Cauca
                  </span>
                  <h3 class="text-base font-black text-[#333333] group-hover:underline">
                    Ruta de los Guaduales Vereda Santa Inés
                  </h3>
                </div>
                <p class="text-xs text-[#777777] leading-relaxed line-clamp-3">
                  Camino rural rodeado de imponentes guaduales ribereños y setos vivos tradicionales. Microhábitat propicio para colibríes, carpinteros y tiranos cazadores de insectos.
                </p>
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#B0B0B0] text-center font-mono text-[11px]">
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Distancia</span>
                    <strong class="text-[#333333]">4.2 km</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Tiempo</span>
                    <strong class="text-[#333333]">2 h 00 min</strong>
                  </div>
                  <div class="p-1.5 bg-[#F2F2F2] rounded-sm">
                    <span class="text-[#777777] text-[9px] block">Desnivel</span>
                    <strong class="text-[#333333]">+19 m</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-5 pt-0">
              <button type="button" class="w-full btn-wireframe-primary text-xs py-2 text-center group-hover:bg-[#222222] transition-colors">
                🗺️ Ver ruta en el mapa →
              </button>
            </div>
          </article>

        </div>

        <!-- MAPA INTERACTIVO Y DETALLE DEL RECORRIDO (DEBAJO DE LAS TARJETAS) -->
        <div id="routes-map-container" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start pt-6">
          
          <!-- Mapa Leaflet de Rutas (8 cols) -->
          <div class="lg:col-span-8 bg-[#FFFFFF] border-2 border-[#B0B0B0] rounded-sm overflow-hidden shadow-sm relative">
            
            <!-- Encabezado / Banner flotante de ruta activa -->
            <div class="p-3 bg-[#F2F2F2] border-b border-[#B0B0B0] flex flex-wrap items-center justify-between gap-3 text-xs font-mono">
              <div class="flex items-center gap-2">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-[#2e9b3a] animate-pulse"></span>
                <strong class="text-[#333333]">Trazado de Ruta:</strong>
                <span id="route-active-pill-name" class="font-bold text-[#2e9b3a] truncate max-w-xs sm:max-w-md">Sendero Ecológico Río Quilichao</span>
              </div>
              <button id="btn-fit-route" type="button" class="btn-wireframe-secondary text-[11px] py-1 px-3">
                🎯 Centrar Ruta
              </button>
            </div>

            <div id="routes-map-element" class="w-full h-[450px] sm:h-[540px] bg-[#E0E0E0] relative z-0">
              <!-- Leaflet inyecta el mapa de rutas aquí -->
            </div>

            <!-- Barra de navegación / Info pie del mapa -->
            <div class="p-3 bg-[#FFFFFF] border-t border-[#B0B0B0] flex flex-wrap items-center justify-between gap-2 text-[11px] font-mono text-[#777777]">
              <div class="flex items-center gap-3">
                <span><span class="font-bold text-[#2e9b3a]">A:</span> Parque Principal Santander</span>
                <span>→</span>
                <span><span class="font-bold text-[#d97706]">B:</span> Destino Natural</span>
              </div>
              <span class="text-[#333333] font-bold">Línea verde: Trazado real de caminos y carreteras</span>
            </div>

          </div>

          <!-- Panel Lateral de Detalles del Recorrido Seleccionado (4 cols) -->
          <div class="lg:col-span-4 bg-[#FFFFFF] border-2 border-[#333333] rounded-sm p-6 space-y-5 shadow-sm">
            
            <div class="flex items-center justify-between pb-3 border-b border-[#B0B0B0]">
              <div>
                <span class="text-[10px] font-mono uppercase tracking-wider text-[#777777] block">
                  Itinerario de Campo
                </span>
                <h3 id="route-panel-title" class="text-base font-black text-[#333333]">
                  Sendero Ecológico Río Quilichao
                </h3>
              </div>
              <span id="route-panel-difficulty" class="px-2 py-0.5 rounded-sm font-mono text-[10px] font-bold uppercase border bg-[#FFFFFF] text-[#2e9b3a] border-[#2e9b3a]">
                Fácil
              </span>
            </div>

            <!-- Imagen del destino en panel -->
            <div class="h-36 overflow-hidden rounded-sm border border-[#B0B0B0] bg-[#333333] relative">
              <img id="route-panel-img" src="{{ asset('img/rutas/sendero-rio-quilichao.jpg') }}" alt="Ruta seleccionada" class="w-full h-full object-cover">
              <span id="route-panel-type" class="absolute bottom-2 left-2 bg-[#333333]/90 text-[#FFFFFF] text-[10px] font-mono px-2 py-0.5 rounded border border-[#B0B0B0]">
                Sendero Fluvial y Parque Lineal
              </span>
            </div>

            <!-- Descripción -->
            <p id="route-panel-desc" class="text-xs text-[#777777] leading-relaxed">
              Paseo ribereño sombreado por sauces, yarumos y vegetación de galería a lo largo del Río Quilichao. Excelente para observación matutina de aves acuáticas y paseriformes.
            </p>

            <!-- Tabla técnica del recorrido -->
            <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-2 text-xs font-mono">
              <div class="flex justify-between items-start gap-2">
                <span class="text-[#777777] font-bold">Punto de inicio (A):</span>
                <span id="route-panel-start" class="text-[#333333] text-right">Parque Principal Santander</span>
              </div>
              <div class="flex justify-between items-start gap-2">
                <span class="text-[#777777] font-bold">Punto de llegada (B):</span>
                <span id="route-panel-end" class="text-[#333333] text-right">Río Quilichao (3.0145, -76.4880)</span>
              </div>
              <div class="flex justify-between items-center gap-2 border-t border-[#B0B0B0] pt-1.5">
                <span class="text-[#777777] font-bold">Distancia:</span>
                <span id="route-panel-distance" class="text-[#333333] font-bold">2.4 km</span>
              </div>
              <div class="flex justify-between items-center gap-2">
                <span class="text-[#777777] font-bold">Duración estimada:</span>
                <span id="route-panel-duration" class="text-[#333333] font-bold">1 h 15 min</span>
              </div>
              <div class="flex justify-between items-center gap-2">
                <span class="text-[#777777] font-bold">Desnivel / Altura:</span>
                <span id="route-panel-elevation" class="text-[#333333]">1.055 - 1.070 msnm (+15 m)</span>
              </div>
            </div>

            <!-- Recomendaciones -->
            <div class="space-y-1">
              <span class="text-[11px] font-mono font-bold text-[#333333] uppercase">Recomendaciones:</span>
              <p id="route-panel-notes" class="text-xs text-[#777777] leading-relaxed bg-[#F2F2F2] p-2.5 border border-[#B0B0B0] rounded-sm">
                Ruta peatonal accesible para toda la familia. Se sugiere calzado cómodo, binoculares y realizar el recorrido entre las 06:00 y las 09:00.
              </p>
            </div>

            <!-- Aves observables con enlace a ficha -->
            <div class="space-y-2">
              <span class="text-[11px] font-mono font-bold text-[#333333] uppercase block">Aves observables en esta ruta:</span>
              <div id="route-panel-birds" class="flex flex-wrap gap-1.5">
                <!-- Inyectado por JS -->
              </div>
            </div>

            <!-- Botón de navegación externa -->
            <div class="pt-2">
              <a id="route-gmaps-link" href="https://www.google.com/maps/dir/?api=1&origin=3.0094,-76.4847&destination=3.0145,-76.4880&travelmode=walking" target="_blank" rel="noopener noreferrer" class="w-full btn-wireframe-primary text-center block text-xs py-2.5">
                🧭 Cómo llegar (Abrir en Google Maps) ↗
              </a>
            </div>

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

      <!-- Filtros del mapa -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 p-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-xs">
        <div>
          <label for="map-filter-zone" class="block font-mono font-bold text-[#333333] mb-1">Zona:</label>
          <select id="map-filter-zone" class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-1.5 rounded-sm">
            <option value="all">Todas las zonas</option>
            <option value="Cuenca">Cuencas fluviales</option>
            <option value="Vereda">Veredas de montaña</option>
            <option value="Humedal">Humedales</option>
            <option value="Urbana">Área urbana y parques</option>
          </select>
        </div>

        <div>
          <label for="map-filter-species" class="block font-mono font-bold text-[#333333] mb-1">Especie:</label>
          <select id="map-filter-species" class="w-full bg-[#FFFFFF] border border-[#B0B0B0] p-1.5 rounded-sm">
            <option value="all">Todas las especies</option>
          </select>
        </div>

        <div>
          <span class="block font-mono font-bold text-[#333333] mb-1">Cobertura Territorial:</span>
          <div class="p-1.5 bg-[#FFFFFF] border border-[#B0B0B0] text-zinc-600 text-[11px] font-mono">
            Santander de Quilichao, Cauca
          </div>
        </div>

        <div>
          <span class="block font-mono font-bold text-[#333333] mb-1">Tipo de Registro:</span>
          <div class="p-1.5 bg-[#FFFFFF] border border-[#B0B0B0] text-zinc-600 text-[11px] font-mono">
            Avistamiento Visual y Sonoro
          </div>
        </div>
      </div>

      <!-- Contenedor del Mapa en dos columnas: Mapa y Panel de detalle -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Contenedor Leaflet (8 columnas) -->
        <div class="lg:col-span-8 bg-[#F2F2F2] border-2 border-[#B0B0B0] rounded-sm overflow-hidden shadow-sm relative">
          
          <div id="leaflet-map-element" class="w-full h-[450px] sm:h-[520px] bg-[#E0E0E0] relative z-0">
            <!-- Leaflet JS inyecta el mapa en este contenedor -->
          </div>

          <div class="p-3 bg-[#FFFFFF] border-t border-[#B0B0B0] flex flex-wrap items-center justify-between gap-2 text-[11px] font-mono text-[#777777]">
            <span>📍 Centro: Santander de Quilichao (3.0094° N, 76.4847° W)</span>
            <span id="records-counter" class="font-bold text-[#333333]">8 registros activos</span>
          </div>

        </div>

        <!-- Panel lateral del marcador seleccionado (4 columnas) -->
        <div class="lg:col-span-4 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm p-6 space-y-5">
          
          <div class="flex items-center justify-between pb-3 border-b border-[#B0B0B0]">
            <span class="text-[11px] font-mono font-bold uppercase text-[#777777]">
              Ficha del Avistamiento Seleccionado
            </span>
            <span id="map-point-counter" class="text-[10px] font-mono bg-[#D0D0D0] px-2 py-0.5 rounded-sm text-[#333333]">
              1 / 25
            </span>
          </div>

          <!-- Información dinámica del ave del marcador -->
          <div id="map-point-details" class="space-y-4">
            
            <div class="h-36 overflow-hidden rounded-sm border border-[#B0B0B0] bg-[#333333] relative">
              <img id="map-point-img" src="{{ asset('img/aves/chicao-panoramica.png') }}" alt="Chicao" class="w-full h-full object-cover" style="object-position: center 30%;">
              <span id="map-point-img-label" class="absolute bottom-2 left-2 bg-[#333333]/80 text-[#FFFFFF] text-[10px] font-mono px-2 py-0.5 rounded">
                Registro fotográfico del punto
              </span>
            </div>

            <div class="space-y-1">
              <span id="map-point-zone" class="text-[10px] font-mono text-[#777777] uppercase block">
                Zona Urbana y Agroecosistemas
              </span>
              <h3 id="map-point-bird-name" class="text-lg font-bold text-[#333333]">
                Chicao
              </h3>
              <p id="map-point-scientific" class="text-xs italic font-serif text-[#777777]">
                Icterus nigrogularis
              </p>
            </div>

            <div class="p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm space-y-2 text-xs">
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Lugar:</span>
                <span id="map-point-location" class="text-[#333333] font-medium text-right">Santander de Quilichao</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Coordenadas:</span>
                <span id="map-point-coords" class="text-[#333333] font-mono text-right">3.0094, -76.4847</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Elevación:</span>
                <span id="map-point-elevation" class="text-[#333333] font-mono text-right">1.056 msnm</span>
              </div>
              <div class="flex justify-between">
                <span class="font-bold text-[#777777]">Fecha del registro:</span>
                <span id="map-point-date" class="text-[#333333] text-right">Registro multimedia del equipo</span>
              </div>
            </div>

            <div class="space-y-1">
              <span class="text-[11px] font-bold text-[#333333]">Notas de observación:</span>
              <p id="map-point-notes" class="text-xs text-[#777777] leading-relaxed bg-[#FFFFFF] p-2.5 border border-[#B0B0B0] rounded-sm">
                Registro audiovisual aportado para la colección BioAves Quilichao.
              </p>
            </div>

            <div class="pt-2">
              <button id="map-point-view-btn" type="button" class="w-full btn-wireframe-primary text-center block text-xs py-2">
                Ver ficha completa en el catálogo ↗
              </button>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ======================================================================
       8B. SECCIÓN — REPORTE DE AVISTAMIENTOS CIUDADANOS (FORMULARIO REGULADO)
       ====================================================================== -->
    <section id="reportar-avistamiento" class="relative py-20 bg-gradient-to-b from-[#F4F8EC] via-[#FBF7E8] to-[#EAF3DF]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-stretch">

        <!-- ================= PANEL IZQUIERDO (verde) ================= -->
        <aside class="relative lg:col-span-2 overflow-hidden rounded-3xl bg-gradient-to-br from-[#1F4D33] via-[#2F6B3A] to-[#4F8A3A] text-white p-8 sm:p-10 shadow-xl">
          <!-- círculos suaves decorativos -->
          <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-[#F2C94C]/20 pointer-events-none"></div>
          <div class="absolute -bottom-20 -left-16 w-64 h-64 rounded-full bg-[#A8D08D]/20 pointer-events-none"></div>

          <div class="relative space-y-6">
            <span class="inline-block px-4 py-1.5 rounded-full bg-[#F2C94C] text-[#2B2A12] text-xs font-bold tracking-wide uppercase">
              Ciencia ciudadana
            </span>

            <h2 class="text-3xl sm:text-4xl font-black leading-tight !text-white" style="color:#FFFFFF;">
              Reporta un avistamiento de ave en Quilichao
            </h2>

            <p class="text-sm sm:text-base text-[#E4F1DA] leading-relaxed">
              ¿Viste un ave en tu barrio, tu vereda o tu finca? Cuéntanos. Cada observación nos ayuda a conocer y proteger nuestro territorio.
            </p>

            <ol class="space-y-4 pt-2">
              <li class="flex items-start gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#F2C94C] text-[#2B2A12] font-black flex items-center justify-center text-sm">1</span>
                <span class="text-sm text-[#F0F7E9]">Elige la especie y la zona donde la viste.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#F2C94C] text-[#2B2A12] font-black flex items-center justify-center text-sm">2</span>
                <span class="text-sm text-[#F0F7E9]">Cuéntanos qué hacía el ave y a qué hora.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#F2C94C] text-[#2B2A12] font-black flex items-center justify-center text-sm">3</span>
                <span class="text-sm text-[#F0F7E9]">Revisamos tu reporte antes de publicarlo.</span>
              </li>
            </ol>

            <div class="mt-4 p-4 rounded-2xl bg-white/10 border border-white/20 text-xs text-[#E4F1DA] leading-relaxed">
              El sistema permite un <strong class="text-white">máximo de 3 envíos por correo electrónico</strong> para facilitar la revisión y evitar saturación.
            </div>
          </div>
        </aside>

        <!-- ================= FORMULARIO (tarjeta blanca) ================= -->
        <div class="lg:col-span-3 space-y-5">

          <!-- Alertas de estado -->
          @if(session('sighting_success'))
            <div class="p-4 rounded-2xl bg-[#E8F5E0] border border-[#7DB46C] text-sm text-[#1F4D33] space-y-1">
              <span class="font-bold block">¡Registro exitoso!</span>
              <span class="block">{{ session('sighting_success') }}</span>
              <span class="text-xs text-[#4F6B45] block">Tu reporte será revisado por el administrador antes de publicarse en el mapa territorial.</span>
            </div>
          @endif

          @if(session('sighting_error'))
            <div class="p-4 rounded-2xl bg-[#FFF4D6] border border-[#E9C46A] text-sm text-[#5C4A12] space-y-1">
              <span class="font-bold block">Límite alcanzado</span>
              <span class="block">{{ session('sighting_error') }}</span>
            </div>
          @endif

          @if($errors->any())
            <div class="p-4 rounded-2xl bg-[#FDECEA] border border-[#E5988F] text-sm text-[#7A2E26] space-y-1">
              <span class="font-bold block">Revisa estos campos:</span>
              <ul class="list-disc list-inside text-xs">
                @foreach($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('sightings.public.store') }}" class="relative overflow-hidden bg-white rounded-3xl shadow-xl border border-[#DCE8CC] p-6 sm:p-8 space-y-6">
            @csrf

            <!-- franja de color superior -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#F2C94C] via-[#8FC16A] to-[#2F6B3A]"></div>

            <div class="pt-2">
              <h3 class="text-xl font-black text-[#1F4D33]">Datos de tu observación</h3>
              <p class="text-xs text-[#6B7F5F]">Los campos con (*) son obligatorios.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="space-y-1.5">
                <label for="observer_name" class="block text-sm font-semibold text-[#1F4D33]">Nombre completo (*)</label>
                <input
                  id="observer_name" name="observer_name" type="text" required
                  value="{{ old('observer_name') }}"
                  placeholder="Ej: Laura Gómez"
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
                >
              </div>

              <div class="space-y-1.5">
                <label for="observer_email" class="block text-sm font-semibold text-[#1F4D33]">Correo electrónico (*)</label>
                <input
                  id="observer_email" name="observer_email" type="email" required
                  value="{{ old('observer_email') }}"
                  placeholder="tu-correo@ejemplo.com"
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
                >
                <span class="text-[11px] text-[#6B7F5F] block">Máximo 3 envíos por correo</span>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="space-y-1.5">
                <label for="species_id" class="block text-sm font-semibold text-[#1F4D33]">Especie observada (*)</label>
                <select
                  id="species_id" name="species_id" required
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
                >
                  <option value="">Selecciona la especie observada...</option>
                  @foreach($species as $sp)
                    <option value="{{ $sp->id }}" {{ old('species_id') == $sp->id ? 'selected' : '' }}>
                      {{ $sp->common_name }} ({{ $sp->scientific_name }})
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="space-y-1.5">
                <label for="location_id" class="block text-sm font-semibold text-[#1F4D33]">Sector / zona de Quilichao (*)</label>
                <select
                  id="location_id" name="location_id"
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="space-y-1.5">
                <label for="sighting_date" class="block text-sm font-semibold text-[#1F4D33]">Fecha de la observación (*)</label>
                <input
                  id="sighting_date" name="sighting_date" type="date" required
                  max="{{ date('Y-m-d') }}"
                  value="{{ old('sighting_date', date('Y-m-d')) }}"
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
                >
              </div>

              <div class="space-y-1.5">
                <label for="individuals_count" class="block text-sm font-semibold text-[#1F4D33]">Cantidad de ejemplares (*)</label>
                <input
                  id="individuals_count" name="individuals_count" type="number" min="1" max="500" required
                  value="{{ old('individuals_count', 1) }}"
                  class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-2.5 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
                >
              </div>
            </div>

            <div class="space-y-1.5">
              <label for="description" class="block text-sm font-semibold text-[#1F4D33]">Notas de observación y hábitat (*)</label>
              <textarea
                id="description" name="description" rows="4" required
                placeholder="Describe qué estaba haciendo el ave (perchada, comiendo, cantando), en qué parte del árbol estaba y la hora aproximada..."
                class="w-full bg-[#FBFDF7] border border-[#CFDDBF] px-4 py-3 text-sm rounded-xl focus:border-[#4F8A3A] focus:ring-2 focus:ring-[#A8D08D]/60 focus:outline-none transition"
              >{{ old('description') }}</textarea>
            </div>

            <div class="flex flex-wrap items-center gap-2 text-[11px] text-[#5C7050]">
              <span class="px-3 py-1 rounded-full bg-[#EAF3DF] border border-[#CFDDBF]">Máximo 3 envíos por sesión</span>
              <span class="px-3 py-1 rounded-full bg-[#FFF4D6] border border-[#E9C46A]">Moderado por el administrador</span>
            </div>

            <button type="submit"
              class="w-full rounded-full bg-gradient-to-r from-[#4F8A3A] to-[#2F6B3A] hover:from-[#5A9A44] hover:to-[#367A42] text-white font-bold text-sm py-3.5 shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">
              Enviar observación para revisión ↗
            </button>
          </form>

        </div>
      </div>

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

        

      </div>

    </div>
  </section>

  <!-- ======================================================================
       11. FOOTER — PIE DE PÁGINA
       ====================================================================== -->
  @include('partials.footer')

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
            <!-- Visor de Fotos LIMPIO (8 cols): La foto grande y suelta, botones fuera debajo -->
            <div class="md:col-span-8 flex flex-col items-center justify-between gap-3">
              <!-- Área de la fotografía sola, grande y prominente -->
              <div class="w-full flex-1 min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center">
                <img id="modal-photo-image" class="hidden max-h-[340px] sm:max-h-[390px] w-auto max-w-full object-contain rounded-2xl shadow-md transition-all duration-300" alt="">
                <div id="modal-photo-fallback-box" class="w-full h-72 sm:h-80 wireframe-placeholder rounded-2xl flex flex-col items-center justify-center p-4">
                  <span id="modal-photo-label" class="text-sm font-bold text-[#333333] text-center max-w-sm">
                    [PLACEHOLDER DE FOTOGRAFÍA 1 DE 3]
                  </span>
                  <span id="modal-photo-placeholder-note" class="text-[11px] text-[#777777] font-mono mt-1">
                    Representación wireframe sin imágenes reales
                  </span>
                </div>
              </div>

              <!-- Botones de navegación afuera del cuadro de la foto -->
              <div class="w-full flex items-center justify-between pt-1 px-1">
                <button id="modal-photo-prev" type="button" class="btn-wireframe-secondary text-xs py-1.5 px-4 shadow-xs rounded-full">
                  ← Anterior
                </button>
                <div class="flex gap-2 items-center bg-[#FFFFFF] px-3 py-1.5 rounded-full border border-[#B0B0B0]/60 shadow-xs">
                  <span class="photo-dot-indicator w-3 h-3 bg-[#333333] rounded-full inline-block"></span>
                  <span class="photo-dot-indicator w-2.5 h-2.5 bg-[#B0B0B0] rounded-full inline-block"></span>
                  <span class="photo-dot-indicator w-2.5 h-2.5 bg-[#B0B0B0] rounded-full inline-block"></span>
                </div>
                <button id="modal-photo-next" type="button" class="btn-wireframe-secondary text-xs py-1.5 px-4 shadow-xs rounded-full">
                  Siguiente →
                </button>
              </div>
            </div>

            <div id="modal-video-panel" class="md:col-span-4 min-h-[350px] sm:min-h-[415px] wireframe-placeholder-dark media-frame media-video-panel rounded-2xl p-4 flex flex-col justify-between text-center">
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
  <script>
    window.DB_SPECIES = @json($species);
    window.DB_SIGHTINGS = @json($sightings);
  </script>
  <script src="{{ asset('js/birds-data.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/routes-data.js') }}"></script>
  <script src="{{ asset('js/routes-module.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const heroVideo = document.querySelector('.bv-video');
      if (heroVideo) {
        heroVideo.muted = true;
        const playPromise = heroVideo.play();
        if (playPromise !== undefined) {
          playPromise.catch(function () {});
        }
      }
    });
  </script>
</body>
</html>
