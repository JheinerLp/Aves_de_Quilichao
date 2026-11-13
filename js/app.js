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
 * app.js - BioAves Quilichao (Página Principal: index.html)
 * Lógica de interacción frontend para Prototipo de Baja Fidelidad.
 * - Navegación a catalogo.html para el catálogo completo.
 * - Carrusel con detección de tarjeta central activa y borde doble gris.
 * - Mapa interactivo con panel sincronizado de avistamientos.
 * - Modal detallado de especie con 3 fotos pasables y reproductor de audio.
 */

document.addEventListener("DOMContentLoaded", () => {
  initNavbar();
  initCarousel();
  initDetailModal();
  initMap();
});

/* ==========================================================================
   1. NAVBAR — NAVEGACIÓN Y MENÚ MÓVIL
   ========================================================================== */
function initNavbar() {
  const navbar = document.getElementById("main-navbar");
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 30) {
      navbar.classList.add("bg-[#FFFFFF]", "shadow-sm");
      navbar.classList.remove("bg-[#FFFFFF]/90");
    } else {
      navbar.classList.remove("bg-[#FFFFFF]", "shadow-sm");
      navbar.classList.add("bg-[#FFFFFF]/90");
    }
  });

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });

    mobileMenu.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        mobileMenu.classList.add("hidden");
      });
    });
  }

  // Smooth scroll para anclas internas
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");
      if (targetId === "#") return;
      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        targetEl.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });
}

/* ==========================================================================
   2. CARRUSEL DE AVES DESTACADAS
   ========================================================================== */
function initCarousel() {
  const track = document.getElementById("carousel-track") || document.getElementById("carousel-track-container");
  const container = document.getElementById("carousel-container") || document.getElementById("carousel-outer");
  const prevBtn = document.getElementById("carousel-prev-btn");
  const nextBtn = document.getElementById("carousel-next-btn");
  const statusIndicator = document.getElementById("carousel-status-indicator");

  if (!track || !container) return;

  const demoBirds = (typeof BIOAVES_DATA !== "undefined" && Array.isArray(BIOAVES_DATA)) ? BIOAVES_DATA : [];
  if (demoBirds.length === 0) {
    console.warn("BIOAVES_DATA no está disponible para el carrusel.");
    return;
  }
  const cardsHtml = [...demoBirds, ...demoBirds, ...demoBirds]
    .map((bird, idx) => `
      <div class="carousel-card flex-shrink-0 w-64 sm:w-72 select-none cursor-pointer group" data-bird-id="${bird.id}" data-index="${idx}">
        <div class="bv-photo"><img src="${bird.image ? speciesMediaUrl(bird.image) : speciesMediaUrl('img/aves/' + bird.id + '.jpg')}" alt="${bird.commonName}" loading="lazy" style="object-fit:${bird.imageFit || "cover"};object-position:${bird.imagePosition || "center"}" onerror="this.remove()"><h3 class="bv-ribbon">${bird.commonName}</h3></div>
        <div class="bv-card-body">
          <span class="bv-badge">${bird.categoryLabel}</span>
          <p>${bird.scientificName}</p>
          <button type="button" class="bv-btn bv-btn-dark open-species-btn" data-bird-id="${bird.id}">Conocer especie →</button>
        </div>
      </div>
    `)
    .join("");

  track.innerHTML = cardsHtml;

  let isPaused = false;
  const scrollSpeed = 0.8;
  let animFrameId = null;

  setTimeout(() => {
    container.scrollLeft = track.scrollWidth / 3;
    updateCenterCard();
  }, 100);

  function updateCenterCard() {
    const containerRect = container.getBoundingClientRect();
    const containerCenter = containerRect.left + containerRect.width / 2;

    const cards = track.querySelectorAll(".carousel-card");
    let closestCard = null;
    let minDistance = Infinity;

    cards.forEach((card) => {
      const cardRect = card.getBoundingClientRect();
      const cardCenter = cardRect.left + cardRect.width / 2;
      const dist = Math.abs(containerCenter - cardCenter);
      if (dist < minDistance) {
        minDistance = dist;
        closestCard = card;
      }
    });

    cards.forEach((card) => {
      if (card === closestCard && minDistance < 160) {
        card.classList.add("is-center-active");
      } else {
        card.classList.remove("is-center-active");
      }
    });

    const oneThird = track.scrollWidth / 3;
    if (container.scrollLeft >= oneThird * 2) {
      container.scrollLeft -= oneThird;
    } else if (container.scrollLeft <= 5) {
      container.scrollLeft += oneThird;
    }
  }

  function autoScroll() {
    if (!isPaused) {
      container.scrollLeft += scrollSpeed;
      updateCenterCard();
    }
    animFrameId = requestAnimationFrame(autoScroll);
  }

  animFrameId = requestAnimationFrame(autoScroll);

  container.addEventListener("mouseenter", () => {
    isPaused = true;
    if (statusIndicator) statusIndicator.textContent = "Pausado (Hover)";
  });

  container.addEventListener("mouseleave", () => {
    isPaused = false;
    if (statusIndicator) statusIndicator.textContent = "Auto-Desplazamiento Activo";
  });

  container.addEventListener("scroll", () => {
    updateCenterCard();
  }, { passive: true });

  if (prevBtn) {
    prevBtn.addEventListener("click", () => {
      container.scrollBy({ left: -300, behavior: "smooth" });
      setTimeout(updateCenterCard, 350);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      container.scrollBy({ left: 300, behavior: "smooth" });
      setTimeout(updateCenterCard, 350);
    });
  }

  track.addEventListener("click", (e) => {
    const target = e.target.closest("[data-bird-id]");
    if (!target) return;
    const birdId = target.dataset.birdId;
    const bird = BIOAVES_DATA.find((b) => b.id === birdId);
    if (bird) {
      openDetailModal(bird);
    }
  });
}

/* ==========================================================================
   3. FICHA DETALLADA DE CADA AVE (MODAL MULTI-BLOQUE A, B, C, D, E)
   ========================================================================== */
let activeBirdForModal = null;
let currentModalPhotoIdx = 0;
let modalAudio = null;
let audioContext = null;

function playSyntheticChirp() {
  try {
    const AudioCtx = window.AudioContext || window.webkitAudioContext;
    if (!audioContext) audioContext = new AudioCtx();
    if (audioContext.state === "suspended") audioContext.resume();

    const now = audioContext.currentTime;
    [0, 0.2, 0.4].forEach((offset, idx) => {
      const osc = audioContext.createOscillator();
      const gain = audioContext.createGain();
      osc.type = "sine";
      osc.frequency.setValueAtTime(2600 + idx * 200, now + offset);
      osc.frequency.exponentialRampToValueAtTime(3600, now + offset + 0.12);

      gain.gain.setValueAtTime(0.001, now + offset);
      gain.gain.linearRampToValueAtTime(0.18, now + offset + 0.03);
      gain.gain.exponentialRampToValueAtTime(0.001, now + offset + 0.16);

      osc.connect(gain);
      gain.connect(audioContext.destination);

      osc.start(now + offset);
      osc.stop(now + offset + 0.17);
    });
  } catch (err) {
    console.warn("Sintetizador Web Audio no disponible:", err);
  }
}

function initDetailModal() {
  const modal = document.getElementById("modal-detalle-ave");
  const closeBtn = document.getElementById("modal-close-btn");
  const prevPhotoBtn = document.getElementById("modal-photo-prev");
  const nextPhotoBtn = document.getElementById("modal-photo-next");
  const audioBtn = document.getElementById("modal-audio-toggle-btn");
  const goToMapBtn = document.getElementById("modal-go-to-map-btn");
  modalAudio = document.getElementById("modal-species-audio");

  if (!modal) return;

  function closeModal() {
    modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    if (modalAudio && !modalAudio.paused) {
      modalAudio.pause();
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
      if (!activeBirdForModal) return;
      const total = activeBirdForModal.multimedia.photos.length;
      currentModalPhotoIdx = (currentModalPhotoIdx - 1 + total) % total;
      updateModalPhoto();
    });
  }

  if (nextPhotoBtn) {
    nextPhotoBtn.addEventListener("click", () => {
      if (!activeBirdForModal) return;
      const total = activeBirdForModal.multimedia.photos.length;
      currentModalPhotoIdx = (currentModalPhotoIdx + 1) % total;
      updateModalPhoto();
    });
  }

  if (audioBtn && modalAudio) {
    audioBtn.addEventListener("click", () => {
      const btnIcon = document.getElementById("audio-btn-icon");
      const btnText = document.getElementById("audio-btn-text");
      const stateText = document.getElementById("audio-state-text");

      if (!modalAudio.paused) {
        modalAudio.pause();
        btnIcon.textContent = "▶";
        btnText.textContent = "Reanudar Canto";
        stateText.textContent = "Audio pausado por el usuario";
      } else {
        const playPromise = modalAudio.play();
        if (playPromise !== undefined) {
          playPromise
            .then(() => {
              btnIcon.textContent = "⏸";
              btnText.textContent = "Pausar Canto";
              stateText.textContent = "Reproduciendo canto representativo...";
            })
            .catch(() => {
              playSyntheticChirp();
              simulatePlayback();
            });
        }
      }
    });

    modalAudio.ontimeupdate = () => {
      const progressBar = document.getElementById("audio-progress-bar");
      const durationDisplay = document.getElementById("audio-duration-display");
      if (modalAudio.duration && progressBar) {
        const pct = (modalAudio.currentTime / modalAudio.duration) * 100;
        progressBar.style.width = `${pct}%`;
        const mins = Math.floor(modalAudio.currentTime / 60);
        const secs = Math.floor(modalAudio.currentTime % 60);
        durationDisplay.textContent = `${mins}:${secs < 10 ? '0' : ''}${secs} / ${activeBirdForModal ? activeBirdForModal.multimedia.audioDuration : '0:28'}`;
      }
    };

    modalAudio.onended = () => {
      resetAudioUI();
    };
  }

  if (goToMapBtn) {
    goToMapBtn.addEventListener("click", () => {
      const birdToLocate = activeBirdForModal;
      closeModal();
      const mapSection = document.getElementById("mapa");
      if (mapSection) {
        mapSection.scrollIntoView({ behavior: "smooth" });
        setTimeout(() => {
          if (window.leafletMapInstance && birdToLocate && birdToLocate.sighting) {
            window.leafletMapInstance.flyTo(birdToLocate.sighting.coords, 15, { duration: 1.2 });
            if (window.markersMapById && window.markersMapById[birdToLocate.id]) {
              window.markersMapById[birdToLocate.id].openPopup();
            }
          }
        }, 500);
      }
    });
  }
}

function updateModalPhoto() {
  if (!activeBirdForModal) return;
  const photo = activeBirdForModal.multimedia.photos[currentModalPhotoIdx];
  const total = activeBirdForModal.multimedia.photos.length;

  const photoLabel = document.getElementById("modal-photo-label");
  const placeholderNote = document.getElementById("modal-photo-placeholder-note");
  const photoIndicator = document.getElementById("modal-photo-indicator");
  const dots = document.querySelectorAll(".photo-dot-indicator");

  const photoImage = document.getElementById("modal-photo-image");
  if (photoImage) {
    photoImage.classList.toggle("hidden", !photo.src);
    if (photo.src) {
      photoImage.src = speciesMediaUrl(photo.src);
      photoImage.alt = `${activeBirdForModal.commonName}: ${photo.label}`;
      photoImage.style.objectFit = "contain";
      photoImage.style.objectPosition = "center";
    } else {
      photoImage.removeAttribute("src");
    }
  }
  if (photoLabel) {
    photoLabel.textContent = photo.label;
    photoLabel.classList.toggle("hidden", !!photo.src);
  }
  if (placeholderNote) placeholderNote.classList.toggle("hidden", !!photo.src);
  if (photoIndicator) photoIndicator.textContent = `Foto ${currentModalPhotoIdx + 1} de ${total}`;

  dots.forEach((dot, idx) => {
    if (idx === currentModalPhotoIdx) {
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
  if (durationDisplay) durationDisplay.textContent = `0:00 / ${activeBirdForModal ? activeBirdForModal.multimedia.audioDuration : '0:28'}`;
}

function simulatePlayback() {
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
  activeBirdForModal = bird;
  currentModalPhotoIdx = 0;

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
  const videoLabelEl = document.getElementById("modal-video-label");

  const locEl = document.getElementById("modal-sighting-loc");
  const dateEl = document.getElementById("modal-sighting-date");
  const notesEl = document.getElementById("modal-sighting-notes");
  const coordsEl = document.getElementById("modal-sighting-coords");
  const elevationEl = document.getElementById("modal-sighting-elevation");

  if (!modal) return;

  commonNameEl.textContent = bird.commonName;
  scientificNameEl.textContent = `${bird.scientificName} • Familia: ${bird.family}`;
  statusBadgeEl.textContent = bird.status;
  descriptionEl.textContent = bird.description;
  physicalEl.textContent = bird.physicalCharacteristics;
  habitatTextEl.textContent = bird.habitatLabel;
  dietTextEl.textContent = bird.diet;
  behaviorTextEl.textContent = bird.behavior;
  distributionTextEl.textContent = bird.distribution;

  videoLabelEl.textContent = bird.multimedia.videoPlaceholder;

  if (bird.sighting) {
    locEl.textContent = bird.sighting.locationName;
    dateEl.textContent = bird.sighting.date;
    notesEl.textContent = bird.sighting.notes;
    coordsEl.textContent = `Coordenadas: ${bird.sighting.coords[0].toFixed(4)}° N, ${bird.sighting.coords[1].toFixed(4)}° W`;
    elevationEl.textContent = `Altitud: ${bird.sighting.elevation}`;
  }

  if (modalAudio) {
    modalAudio.src = bird.multimedia.audioSample;
    resetAudioUI();
  }

  updateModalPhoto();

  modal.classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
}

/* ==========================================================================
   4. SECCIÓN MAPA DE AVISTAMIENTOS (LEAFLET EN ESCALA DE GRISES)
   ========================================================================== */
function initMap() {
  const mapEl = document.getElementById("leaflet-map-element");
  if (!mapEl || typeof L === "undefined") return;

  const centerQuilichao = [3.0094, -76.4847];
  const map = L.map("leaflet-map-element", {
    center: centerQuilichao,
    zoom: 13,
    zoomControl: false,
    scrollWheelZoom: false
  });

  window.leafletMapInstance = map;
  window.markersMapById = {};

  L.control.zoom({ position: "bottomright" }).addTo(map);

  L.tileLayer("https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png", {
    attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
    subdomains: "abcd",
    maxZoom: 18
  }).addTo(map);

  const markersGroup = L.featureGroup().addTo(map);
  const recordsContainer = document.getElementById("sighting-records-list");
  const speciesSelect = document.getElementById("map-filter-species");
  const zoneSelect = document.getElementById("map-filter-zone");
  const recordsCounter = document.getElementById("records-counter");

  if (speciesSelect) {
    BIOAVES_DATA.forEach((b) => {
      const opt = document.createElement("option");
      opt.value = b.id;
      opt.textContent = b.commonName;
      speciesSelect.appendChild(opt);
    });
  }

  function renderMapMarkers() {
    markersGroup.clearLayers();
    if (recordsContainer) recordsContainer.innerHTML = "";

    const selectedZone = zoneSelect ? zoneSelect.value : "all";
    const selectedSpecies = speciesSelect ? speciesSelect.value : "all";

    const filtered = BIOAVES_DATA.filter((bird) => {
      if (!bird.sighting) return false;
      const matchZone = selectedZone === "all" || bird.sighting.zone.toLowerCase().includes(selectedZone.toLowerCase());
      const matchSpecies = selectedSpecies === "all" || bird.id === selectedSpecies;
      return matchZone && matchSpecies;
    });

    if (recordsCounter) {
      recordsCounter.textContent = `${filtered.length} registro(s)`;
    }

    filtered.forEach((bird, idx) => {
      const pinIcon = L.divIcon({
        className: "wireframe-marker-container",
        html: `<div class="wireframe-marker-pin" title="${bird.commonName}">#${idx + 1}</div>`,
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -26]
      });

      const marker = L.marker(bird.sighting.coords, { icon: pinIcon });

      const popupHtml = `
        <div class="p-3 w-64 space-y-2 bg-[#FFFFFF] font-sans">
          <div class="h-20 wireframe-placeholder rounded-xs">
            <span class="text-[9px] font-bold">[PLACEHOLDER DE FOTOGRAFÍA]</span>
            <span class="text-[9px] text-[#777777]">${bird.commonName}</span>
          </div>
          <div>
            <h4 class="text-xs font-bold text-[#333333]">${bird.commonName}</h4>
            <p class="text-[10px] italic font-mono text-[#777777]">${bird.scientificName}</p>
          </div>
          <div class="text-[10px] space-y-0.5 border-t border-[#B0B0B0] pt-1 text-[#777777]">
            <p><strong class="text-[#333333]">Ubicación:</strong> ${bird.sighting.locationName}</p>
            <p><strong class="text-[#333333]">Fecha:</strong> ${bird.sighting.date}</p>
            <p><strong class="text-[#333333]">Descripción:</strong> ${bird.sighting.notes}</p>
          </div>
          <button onclick="document.dispatchEvent(new CustomEvent('open-bird-sheet', { detail: '${bird.id}' }))" class="btn-wireframe-primary w-full text-[10px] py-1 mt-1 text-center">
            Ver Ficha Completa →
          </button>
        </div>
      `;

      marker.bindPopup(popupHtml);
      markersGroup.addLayer(marker);
      window.markersMapById[bird.id] = marker;

      if (recordsContainer) {
        const item = document.createElement("div");
        item.className = "p-3 bg-[#FFFFFF] border border-[#B0B0B0] rounded-sm hover:border-[#333333] cursor-pointer transition-colors space-y-1";
        item.innerHTML = `
          <div class="flex items-center justify-between text-[10px] font-mono">
            <span class="font-bold text-[#333333]">#${idx + 1} ${bird.commonName}</span>
            <span class="text-[#777777]">${bird.sighting.elevation}</span>
          </div>
          <p class="text-[11px] font-mono text-[#777777] truncate">📍 ${bird.sighting.locationName}</p>
          <p class="text-[10px] text-[#777777]">${bird.sighting.date}</p>
        `;

        item.addEventListener("click", () => {
          map.flyTo(bird.sighting.coords, 15, { duration: 1.0 });
          marker.openPopup();
        });

        recordsContainer.appendChild(item);
      }
    });

    if (markersGroup.getLayers().length > 0) {
      map.fitBounds(markersGroup.getBounds().pad(0.15));
    }
  }

  if (zoneSelect) zoneSelect.addEventListener("change", renderMapMarkers);
  if (speciesSelect) speciesSelect.addEventListener("change", renderMapMarkers);

  renderMapMarkers();

  document.addEventListener("open-bird-sheet", (e) => {
    const birdId = e.detail;
    const bird = BIOAVES_DATA.find((b) => b.id === birdId);
    if (bird) openDetailModal(bird);
  });
}
