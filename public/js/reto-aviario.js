/* Lógica independiente de la página Reto Aviario. */
(() => {
  "use strict";

  const app = document.getElementById("ra-app");
  if (!app || typeof BIOAVES_DATA === "undefined") return;

  const birds = BIOAVES_DATA.filter((bird) => bird && bird.commonName && getImagePath(bird));
  const birdsWithSongs = birds.filter((bird) => getSongPaths(bird).length > 0);
  const screens = {
    home: app.querySelector("#ra-home-screen"),
    quiz: app.querySelector("#ra-quiz-screen"),
    puzzle: app.querySelector("#ra-puzzle-screen"),
  };
  const quizQuestionPanel = app.querySelector(".ra-question-panel");
  const answerGrid = app.querySelector("#ra-answer-grid");
  const quizFeedback = app.querySelector("#ra-quiz-feedback");
  const quizFinish = app.querySelector("#ra-quiz-finish");
  let quizDeck = [];
  let quizIndex = 0;
  let quizScore = 0;
  let quizMode = "clue";
  let activePuzzleBird = null;
  let puzzleSize = 3;
  let puzzleMoves = 0;
  let selectedTile = null;

  function getImagePath(bird) {
    return bird.image || bird.multimedia?.photos?.find((photo) => photo.src)?.src || null;
  }

  function mediaUrl(path) {
    if (!path) return "";
    if (/^(https?:|data:|blob:)/i.test(path)) return path;
    const prefix = window.location.pathname.endsWith(".html") ? "public/" : "/";
    return `${prefix}${path.split("/").map((part) => encodeURIComponent(part)).join("/")}`;
  }

  function getAudioPaths(bird) {
    const media = bird.multimedia || {};
    const localSoundFiles = {
      "piojito-pardo": "video/piojito pardo sonido .mp4",
      "suiriri-piquirrojo": "video/pico rojo sonido.mp4",
      "suiriri-cariblanco": "video/carablanca sonido.mp4",
      "polluela-sora": "video/polluela sora sonido .mp4",
    };
    const videos = [...(media.videos || []), ...(media.video?.src ? [media.video] : [])]
      .filter((item) => item.src);
    const local = (path) => path && !/^(https?:|data:|blob:)/i.test(path);
    const localSample = local(media.audioSample) ? [media.audioSample] : [];
    const localSongVideos = videos
      .filter((item) => local(item.src) && /canto|cantando|sonido|song/i.test(`${item.src} ${item.label || ""}`))
      .map((item) => item.src);
    const mappedLocalSound = localSoundFiles[bird.id] ? [localSoundFiles[bird.id]] : [];
    const remoteSample = media.audioSample && !local(media.audioSample) ? [media.audioSample] : [];
    const otherVideos = videos.map((item) => item.src);
    return [...new Set([...localSample, ...localSongVideos, ...mappedLocalSound, ...remoteSample, ...otherVideos])];
  }

  function getSongPaths(bird) {
    const media = bird.multimedia || {};
    const videos = [...(media.videos || []), ...(media.video?.src ? [media.video] : [])]
      .filter((item) => item.src && /canto|cantando|sonido|song/i.test(`${item.src} ${item.label || ""}`))
      .map((item) => item.src);
    return [...new Set([media.audioSample, ...videos].filter(Boolean))];
  }

  function shuffled(items) {
    const result = [...items];
    for (let i = result.length - 1; i > 0; i -= 1) {
      const j = Math.floor(Math.random() * (i + 1));
      [result[i], result[j]] = [result[j], result[i]];
    }
    return result;
  }

  function showScreen(name) {
    Object.entries(screens).forEach(([key, screen]) => { screen.hidden = key !== name; });
    stopAudio();
  }

  function returnToGames() {
    showScreen("home");
    const gameGrid = app.querySelector(".ra-game-grid");
    requestAnimationFrame(() => {
      const header = document.querySelector("#main-navbar") || app.querySelector(".ra-topbar");
      const offset = (header ? header.getBoundingClientRect().height : 0) + 16;
      const top = gameGrid.getBoundingClientRect().top + window.scrollY - offset;
      const behavior = window.matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth";
      window.scrollTo({ top: Math.max(0, top), behavior });
    });
  }

  function isGameState(state) {
    return state && ["puzzle", "quiz", "song"].includes(state.raGame);
  }

  function startGame(game) {
    if (game === "quiz") startQuiz();
    else if (game === "song") startQuiz("song");
    else if (game === "puzzle") startPuzzle();
  }

  function openGame(game) {
    const currentState = window.history.state;
    const nextState = currentState && typeof currentState === "object" ? { ...currentState } : {};
    nextState.raGame = game;
    window.history.pushState(nextState, "", window.location.href);
    startGame(game);
  }

  function backToGames() {
    if (isGameState(window.history.state)) {
      window.history.back();
      return;
    }
    returnToGames();
  }

  function stopAudio() {
    app.querySelectorAll("audio").forEach((audio) => {
      audio.pause();
      audio.removeAttribute("src");
      audio.load();
    });
  }

  function setAudioSources(audio, fallback, sources, emptyMessage, failedMessage) {
    audio.pause();
    audio.onerror = null;
    audio.removeAttribute("src");
    audio.load();
    fallback.hidden = true;
    if (!sources.length) {
      audio.hidden = true;
      fallback.hidden = false;
      fallback.textContent = emptyMessage;
      return;
    }

    let sourceIndex = 0;
    const tryNextSource = () => {
      if (sourceIndex >= sources.length) {
        audio.onerror = null;
        audio.hidden = true;
        fallback.hidden = false;
        fallback.textContent = failedMessage;
        return;
      }
      const source = sources[sourceIndex++];
      audio.hidden = false;
      fallback.hidden = true;
      audio.onerror = tryNextSource;
      audio.src = mediaUrl(source);
      audio.load();
    };
    tryNextSource();
  }

  function setAudio(audioId, fallbackId, bird) {
    setAudioSources(
      app.querySelector(`#${audioId}`),
      app.querySelector(`#${fallbackId}`),
      getAudioPaths(bird),
      "El canto de esta especie no está cargado en el catálogo.",
      "No se pudo cargar el canto. Revisa la conexión e inténtalo de nuevo."
    );
  }

  function setQuestionSong(bird) {
    setAudioSources(
      app.querySelector("#ra-question-audio"),
      app.querySelector("#ra-question-audio-message"),
      getSongPaths(bird),
      "Esta especie no tiene un canto registrado.",
      "No se pudo cargar el canto. Puedes continuar con las opciones."
    );
  }

  function setReveal({ bird, photoId, nameId, scientificId, audioId, fallbackId }) {
    const photo = app.querySelector(`#${photoId}`);
    const imagePath = getImagePath(bird);
    photo.src = mediaUrl(imagePath);
    photo.alt = bird.commonName;
    photo.hidden = false;
    photo.onerror = () => { photo.hidden = true; };
    app.querySelector(`#${nameId}`).textContent = bird.commonName;
    app.querySelector(`#${scientificId}`).textContent = bird.scientificName || "";
    setAudio(audioId, fallbackId, bird);
  }

  function clueFor(bird) {
    const text = bird.physicalCharacteristics || bird.description || bird.habitatLabel || "Ave registrada en el catálogo BioAves.";
    const name = bird.commonName.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    return text.replace(new RegExp(name, "gi"), "esta ave").trim();
  }

  function startQuiz(mode = "clue") {
    quizMode = mode;
    const questionBirds = mode === "song" ? birdsWithSongs : birds;
    const isSongQuiz = mode === "song";
    app.querySelector("#ra-quiz-mode").textContent = isSongQuiz ? "Adivina por el Canto" : "Acierta el Nombre del Ave";
    app.querySelector("#ra-quiz-title").textContent = isSongQuiz ? "¿De quién es este canto?" : "¿Quién soy?";
    if (questionBirds.length < 4) {
      app.querySelector("#ra-clue").hidden = false;
      app.querySelector("#ra-song-player").hidden = true;
      app.querySelector("#ra-clue").textContent = isSongQuiz
        ? "Se necesitan al menos cuatro cantos disponibles para iniciar este reto."
        : "Se necesitan al menos cuatro aves en el catálogo para iniciar el reto.";
      answerGrid.hidden = true;
      answerGrid.replaceChildren();
      quizFeedback.hidden = true;
      quizFinish.hidden = true;
      quizQuestionPanel.hidden = false;
      showScreen("quiz");
      return;
    }
    quizDeck = shuffled(questionBirds).slice(0, Math.min(10, questionBirds.length));
    quizIndex = 0;
    quizScore = 0;
    quizFinish.hidden = true;
    quizQuestionPanel.hidden = false;
    app.querySelector("#ra-quiz-score").textContent = "0";
    showScreen("quiz");
    renderQuestion();
  }

  function renderQuestion() {
    stopAudio();
    const bird = quizDeck[quizIndex];
    if (!bird) return finishQuiz();
    quizFeedback.hidden = true;
    answerGrid.hidden = false;
    answerGrid.replaceChildren();
    const percent = Math.round((quizIndex / quizDeck.length) * 100);
    app.querySelector("#ra-question-count").textContent = `Pregunta ${quizIndex + 1} de ${quizDeck.length}`;
    app.querySelector("#ra-progress-text").textContent = `${percent}%`;
    app.querySelector(".ra-progress-track").setAttribute("aria-valuenow", String(percent));
    app.querySelector("#ra-progress-bar").style.width = `${percent}%`;
    const isSongQuiz = quizMode === "song";
    app.querySelector("#ra-question-instruction").textContent = isSongQuiz ? "ESCUCHA EL CANTO" : "LEE LA PISTA";
    app.querySelector("#ra-clue").hidden = isSongQuiz;
    app.querySelector("#ra-song-player").hidden = !isSongQuiz;
    if (isSongQuiz) {
      setQuestionSong(bird);
    } else {
      app.querySelector("#ra-clue").textContent = clueFor(bird);
    }

    const alternatives = shuffled(birds.filter((item) => item.id !== bird.id)).slice(0, 3);
    const options = shuffled([...alternatives, bird]);
    options.forEach((option) => {
      const button = document.createElement("button");
      button.className = "ra-answer-option";
      button.type = "button";
      button.textContent = option.commonName;
      button.addEventListener("click", () => chooseAnswer(button, option, bird));
      answerGrid.append(button);
    });
  }

  function chooseAnswer(button, choice, correctBird) {
    if (!answerGrid || answerGrid.hidden) return;
    const correct = choice.id === correctBird.id;
    if (correct) quizScore += 1;
    app.querySelector("#ra-question-audio").pause();
    app.querySelector("#ra-song-player").hidden = true;
    app.querySelector("#ra-quiz-score").textContent = String(quizScore);
    [...answerGrid.children].forEach((option) => {
      option.disabled = true;
      if (option.textContent === correctBird.commonName) option.classList.add("ra-correct");
    });
    if (!correct) button.classList.add("ra-incorrect");
    app.querySelector("#ra-feedback-label").textContent = correct ? "¡RESPUESTA CORRECTA!" : "LA RESPUESTA ERA";
    setReveal({ bird: correctBird, photoId: "ra-quiz-photo", nameId: "ra-quiz-bird-name", scientificId: "ra-quiz-bird-scientific", audioId: "ra-quiz-audio", fallbackId: "ra-quiz-no-audio" });
    answerGrid.hidden = true;
    quizFeedback.hidden = false;
  }

  function finishQuiz() {
    quizQuestionPanel.hidden = true;
    quizFinish.hidden = false;
    const total = quizDeck.length;
    quizFinish.replaceChildren();
    const heading = document.createElement("h2");
    heading.textContent = "¡Reto terminado!";
    const result = document.createElement("p");
    result.textContent = `Acertaste ${quizScore} de ${total} aves.`;
    const replay = document.createElement("button");
    replay.className = "ra-primary-button";
    replay.type = "button";
    replay.textContent = "Jugar otra vez";
    replay.addEventListener("click", () => startQuiz(quizMode));
    quizFinish.append(heading, result, replay);
    const percent = 100;
    app.querySelector("#ra-progress-text").textContent = `${percent}%`;
    app.querySelector(".ra-progress-track").setAttribute("aria-valuenow", String(percent));
    app.querySelector("#ra-progress-bar").style.width = `${percent}%`;
  }

  function startPuzzle() {
    showScreen("puzzle");
    app.querySelector("#ra-puzzle-reveal").hidden = true;
    app.querySelector("#ra-puzzle-hint-text").hidden = true;
    activePuzzleBird = shuffled(birds)[0];
    puzzleSize = Number(app.querySelector("#ra-difficulty").value) || 3;
    makePuzzle();
  }

  function makePuzzle() {
    const board = app.querySelector("#ra-puzzle-board");
    board.replaceChildren();
    board.style.gridTemplateColumns = `repeat(${puzzleSize}, minmax(0, 1fr))`;
    board.setAttribute("aria-label", `Rompecabezas de ${puzzleSize} por ${puzzleSize} piezas`);
    const total = puzzleSize * puzzleSize;
    let pieces = shuffled(Array.from({ length: total }, (_, index) => index));
    if (pieces.every((piece, index) => piece === index)) pieces = [pieces[1], pieces[0], ...pieces.slice(2)];
    puzzleMoves = 0;
    selectedTile = null;
    app.querySelector("#ra-puzzle-moves").textContent = "0";
    app.querySelector("#ra-puzzle-status").textContent = "Selecciona dos piezas para intercambiarlas.";
    app.querySelector("#ra-puzzle-bird-label").textContent = `Ave misteriosa · nivel ${puzzleSize} × ${puzzleSize}`;
    app.querySelector("#ra-puzzle-hint-text").textContent = clueFor(activePuzzleBird);

    pieces.forEach((piece, index) => {
      const tile = document.createElement("button");
      tile.className = "ra-puzzle-tile";
      tile.type = "button";
      tile.dataset.index = String(index);
      tile.dataset.piece = String(piece);
      tile.setAttribute("aria-label", `Pieza ${index + 1}`);
      tile.style.backgroundImage = `url("${mediaUrl(getImagePath(activePuzzleBird))}")`;
      tile.style.backgroundSize = `${puzzleSize * 100}% ${puzzleSize * 100}%`;
      setPiecePosition(tile, piece);
      tile.addEventListener("click", () => selectPuzzleTile(tile));
      board.append(tile);
    });
  }

  function setPiecePosition(tile, piece) {
    const column = piece % puzzleSize;
    const row = Math.floor(piece / puzzleSize);
    const x = puzzleSize === 1 ? 0 : (column / (puzzleSize - 1)) * 100;
    const y = puzzleSize === 1 ? 0 : (row / (puzzleSize - 1)) * 100;
    tile.style.backgroundPosition = `${x}% ${y}%`;
  }

  function selectPuzzleTile(tile) {
    if (app.querySelector("#ra-puzzle-reveal").hidden === false) return;
    if (!selectedTile) {
      selectedTile = tile;
      tile.classList.add("is-selected");
      return;
    }
    if (selectedTile === tile) {
      selectedTile.classList.remove("is-selected");
      selectedTile = null;
      return;
    }
    const firstPiece = selectedTile.dataset.piece;
    selectedTile.dataset.piece = tile.dataset.piece;
    tile.dataset.piece = firstPiece;
    setPiecePosition(selectedTile, Number(selectedTile.dataset.piece));
    setPiecePosition(tile, Number(tile.dataset.piece));
    selectedTile.classList.remove("is-selected");
    selectedTile = null;
    puzzleMoves += 1;
    app.querySelector("#ra-puzzle-moves").textContent = String(puzzleMoves);
    checkPuzzleSolved();
  }

  function checkPuzzleSolved() {
    const tiles = [...app.querySelectorAll(".ra-puzzle-tile")];
    const solved = tiles.every((tile, index) => Number(tile.dataset.piece) === index);
    if (!solved) return;
    app.querySelector("#ra-puzzle-status").textContent = `¡Imagen completa en ${puzzleMoves} movimientos!`;
    app.querySelector("#ra-puzzle-bird-label").textContent = activePuzzleBird.commonName;
    const reveal = app.querySelector("#ra-puzzle-reveal");
    setReveal({ bird: activePuzzleBird, photoId: "ra-puzzle-photo", nameId: "ra-puzzle-bird-name", scientificId: "ra-puzzle-bird-scientific", audioId: "ra-puzzle-audio", fallbackId: "ra-puzzle-no-audio" });
    reveal.hidden = false;
  }

  app.querySelectorAll("[data-open-game]").forEach((button) => {
    button.addEventListener("click", () => openGame(button.dataset.openGame));
  });
  app.querySelectorAll("[data-back-to-games]").forEach((button) => button.addEventListener("click", backToGames));
  window.addEventListener("popstate", (event) => {
    if (isGameState(event.state)) startGame(event.state.raGame);
    else returnToGames();
  });
  app.querySelector("#ra-next-question").addEventListener("click", () => {
    quizIndex += 1;
    renderQuestion();
  });
  app.querySelector("#ra-difficulty").addEventListener("change", () => {
    puzzleSize = Number(app.querySelector("#ra-difficulty").value) || 3;
    app.querySelector("#ra-puzzle-reveal").hidden = true;
    makePuzzle();
  });
  app.querySelector("#ra-new-puzzle").addEventListener("click", startPuzzle);
  app.querySelector("#ra-puzzle-hint").addEventListener("click", () => {
    app.querySelector("#ra-puzzle-hint-text").hidden = false;
    app.querySelector("#ra-puzzle-status").textContent = "Pista disponible junto al tablero.";
  });

  if (isGameState(window.history.state)) startGame(window.history.state.raGame);
})();
