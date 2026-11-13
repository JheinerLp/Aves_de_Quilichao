<header id="main-navbar" class="bv-header">
    <div class="bv-pill">
      <a href="{{ route('home') }}#inicio" class="bv-logo"><span class="bv-logo-mark"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4C9 4 4 9 4 15c0 1.6.5 3 1.3 4.2C7 15 10 12 14 10c-3 3-5 6-5.600 10 1 .4 2 .6 3 .6 6 0 8.600-6 8.600-16.600z"/></svg></span><span class="bv-logo-text"><b>BIOAVES QUILICHAO</b><small>Santander de Quilichao</small></span></a>
      <nav class="bv-nav" aria-label="Principal">
        <a href="{{ route('home') }}#inicio" class="is-active">🏠 Inicio</a>
        <a href="{{ route('catalog.index') }}">📖 Catálogo</a>
        <a href="{{ route('home') }}#mapa">📍 Mapa</a>
        <a href="{{ route('home') }}#sobre-nosotros">💚 Nuestra misión</a>
      </nav>
    </div>
    <button id="mobile-menu-btn" type="button" class="bv-burger" aria-label="Abrir menú">☰</button>
    <div id="mobile-menu" class="hidden bv-mobile">
      <a href="{{ route('home') }}#inicio">Inicio</a><a href="{{ route('catalog.index') }}">Catálogo</a><a href="{{ route('home') }}#carrusel">Aves destacadas</a>
      <a href="{{ route('home') }}#rutas">Rutas</a><a href="{{ route('home') }}#mapa">Mapa</a><a href="{{ route('home') }}#conservacion">Conservación</a><a href="{{ route('home') }}#sobre-nosotros">Nuestra misión</a>
    </div>
  </header>
