<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Juega y aprende con las aves del catálogo BioAves Quilichao.">
  <title>Reto Aviario | BioAves Quilichao</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/reto-aviario.css') }}">
</head>
<body>
  @include('partials.header')

  <div id="ra-app">
    <main class="ra-main">
      <section class="ra-screen" id="ra-home-screen">
        <div class="ra-eyebrow">BioAves · aprende jugando</div>
        <h1>Reto Aviario</h1>
        <p class="ra-intro">Descubre cuánto sabes de las aves de Santander de Quilichao. Elige un juego y aprende a reconocer sus formas, nombres y cantos.</p>
        <p class="ra-catalog-note"><span aria-hidden="true">✦</span> Imágenes, descripciones y sonidos del catálogo BioAves</p>

        <div class="ra-game-grid">
          <button class="ra-game-card" type="button" data-open-game="puzzle">
            <span class="ra-card-image ra-puzzle-image">
              <img src="{{ asset('img/aves/chicao-panoramica.png') }}" alt="Chicao, ave del catálogo BioAves" loading="lazy">
              <span class="ra-puzzle-mark" aria-hidden="true">🧩</span>
            </span>
            <span class="ra-card-content">
              <span class="ra-card-meta"><span>JUEGO 01</span><span>3 niveles</span></span>
              <span class="ra-card-title">Rompe Cabeza</span>
              <span class="ra-card-description">Arma la imagen de una de las aves del catálogo, pieza por pieza.</span>
              <span class="ra-card-action">Elegir dificultad <span aria-hidden="true">→</span></span>
            </span>
          </button>

          <button class="ra-game-card" type="button" data-open-game="quiz">
            <span class="ra-card-image ra-quiz-image">
              <img src="{{ asset('img/aves/COLIBRI.png') }}" alt="Colibrí Colirrufo, ave del catálogo BioAves" loading="lazy">
              <span class="ra-question-mark" aria-hidden="true">?</span>
            </span>
            <span class="ra-card-content">
              <span class="ra-card-meta"><span>JUEGO 02</span><span>4 opciones</span></span>
              <span class="ra-card-title">Acierta el Nombre del Ave</span>
              <span class="ra-card-description">Lee una pista, escoge entre cuatro aves y descubre su imagen y canto.</span>
              <span class="ra-card-action">Comenzar reto <span aria-hidden="true">→</span></span>
            </span>
          </button>
        </div>
      </section>

      <section class="ra-screen" id="ra-quiz-screen" hidden aria-labelledby="ra-quiz-title">
        <button class="ra-back-button" type="button" data-back-to-games>← Volver a los juegos</button>
        <div class="ra-game-heading">
          <div><div class="ra-eyebrow">Acierta el Nombre del Ave</div><h1 id="ra-quiz-title">¿Quién soy?</h1></div>
          <div class="ra-score">Puntaje: <strong id="ra-quiz-score">0</strong></div>
        </div>
        <div class="ra-progress-row"><span id="ra-question-count">Pregunta 1</span><span id="ra-progress-text">0%</span></div>
        <div class="ra-progress-track" role="progressbar" aria-label="Progreso del reto" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><span id="ra-progress-bar"></span></div>
        <article class="ra-question-panel" aria-live="polite">
          <p class="ra-question-label">LEE LA PISTA</p>
          <p class="ra-clue" id="ra-clue">Cargando aves…</p>
          <div class="ra-answer-grid" id="ra-answer-grid"></div>
          <div class="ra-feedback" id="ra-quiz-feedback" hidden>
            <div class="ra-reveal-photo"><img id="ra-quiz-photo" alt=""></div>
            <div class="ra-reveal-details">
              <p class="ra-feedback-label" id="ra-feedback-label"></p>
              <h2 id="ra-quiz-bird-name"></h2>
              <p id="ra-quiz-bird-scientific"></p>
              <audio id="ra-quiz-audio" controls preload="none"></audio>
              <p class="ra-no-audio" id="ra-quiz-no-audio" hidden>El canto de esta especie no está disponible.</p>
              <button class="ra-primary-button" id="ra-next-question" type="button">Siguiente ave →</button>
            </div>
          </div>
        </article>
        <div class="ra-finish-panel" id="ra-quiz-finish" hidden aria-live="polite"></div>
      </section>

      <section class="ra-screen" id="ra-puzzle-screen" hidden aria-labelledby="ra-puzzle-title">
        <button class="ra-back-button" type="button" data-back-to-games>← Volver a los juegos</button>
        <div class="ra-game-heading">
          <div><div class="ra-eyebrow">Rompe Cabeza</div><h1 id="ra-puzzle-title">Arma el ave</h1></div>
          <label class="ra-difficulty-label" for="ra-difficulty">Dificultad
            <select id="ra-difficulty">
              <option value="3">Fácil · 3 × 3</option>
              <option value="4">Medio · 4 × 4</option>
              <option value="5">Difícil · 5 × 5</option>
            </select>
          </label>
        </div>
        <div class="ra-puzzle-layout">
          <article class="ra-question-panel ra-puzzle-panel">
            <div class="ra-puzzle-topline"><span id="ra-puzzle-bird-label">Ave misteriosa del catálogo</span><span>Movimientos: <strong id="ra-puzzle-moves">0</strong></span></div>
            <div class="ra-puzzle-board" id="ra-puzzle-board" role="group" aria-label="Rompecabezas desordenado"></div>
            <div class="ra-puzzle-controls">
              <button class="ra-secondary-button" id="ra-puzzle-hint" type="button">Ver pista</button>
              <button class="ra-secondary-button" id="ra-new-puzzle" type="button">Otra ave</button>
            </div>
            <p class="ra-puzzle-status" id="ra-puzzle-status" aria-live="polite">Selecciona dos piezas para intercambiarlas.</p>
          </article>
          <aside class="ra-puzzle-help">
            <span class="ra-help-icon" aria-hidden="true">✦</span>
            <h2>¿Cómo se juega?</h2>
            <p>Toca una pieza y luego otra para intercambiar su lugar. Completa la fotografía para descubrir el ave.</p>
            <p class="ra-puzzle-hint" id="ra-puzzle-hint-text" hidden></p>
          </aside>
        </div>
        <div class="ra-puzzle-reveal" id="ra-puzzle-reveal" hidden aria-live="polite">
          <div class="ra-reveal-photo"><img id="ra-puzzle-photo" alt=""></div>
          <div class="ra-reveal-details"><p class="ra-feedback-label">¡ROMPECABEZAS COMPLETADO!</p><h2 id="ra-puzzle-bird-name"></h2><p id="ra-puzzle-bird-scientific"></p><audio id="ra-puzzle-audio" controls preload="none"></audio><p class="ra-no-audio" id="ra-puzzle-no-audio" hidden>El canto de esta especie no está disponible.</p></div>
        </div>
      </section>
    </main>

    <footer class="ra-footer">BioAves Quilichao · Reto Aviario · Aprende y cuida las aves de tu territorio</footer>
  </div>

  <script src="{{ asset('js/birds-data.js') }}"></script>
  <script src="{{ asset('js/reto-aviario.js') }}"></script>
  <script>
    const mobileMenuButton = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton?.addEventListener('click', () => {
      mobileMenu?.classList.toggle('hidden');
      mobileMenuButton.setAttribute('aria-expanded', String(!mobileMenu?.classList.contains('hidden')));
    });
  </script>
</body>
</html>
