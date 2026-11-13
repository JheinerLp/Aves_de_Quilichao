function speciesMediaUrl(path) {
  const prefix = window.location.pathname.endsWith(".html") ? "public/" : "/";
  return prefix + path.split("/").map(encodeURIComponent).join("/");
}

function renderSpeciesVideos(bird) {
  const panel = document.getElementById("modal-video-panel");
  if (!panel) return;
  if (!panel.dataset.placeholderMarkup) panel.dataset.placeholderMarkup = panel.innerHTML;
  const videos = bird.multimedia?.videos || [];
  panel.innerHTML = videos.length
    ? `<span class="text-[10px] font-mono text-[#D0D0D0] uppercase">Registros de video</span>${videos.map(video => `
        <div class="w-full text-left">
          <span class="text-[10px] text-[#FFFFFF]">${video.label}</span>
          <video controls preload="metadata" playsinline class="w-full aspect-video object-cover bg-black" src="${speciesMediaUrl(video.src)}" aria-label="${video.label} de ${bird.commonName}"></video>
        </div>`).join("")}`
    : panel.dataset.placeholderMarkup;
}

/**
 * catalogo.js - BioAves Quilichao
 * Lógica para la página independiente de Catálogo (catalogo.html).
 * Maneja búsqueda, filtros por hábitat y categoría, ordenamiento y modal completo de especie.
 */

document.addEventListener("DOMContentLoaded", () => {
  initCatalogPage();
  initDetailModal();
  checkUrlParams();
});

let currentSelectedBird = null;
let currentPhotoIdx = 0;
let modalAudioEl = null;
let audioCtx = null;

function playSyntheticChirp() {
  try {
    const AudioContextClass = window.AudioContext || window.webkitAudioContext;
    if (!audioCtx) audioCtx = new AudioContextClass();
    if (audioCtx.state === "suspended") audioCtx.resume();

    const now = audioCtx.currentTime;
    [0, 0.2, 0.4].forEach((offset, idx) => {
      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();
      osc.type = "sine";
      osc.frequency.setValueAtTime(2600 + idx * 200, now + offset);
      osc.frequency.exponentialRampToValueAtTime(3600, now + offset + 0.12);

      gain.gain.setValueAtTime(0.001, now + offset);
      gain.gain.linearRampToValueAtTime(0.18, now + offset + 0.03);
      gain.gain.exponentialRampToValueAtTime(0.001, now + offset + 0.16);

      osc.connect(gain);
      gain.connect(audioCtx.destination);

      osc.start(now + offset);
      osc.stop(now + offset + 0.17);
    });
  } catch (err) {
    console.warn("Sintetizador Web Audio no disponible:", err);
  }
}

function initCatalogPage() {
  const grid = document.getElementById("catalog-grid");
  const searchInput = document.getElementById("catalog-search");
  const sortSelect = document.getElementById("catalog-sort");
  const habitatSelect = document.getElementById("filter-habitat");
  const categorySelect = document.getElementById("filter-category");
  const resetBtn = document.getElementById("reset-filters-btn");
  const countLabel = document.getElementById("catalog-count-label");

  if (!grid) return;

  function renderGrid() {
    const query = searchInput ? searchInput.value.trim().toLowerCase() : "";
    const habitat = habitatSelect ? habitatSelect.value : "all";
    const category = categorySelect ? categorySelect.value : "all";
    const sort = sortSelect ? sortSelect.value : "name-asc";

    let results = BIOAVES_DATA.filter((bird) => {
      const matchSearch =
        bird.commonName.toLowerCase().includes(query) ||
        bird.scientificName.toLowerCase().includes(query) ||
        bird.family.toLowerCase().includes(query) ||
        bird.habitatLabel.toLowerCase().includes(query);

      const matchHabitat = habitat === "all" || bird.habitatType === habitat;
      const matchCategory = category === "all" || bird.category === category;

      return matchSearch && matchHabitat && matchCategory;
    });

    if (sort === "name-asc") {
      results.sort((a, b) => a.commonName.localeCompare(b.commonName));
    } else if (sort === "name-desc") {
      results.sort((a, b) => b.commonName.localeCompare(a.commonName));
    } else if (sort === "scientific") {
      results.sort((a, b) => a.scientificName.localeCompare(b.scientificName));
    } else if (sort === "family") {
      results.sort((a, b) => a.family.localeCompare(b.family));
    }

    if (countLabel) {
      countLabel.textContent = `Mostrando ${results.length} de ${BIOAVES_DATA.length} especies documentadas`;
    }

    if (results.length === 0) {
      grid.innerHTML = `
        <div class="col-span-full p-12 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm text-center space-y-2">
          <p class="text-sm font-bold text-[#333333]">No se encontraron especies con los criterios especificados</p>
          <p class="text-xs text-[#777777]">Prueba limpiando los filtros o escribiendo otro término de búsqueda.</p>
        </div>
      `;
      return;
    }

    grid.innerHTML = results
      .map(
        (bird) => `
        <div class="p-5 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm flex flex-col justify-between space-y-4 hover:border-[#333333] transition-colors" data-bird-id="${bird.id}">
          <div class="space-y-3">
            <div class="h-44 w-full wireframe-placeholder rounded-sm overflow-hidden">
              ${bird.image ? `<img src="${speciesMediaUrl(bird.image)}" alt="${bird.commonName}" loading="lazy" class="w-full h-full" style="object-fit:${bird.imageFit || "cover"};object-position:${bird.imagePosition || "center"}">` : `
                <span class="text-xs font-bold text-[#333333]">[PLACEHOLDER DE FOTOGRAFÍA]</span>
                <span class="text-[10px] text-[#777777] font-mono mt-1">${bird.commonName}</span>`}
            </div>

            <div class="space-y-1">
              <span class="text-[10px] font-mono uppercase px-1.5 py-0.5 bg-[#F2F2F2] border border-[#B0B0B0] text-[#333333]">
                ${bird.family} • ${bird.status.split(' ')[0]}
              </span>
              <h3 class="text-base font-bold text-[#333333]">
                ${bird.commonName}
              </h3>
              <p class="text-xs italic font-mono text-[#777777]">
                ${bird.scientificName}
              </p>
              <div class="pt-2 text-[11px] text-[#777777]">
                <strong class="text-[#333333]">Hábitat:</strong> ${bird.habitatLabel}
              </div>
            </div>
          </div>

          <div class="pt-3 border-t border-[#B0B0B0]">
            <button type="button" class="btn-wireframe-primary w-full text-xs py-2 open-modal-btn" data-bird-id="${bird.id}">
              Ver detalles de la especie →
            </button>
          </div>
        </div>
      `
      )
      .join("");

    grid.querySelectorAll(".open-modal-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        const birdId = btn.dataset.birdId;
        const bird = BIOAVES_DATA.find((b) => b.id === birdId);
        if (bird) openDetailModal(bird);
      });
    });
  }

  [searchInput, sortSelect, habitatSelect, categorySelect].forEach((el) => {
    if (el) el.addEventListener("input", renderGrid);
  });

  if (resetBtn) {
    resetBtn.addEventListener("click", () => {
      if (searchInput) searchInput.value = "";
      if (sortSelect) sortSelect.value = "name-asc";
      if (habitatSelect) habitatSelect.value = "all";
      if (categorySelect) categorySelect.value = "all";
      renderGrid();
    });
  }

  renderGrid();
}

function initDetailModal() {
  const modal = document.getElementById("modal-detalle-ave");
  const closeBtn = document.getElementById("modal-close-btn");
  const prevPhotoBtn = document.getElementById("modal-photo-prev");
  const nextPhotoBtn = document.getElementById("modal-photo-next");
  const audioBtn = document.getElementById("modal-audio-toggle-btn");
  modalAudioEl = document.getElementById("modal-species-audio");

  if (!modal) return;

  function closeModal() {
    document.querySelectorAll('#modal-video-panel video').forEach(video => video.pause());
    modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    if (modalAudioEl && !modalAudioEl.paused) {
      modalAudioEl.pause();
    }
    resetAudioUI();
  }

  if (closeBtn) closeBtn.addEventListener("click", closeModal);

  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modal.classList.contains("hidden")) {
      closeModal();
    }
  });

  if (prevPhotoBtn) {
    prevPhotoBtn.addEventListener("click", () => {
      if (!currentSelectedBird) return;
      const total = currentSelectedBird.multimedia.photos.length;
      currentPhotoIdx = (currentPhotoIdx - 1 + total) % total;
      updatePhotoView();
    });
  }

  if (nextPhotoBtn) {
    nextPhotoBtn.addEventListener("click", () => {
      if (!currentSelectedBird) return;
      const total = currentSelectedBird.multimedia.photos.length;
      currentPhotoIdx = (currentPhotoIdx + 1) % total;
      updatePhotoView();
    });
  }

  if (audioBtn && modalAudioEl) {
    audioBtn.addEventListener("click", () => {
      const btnIcon = document.getElementById("audio-btn-icon");
      const btnText = document.getElementById("audio-btn-text");
      const stateText = document.getElementById("audio-state-text");

      if (!modalAudioEl.paused) {
        modalAudioEl.pause();
        btnIcon.textContent = "▶";
        btnText.textContent = "Reanudar Canto";
        stateText.textContent = "Audio pausado por el usuario";
      } else {
        const playPromise = modalAudioEl.play();
        if (playPromise !== undefined) {
          playPromise
            .then(() => {
              btnIcon.textContent = "⏸";
              btnText.textContent = "Pausar Canto";
              stateText.textContent = "Reproduciendo canto representativo...";
            })
            .catch(() => {
              playSyntheticChirp();
              simulateAudioPlayback();
            });
        }
      }
    });

    modalAudioEl.ontimeupdate = () => {
      const progressBar = document.getElementById("audio-progress-bar");
      const durationDisplay = document.getElementById("audio-duration-display");
      if (modalAudioEl.duration && progressBar) {
        const pct = (modalAudioEl.currentTime / modalAudioEl.duration) * 100;
        progressBar.style.width = `${pct}%`;
        const mins = Math.floor(modalAudioEl.currentTime / 60);
        const secs = Math.floor(modalAudioEl.currentTime % 60);
        durationDisplay.textContent = `${mins}:${secs < 10 ? '0' : ''}${secs} / ${currentSelectedBird ? currentSelectedBird.multimedia.audioDuration : '0:28'}`;
      }
    };

    modalAudioEl.onended = () => {
      resetAudioUI();
    };
  }
}

function updatePhotoView() {
  if (!currentSelectedBird) return;
  const photo = currentSelectedBird.multimedia.photos[currentPhotoIdx];
  const total = currentSelectedBird.multimedia.photos.length;

  const photoLabel = document.getElementById("modal-photo-label");
  const placeholderNote = document.getElementById("modal-photo-placeholder-note");
  const photoIndicator = document.getElementById("modal-photo-indicator");
  const dots = document.querySelectorAll(".photo-dot-indicator");

  const photoImage = document.getElementById("modal-photo-image");
  if (photoImage) {
    photoImage.classList.toggle("hidden", !photo.src);
    if (photo.src) {
      photoImage.src = speciesMediaUrl(photo.src);
      photoImage.alt = `${currentSelectedBird.commonName}: ${photo.label}`;
      photoImage.style.objectFit = currentSelectedBird.imageFit || "cover";
      photoImage.style.objectPosition = currentSelectedBird.imagePosition || "center";
    } else {
      photoImage.removeAttribute("src");
    }
  }
  if (photoLabel) {
    photoLabel.textContent = photo.label;
    photoLabel.classList.toggle("hidden", !!photo.src);
  }
  if (placeholderNote) placeholderNote.classList.toggle("hidden", !!photo.src);
  if (photoIndicator) photoIndicator.textContent = `Foto ${currentPhotoIdx + 1} de ${total}`;

  dots.forEach((dot, idx) => {
    if (idx === currentPhotoIdx) {
      dot.className = "photo-dot-indicator w-3 h-3 bg-[#333333] rounded-xs inline-block";
    } else {
      dot.className = "photo-dot-indicator w-2.5 h-2.5 bg-[#B0B0B0] rounded-xs inline-block";
    }
  });
}

function resetAudioUI() {
  const btnIcon = document.getElementById("audio-btn-icon");
  const btnText = document.getElementById("audio-btn-text");
  const stateText = document.getElementById("audio-state-text");
  const progressBar = document.getElementById("audio-progress-bar");
  const durationDisplay = document.getElementById("audio-duration-display");

  if (btnIcon) btnIcon.textContent = "▶";
  if (btnText) btnText.textContent = "Reproducir Canto";
  if (stateText) stateText.textContent = "Reproductor en espera [PLACEHOLDER DE AUDIO]";
  if (progressBar) progressBar.style.width = "0%";
  if (durationDisplay) durationDisplay.textContent = `0:00 / ${currentSelectedBird ? currentSelectedBird.multimedia.audioDuration : '0:28'}`;
}

function simulateAudioPlayback() {
  const btnIcon = document.getElementById("audio-btn-icon");
  const btnText = document.getElementById("audio-btn-text");
  const stateText = document.getElementById("audio-state-text");
  const progressBar = document.getElementById("audio-progress-bar");

  btnIcon.textContent = "⏸";
  btnText.textContent = "Pausar Canto";
  stateText.textContent = "Reproduciendo canto sintetizado [Demostración]...";

  let pct = 0;
  const interval = setInterval(() => {
    pct += 5;
    if (progressBar) progressBar.style.width = `${pct}%`;
    if (pct >= 100) {
      clearInterval(interval);
      resetAudioUI();
    }
  }, 100);
}

function openDetailModal(bird) {
  currentSelectedBird = bird;
  currentPhotoIdx = 0;

  const modal = document.getElementById("modal-detalle-ave");
  const commonNameEl = document.getElementById("modal-common-name");
  const scientificNameEl = document.getElementById("modal-scientific-name");
  const statusBadgeEl = document.getElementById("modal-status-badge");
  const descriptionEl = document.getElementById("modal-description");
  const physicalEl = document.getElementById("modal-physical");
  const habitatTextEl = document.getElementById("modal-habitat-text") || document.getElementById("modal-habitat");
  const dietTextEl = document.getElementById("modal-diet-text") || document.getElementById("modal-diet");
  const behaviorTextEl = document.getElementById("modal-behavior-text") || document.getElementById("modal-behavior");
  const distributionTextEl = document.getElementById("modal-distribution-text") || document.getElementById("modal-distribution");
  const videoLabelEl = document.getElementById("modal-video-label");

  // Ubicación
  const locEl = document.getElementById("modal-sighting-loc") || document.getElementById("modal-sighting-location");
  const dateEl = document.getElementById("modal-sighting-date");
  const notesEl = document.getElementById("modal-sighting-notes");
  const coordsEl = document.getElementById("modal-sighting-coords");
  const elevationEl = document.getElementById("modal-sighting-elevation");

  if (!modal) return;

  if (commonNameEl) commonNameEl.textContent = bird.commonName || "";
  if (scientificNameEl) scientificNameEl.textContent = `${bird.scientificName} • Familia: ${bird.family}`;
  if (statusBadgeEl) statusBadgeEl.textContent = bird.status || "";
  if (descriptionEl) descriptionEl.textContent = bird.description || "";
  if (physicalEl) physicalEl.textContent = bird.physicalCharacteristics || "";
  if (habitatTextEl) habitatTextEl.textContent = bird.habitatLabel || bird.habitat || "";
  if (dietTextEl) dietTextEl.textContent = bird.diet || "";
  if (behaviorTextEl) behaviorTextEl.textContent = bird.behavior || "";
  if (distributionTextEl) distributionTextEl.textContent = bird.distribution || "";

  if (videoLabelEl && bird.multimedia) {
    videoLabelEl.textContent = bird.multimedia.videoPlaceholder || "[PLACEHOLDER DE VIDEO]";
  }

  if (bird.sighting) {
    if (locEl) locEl.textContent = bird.sighting.locationName || "";
    if (dateEl) dateEl.textContent = bird.sighting.date || "";
    if (notesEl) notesEl.textContent = bird.sighting.notes || "";
    if (coordsEl) {
      coordsEl.textContent = Array.isArray(bird.sighting.coords)
        ? `Coordenadas: ${bird.sighting.coords[0].toFixed(4)}° N, ${bird.sighting.coords[1].toFixed(4)}° W`
        : "Coordenadas: No documentado";
    }
    if (elevationEl) elevationEl.textContent = `Altitud: ${bird.sighting.elevation || ""}`;
  }

  if (modalAudioEl) {
    modalAudioEl.src = bird.multimedia.audioLocal
      ? speciesMediaUrl(bird.multimedia.audioSample)
      : bird.multimedia.audioSample;
    resetAudioUI();
  }

  updatePhotoView();
  renderSpeciesVideos(bird);

  modal.classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
}

function checkUrlParams() {
  const params = new URLSearchParams(window.location.search);
  const birdId = params.get("bird");
  if (birdId) {
    const bird = BIOAVES_DATA.find((b) => b.id === birdId);
    if (bird) {
      setTimeout(() => openDetailModal(bird), 250);
    }
  }
}
