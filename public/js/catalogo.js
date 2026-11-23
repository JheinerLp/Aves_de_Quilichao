/**
 * catalogo.js - BioAves Quilichao
 * Lógica de la página de Catálogo: búsqueda, filtros por hábitat y categoría,
 * ordenamiento y ficha (ventana emergente) de cada especie.
 */

/* ------------------------------------------------------------------
   Funciones de apoyo
   ------------------------------------------------------------------ */

function speciesMediaUrl(path) {
  const prefix = window.location.pathname.endsWith(".html") ? "public/" : "/";
  return prefix + path.split("/").map(encodeURIComponent).join("/");
}

// Estado de conservación según la UICN (Unión Internacional para la
// Conservación de la Naturaleza), siempre en palabras en español.
const ESTADOS_UICN = {
  LC: "Preocupación menor",
  NT: "Casi amenazada",
  VU: "Vulnerable",
  EN: "En peligro",
  CR: "En peligro crítico",
  DD: "Datos insuficientes",
  NE: "No evaluada",
};

function uicnLabel(status = "") {
  const m = status.match(/\(([A-Z]{2})\)/);
  const code = m ? m[1] : "NE";
  return ESTADOS_UICN[code] || "No evaluada";
}

// Solo fotos que existen de verdad. Si no hay, usa la imagen principal.
function realPhotos(bird) {
  const ph = (bird.multimedia?.photos || []).filter((p) => p.src);
  if (ph.length) return ph;
  return bird.image ? [{ src: bird.image, label: bird.commonName }] : [];
}

// Convierte segundos a m:ss
function formatTime(seconds) {
  if (!isFinite(seconds)) return "0:00";
  const m = Math.floor(seconds / 60);
  const s = Math.floor(seconds % 60);
  return `${m}:${s < 10 ? "0" : ""}${s}`;
}

// Altitud en palabras, sin la abreviatura "msnm"
function elevationText(value) {
  if (!value) return "Altitud: sin dato";
  return `Altitud: ${String(value).replace(/msnm/gi, "metros sobre el nivel del mar")}`;
}

// Videos: si la especie no tiene, el panel se oculta
function renderSpeciesVideos(bird) {
  const panel = document.getElementById("modal-video-panel");
  if (!panel) return;
  const videos = bird.multimedia?.videos || [];
  panel.classList.toggle("hidden", !videos.length);
  if (!videos.length) {
    panel.innerHTML = "";
    return;
  }
  panel.innerHTML = videos.map(video => `
    <div class="media-video-card relative w-full bg-black">
      <span class="media-caption">${video.label}</span>
      <video controls preload="metadata" playsinline class="media-video w-full aspect-video object-cover bg-black" src="${speciesMediaUrl(video.src)}" aria-label="${video.label} de ${bird.commonName}"></video>
    </div>`).join("");
}

/* ------------------------------------------------------------------
   Arranque
   ------------------------------------------------------------------ */

document.addEventListener("DOMContentLoaded", () => {
  initCatalogPage();
  initDetailModal();
  checkUrlParams();
});

let currentSelectedBird = null;
let currentPhotoIdx = 0;
let modalAudioEl = null;

/* ------------------------------------------------------------------
   Cuadrícula del catálogo
   ------------------------------------------------------------------ */

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
          <p class="text-sm text-[#555555]">Prueba limpiando los filtros o escribiendo otro término de búsqueda.</p>
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
              ${bird.image ? `<img src="${speciesMediaUrl(bird.image)}" alt="${bird.commonName}" loading="lazy" class="w-full h-full" style="object-fit:${bird.imageFit || "cover"};object-position:${bird.imagePosition && bird.imagePosition !== "center" ? bird.imagePosition : "center 35%"}">` : `
                <span class="text-sm font-bold text-[#333333]">Fotografía no disponible</span>`}
            </div>

            <div class="space-y-1">
              <span class="inline-block text-xs px-2 py-0.5 bg-[#F2F2F2] border border-[#B0B0B0] text-[#333333]">
                ${bird.family} • ${uicnLabel(bird.status)}
              </span>
              <h3 class="text-base font-bold text-[#333333]">
                ${bird.commonName}
              </h3>
              <p class="text-xs italic font-mono text-[#555555]">
                ${bird.scientificName}
              </p>
              <div class="pt-2 text-xs text-[#555555]">
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

/* ------------------------------------------------------------------
   Ficha de la especie (ventana emergente)
   ------------------------------------------------------------------ */

function initDetailModal() {
  const modal = document.getElementById("modal-detalle-ave");
  const closeBtn = document.getElementById("modal-close-btn");
  const footerCloseBtn = document.getElementById("modal-footer-close");
  const prevPhotoBtn = document.getElementById("modal-photo-prev");
  const nextPhotoBtn = document.getElementById("modal-photo-next");
  const audioBtn = document.getElementById("modal-audio-toggle-btn");
  modalAudioEl = document.getElementById("modal-species-audio");

  if (!modal) return;

  function closeModal() {
    document.querySelectorAll("#modal-video-panel video").forEach((video) => video.pause());
    modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    if (modalAudioEl && !modalAudioEl.paused) {
      modalAudioEl.pause();
    }
    resetAudioUI();
  }

  if (closeBtn) closeBtn.addEventListener("click", closeModal);
  if (footerCloseBtn) footerCloseBtn.addEventListener("click", closeModal);

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
      const total = realPhotos(currentSelectedBird).length;
      if (total <= 1) return;
      currentPhotoIdx = (currentPhotoIdx - 1 + total) % total;
      updatePhotoView();
    });
  }

  if (nextPhotoBtn) {
    nextPhotoBtn.addEventListener("click", () => {
      if (!currentSelectedBird) return;
      const total = realPhotos(currentSelectedBird).length;
      if (total <= 1) return;
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
        stateText.textContent = "Audio pausado";
      } else {
        const playPromise = modalAudioEl.play();
        if (playPromise !== undefined) {
          playPromise
            .then(() => {
              btnIcon.textContent = "⏸";
              btnText.textContent = "Pausar Canto";
              stateText.textContent = "Reproduciendo canto...";
            })
            .catch(() => {
              stateText.textContent = "No se pudo reproducir el audio";
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
        if (durationDisplay) {
          durationDisplay.textContent = `${formatTime(modalAudioEl.currentTime)} / ${formatTime(modalAudioEl.duration)}`;
        }
      }
    };

    modalAudioEl.onended = () => {
      resetAudioUI();
    };
  }
}

function updatePhotoView() {
  if (!currentSelectedBird) return;
  const photos = realPhotos(currentSelectedBird);
  const total = photos.length;
  currentPhotoIdx = Math.min(currentPhotoIdx, Math.max(total - 1, 0));
  const photo = photos[currentPhotoIdx];

  const img = document.getElementById("modal-photo-image");
  const fallback = document.getElementById("modal-photo-fallback-box");
  const caption = document.getElementById("modal-photo-caption");
  const nav = document.getElementById("modal-photo-nav");
  const dots = document.getElementById("modal-photo-dots");
  const indicator = document.getElementById("modal-photo-indicator");

  if (img) {
    img.classList.toggle("hidden", !photo);
    if (photo) {
      img.src = speciesMediaUrl(photo.src);
      img.alt = `${currentSelectedBird.commonName}: ${photo.label}`;
    } else {
      img.removeAttribute("src");
    }
  }
  if (fallback) fallback.classList.toggle("hidden", !!photo);
  if (caption) {
    caption.textContent = photo ? photo.label : "";
    caption.classList.toggle("hidden", !photo);
  }

  // Con una sola foto se ocultan flechas, puntos e indicador
  const multi = total > 1;
  if (nav) nav.classList.toggle("hidden", !multi);
  if (indicator) {
    indicator.classList.toggle("hidden", !multi);
    indicator.textContent = `Foto ${currentPhotoIdx + 1} de ${total}`;
  }
  if (dots) {
    dots.innerHTML = photos.map((_, i) =>
      `<span class="photo-dot-indicator ${i === currentPhotoIdx ? "w-3 h-3 bg-[#333333]" : "w-2.5 h-2.5 bg-[#B0B0B0]"} rounded-full inline-block"></span>`
    ).join("");
  }
}

function resetAudioUI() {
  const btnIcon = document.getElementById("audio-btn-icon");
  const btnText = document.getElementById("audio-btn-text");
  const stateText = document.getElementById("audio-state-text");
  const progressBar = document.getElementById("audio-progress-bar");
  const durationDisplay = document.getElementById("audio-duration-display");

  if (btnIcon) btnIcon.textContent = "▶";
  if (btnText) btnText.textContent = "Reproducir Canto";
  if (stateText) stateText.textContent = "Listo para reproducir";
  if (progressBar) progressBar.style.width = "0%";
  if (durationDisplay) durationDisplay.textContent = "0:00";
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
  const habitatTextEl = document.getElementById("modal-habitat-text");
  const dietTextEl = document.getElementById("modal-diet-text");
  const behaviorTextEl = document.getElementById("modal-behavior-text");
  const distributionTextEl = document.getElementById("modal-distribution-text");

  // Ubicación
  const locEl = document.getElementById("modal-sighting-loc");
  const dateEl = document.getElementById("modal-sighting-date");
  const notesEl = document.getElementById("modal-sighting-notes");
  const coordsEl = document.getElementById("modal-sighting-coords");
  const elevationEl = document.getElementById("modal-sighting-elevation");

  if (!modal) return;

  if (commonNameEl) commonNameEl.textContent = bird.commonName || "";
  if (scientificNameEl) scientificNameEl.textContent = `${bird.scientificName} • Familia: ${bird.family}`;
  if (statusBadgeEl) statusBadgeEl.textContent = uicnLabel(bird.status);
  if (descriptionEl) descriptionEl.textContent = bird.description || "";
  if (physicalEl) physicalEl.textContent = bird.physicalCharacteristics || "";
  if (habitatTextEl) habitatTextEl.textContent = bird.habitatLabel || bird.habitat || "";
  if (dietTextEl) dietTextEl.textContent = bird.diet || "";
  if (behaviorTextEl) behaviorTextEl.textContent = bird.behavior || "";
  if (distributionTextEl) distributionTextEl.textContent = bird.distribution || "";

  if (bird.sighting) {
    if (locEl) locEl.textContent = bird.sighting.locationName || "";
    if (dateEl) dateEl.textContent = bird.sighting.date || "";
    if (notesEl) notesEl.textContent = bird.sighting.notes || "";
    if (coordsEl) {
      coordsEl.textContent = Array.isArray(bird.sighting.coords)
        ? `Latitud ${bird.sighting.coords[0].toFixed(4)}°, longitud ${bird.sighting.coords[1].toFixed(4)}°`
        : "Coordenadas: sin dato";
    }
    if (elevationEl) elevationEl.textContent = elevationText(bird.sighting.elevation);
  } else {
    // Sin registro documentado: se limpia lo que dejó la especie anterior
    if (locEl) locEl.textContent = "Sin registro documentado";
    if (dateEl) dateEl.textContent = "";
    if (notesEl) notesEl.textContent = "";
    if (coordsEl) coordsEl.textContent = "Coordenadas: sin dato";
    if (elevationEl) elevationEl.textContent = "Altitud: sin dato";
  }

  // Audio: si la especie no tiene sonido, se oculta el reproductor
  const hasAudio = !!bird.multimedia?.audioSample;
  document.getElementById("modal-audio-block")?.classList.toggle("hidden", !hasAudio);
  if (modalAudioEl) {
    if (hasAudio) {
      modalAudioEl.src = bird.multimedia.audioLocal
        ? speciesMediaUrl(bird.multimedia.audioSample)
        : bird.multimedia.audioSample;
    } else {
      modalAudioEl.removeAttribute("src");
    }
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