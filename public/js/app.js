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

function syncDatabaseWithBioavesData() {
  if (!Array.isArray(window.BIOAVES_DATA)) {
    window.BIOAVES_DATA = [];
  }

  if (Array.isArray(window.DB_SPECIES)) {
    window.DB_SPECIES.forEach((dbBird, index) => {
      const slug = dbBird.slug || String(dbBird.id);
      let existing = BIOAVES_DATA.find((b) => b.id === slug || String(b.id) === String(dbBird.id) || (b.commonName && b.commonName.toLowerCase() === (dbBird.common_name || "").toLowerCase()));

      let photoUrl = "img/aves/momoto-andino.png";
      if (dbBird.photos && dbBird.photos.length > 0) {
        const fp = dbBird.photos[0].file_path || "";
        photoUrl = fp.startsWith("http") || fp.startsWith("/") ? fp : (fp.startsWith("img/") ? fp : "storage/" + fp);
      } else if (existing && existing.image) {
        photoUrl = existing.image;
      }

      let sightingData = null;
      if (dbBird.approved_sightings && dbBird.approved_sightings.length > 0) {
        const s = dbBird.approved_sightings[0];
        sightingData = {
          locationName: s.location ? s.location.name : "Santander de Quilichao",
          coords: [parseFloat(s.latitude) || 3.0094, parseFloat(s.longitude) || -76.4847],
          zone: s.location ? (s.location.zone || "Zona Urbana y Ribereña") : "Zona Territorial",
          elevation: s.location && s.location.elevation_msnm ? `${s.location.elevation_msnm} msnm` : "1.060 msnm",
          date: s.sighting_date || "Registro reciente",
          notes: s.description || dbBird.description
        };
      } else if (Array.isArray(window.DB_SIGHTINGS)) {
        const s = window.DB_SIGHTINGS.find(st => st.species_id === dbBird.id);
        if (s) {
          sightingData = {
            locationName: s.location ? s.location.name : "Santander de Quilichao",
            coords: [parseFloat(s.latitude) || 3.0094, parseFloat(s.longitude) || -76.4847],
            zone: s.location ? (s.location.zone || "Zona Territorial") : "Zona Territorial",
            elevation: s.location && s.location.elevation_msnm ? `${s.location.elevation_msnm} msnm` : "1.060 msnm",
            date: s.sighting_date || "Registro reciente",
            notes: s.description || dbBird.description
          };
        }
      }

      // Si no tiene registro explícito, asignar un punto georreferenciado en Santander de Quilichao para que siempre aparezca en el mapa
      if (!sightingData) {
        if (existing && existing.sighting) {
          sightingData = existing.sighting;
        } else {
          const latOffset = ((index % 6) - 2.5) * 0.011 + (Math.sin(index + 1) * 0.004);
          const lngOffset = ((Math.floor(index / 6) % 6) - 2.5) * 0.011 + (Math.cos(index + 1) * 0.004);
          sightingData = {
            locationName: dbBird.habitat ? `Hábitat: ${dbBird.habitat.name}` : "Santander de Quilichao",
            coords: [3.0094 + latOffset, -76.4847 + lngOffset],
            zone: dbBird.habitat ? dbBird.habitat.name : "Territorio Municipal",
            elevation: "1.070 msnm",
            date: "Registro de catálogo",
            notes: dbBird.description || `Avistamiento registrado de ${dbBird.common_name}.`
          };
        }
      }

      if (existing) {
        existing.commonName = dbBird.common_name || existing.commonName;
        existing.scientificName = dbBird.scientific_name || existing.scientificName;
        existing.family = (dbBird.family ? dbBird.family.name : existing.family) || "Familia no especificada";
        existing.description = dbBird.description || existing.description;
        existing.physicalCharacteristics = dbBird.physical_characteristics || existing.physicalCharacteristics;
        existing.habitatLabel = (dbBird.habitat ? dbBird.habitat.name : existing.habitatLabel) || "Hábitat variado";
        existing.diet = dbBird.diet || existing.diet;
        existing.behavior = dbBird.behavior || existing.behavior;
        existing.distribution = dbBird.distribution || existing.distribution;
        existing.status = dbBird.uicn_status || existing.status;
        if (sightingData) existing.sighting = sightingData;
      } else {
        BIOAVES_DATA.push({
          id: slug,
          dbId: dbBird.id,
          image: photoUrl,
          imageFit: "cover",
          imagePosition: "center",
          commonName: dbBird.common_name,
          scientificName: dbBird.scientific_name,
          family: (dbBird.family ? dbBird.family.name : "Familia no especificada"),
          habitatType: (dbBird.habitat ? dbBird.habitat.slug : "general"),
          habitatLabel: (dbBird.habitat ? dbBird.habitat.name : "Territorio Quilichagüeño"),
          category: dbBird.category || "residente",
          status: dbBird.uicn_status || "Preocupación Menor (LC)",
          description: dbBird.description || "",
          physicalCharacteristics: dbBird.physical_characteristics || "Características no detalladas.",
          diet: dbBird.diet || "Dieta silvestre variada.",
          behavior: dbBird.behavior || "Comportamiento territorial.",
          distribution: dbBird.distribution || "Santander de Quilichao, Cauca.",
          multimedia: {
            photos: [
              { id: 1, src: photoUrl, label: `Fotografía de ${dbBird.common_name}` }
            ],
            videos: [],
            videoPlaceholder: `[REGISTRO DE VIDEO: ${dbBird.common_name.toUpperCase()}]`,
            audioSample: null
          },
          sighting: sightingData
        });
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  syncDatabaseWithBioavesData();
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
  document.querySelectorAll('#modal-video-panel video').forEach(video => video.pause());
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
  const photos = (activeBirdForModal.multimedia && activeBirdForModal.multimedia.photos && activeBirdForModal.multimedia.photos.length > 0)
    ? activeBirdForModal.multimedia.photos
    : (activeBirdForModal.image ? [{ src: activeBirdForModal.image, label: activeBirdForModal.commonName }] : [{ label: activeBirdForModal.commonName }]);
  const total = Math.max(1, photos.length);
  currentModalPhotoIdx = Math.max(0, Math.min(currentModalPhotoIdx, total - 1));
  const photo = photos[currentModalPhotoIdx] || { label: activeBirdForModal.commonName };

  const photoLabel = document.getElementById("modal-photo-label");
  const placeholderNote = document.getElementById("modal-photo-placeholder-note");
  const photoIndicator = document.getElementById("modal-photo-indicator");
  const dots = document.querySelectorAll(".photo-dot-indicator");

  const photoImage = document.getElementById("modal-photo-image");
  if (photoImage) {
    const src = photo.src ? speciesMediaUrl(photo.src) : (activeBirdForModal.image ? speciesMediaUrl(activeBirdForModal.image) : null);
    photoImage.classList.toggle("hidden", !src);
    if (src) {
      photoImage.src = src;
      photoImage.alt = `${activeBirdForModal.commonName || ""}: ${photo.label || ""}`;
      photoImage.style.objectFit = activeBirdForModal.imageFit || "cover";
      photoImage.style.objectPosition = activeBirdForModal.imagePosition || "center";
    } else {
      photoImage.removeAttribute("src");
    }
  }
  if (photoLabel) {
    photoLabel.textContent = photo.label || activeBirdForModal.commonName || "";
    photoLabel.classList.toggle("hidden", !!(photo.src || activeBirdForModal.image));
  }
  if (placeholderNote) placeholderNote.classList.toggle("hidden", !!(photo.src || activeBirdForModal.image));
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
  if (stateText) stateText.textContent = "Reproductor en espera";
  if (progressBar) progressBar.style.width = "0%";
  if (durationDisplay) {
    const duration = (activeBirdForModal && activeBirdForModal.multimedia && activeBirdForModal.multimedia.audioDuration)
      ? activeBirdForModal.multimedia.audioDuration
      : '0:28';
    durationDisplay.textContent = `0:00 / ${duration}`;
  }
}

function simulatePlayback() {
  const btnIcon = document.getElementById("audio-btn-icon");
  const btnText = document.getElementById("audio-btn-text");
  const stateText = document.getElementById("audio-state-text");
  const progressBar = document.getElementById("audio-progress-bar");

  if (btnIcon) btnIcon.textContent = "⏸";
  if (btnText) btnText.textContent = "Pausar Canto";
  if (stateText) stateText.textContent = "Reproduciendo canto sintetizado [Demostración]...";

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
  if (!bird) return;
  activeBirdForModal = bird;
  currentModalPhotoIdx = 0;

  const modal = document.getElementById("modal-detalle-ave");
  if (!modal) return;

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

  const locEl = document.getElementById("modal-sighting-loc") || document.getElementById("modal-sighting-location");
  const dateEl = document.getElementById("modal-sighting-date");
  const notesEl = document.getElementById("modal-sighting-notes");
  const coordsEl = document.getElementById("modal-sighting-coords");
  const elevationEl = document.getElementById("modal-sighting-elevation");

  if (commonNameEl) commonNameEl.textContent = bird.commonName || "";
  if (scientificNameEl) scientificNameEl.textContent = `${bird.scientificName || ""} • Familia: ${bird.family || ""}`;
  if (statusBadgeEl) statusBadgeEl.textContent = bird.status || "";
  if (descriptionEl) descriptionEl.textContent = bird.description || "";
  if (physicalEl) physicalEl.textContent = bird.physicalCharacteristics || "";
  if (habitatTextEl) habitatTextEl.textContent = bird.habitatLabel || bird.habitat || "";
  if (dietTextEl) dietTextEl.textContent = bird.diet || "";
  if (behaviorTextEl) behaviorTextEl.textContent = bird.behavior || "";
  if (distributionTextEl) distributionTextEl.textContent = bird.distribution || "";

  if (videoLabelEl) {
    videoLabelEl.textContent = (bird.multimedia && bird.multimedia.videoPlaceholder)
      ? bird.multimedia.videoPlaceholder
      : `Registro en video de ${bird.commonName || "la especie"}`;
  }

  if (bird.sighting) {
    if (locEl) locEl.textContent = bird.sighting.locationName || "Santander de Quilichao";
    if (dateEl) dateEl.textContent = bird.sighting.date || "Registro reciente";
    if (notesEl) notesEl.textContent = bird.sighting.notes || bird.description || "";
    if (coordsEl && Array.isArray(bird.sighting.coords)) {
      coordsEl.textContent = `Coordenadas: ${bird.sighting.coords[0].toFixed(4)}° N, ${bird.sighting.coords[1].toFixed(4)}° W`;
    }
    if (elevationEl) elevationEl.textContent = `Altitud: ${bird.sighting.elevation || "1.060 msnm"}`;
  } else {
    if (locEl) locEl.textContent = "Santander de Quilichao";
    if (dateEl) dateEl.textContent = "Registro de catálogo";
    if (notesEl) notesEl.textContent = bird.description || "";
    if (coordsEl) coordsEl.textContent = "Coordenadas: 3.0094° N, 76.4847° W";
    if (elevationEl) elevationEl.textContent = "Altitud: 1.060 msnm";
  }

  if (modalAudio) {
    if (bird.multimedia && bird.multimedia.audioSample) {
      modalAudio.src = bird.multimedia.audioLocal
        ? speciesMediaUrl(bird.multimedia.audioSample)
        : bird.multimedia.audioSample;
    } else {
      modalAudio.removeAttribute("src");
    }
    resetAudioUI();
  }

  updateModalPhoto();
  renderSpeciesVideos(bird);

  modal.classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
}

/* ==========================================================================
   4. SECCIÓN MAPA DE AVISTAMIENTOS (LEAFLET INTERACTIVO)
   ========================================================================== */
function initMap() {
  const mapEl = document.getElementById("leaflet-map-element") || document.getElementById("map-container");
  if (!mapEl || typeof L === "undefined") return;

  const centerQuilichao = [3.0094, -76.4847];
  const map = L.map(mapEl, {
    center: centerQuilichao,
    zoom: 13,
    zoomControl: false,
    scrollWheelZoom: true
  });

  window.leafletMapInstance = map;
  window.markersMapById = {};
  let currentSelectedBird = null;

  L.control.zoom({ position: "bottomright" }).addTo(map);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors',
    maxZoom: 19
  }).addTo(map);

  const markersGroup = L.featureGroup().addTo(map);
  const recordsContainer = document.getElementById("sighting-records-list");
  const speciesSelect = document.getElementById("map-filter-species");
  const zoneSelect = document.getElementById("map-filter-zone");
  const recordsCounter = document.getElementById("records-counter");
  const resetBtn = document.getElementById("map-reset-btn");
  const viewBtn = document.getElementById("map-point-view-btn");

  if (resetBtn) {
    resetBtn.addEventListener("click", () => {
      map.flyTo(centerQuilichao, 13, { duration: 1.0 });
    });
  }

  if (viewBtn) {
    viewBtn.addEventListener("click", () => {
      if (currentSelectedBird) {
        openDetailModal(currentSelectedBird);
      }
    });
  }

  if (speciesSelect) {
    speciesSelect.innerHTML = '<option value="all">Todas las especies</option>';
    BIOAVES_DATA.forEach((b) => {
      const opt = document.createElement("option");
      opt.value = b.id;
      opt.textContent = b.commonName;
      speciesSelect.appendChild(opt);
    });
  }

  function updateSidePanel(bird, idx, total) {
    if (!bird || !bird.sighting) return;
    currentSelectedBird = bird;

    const counterEl = document.getElementById("map-point-counter");
    if (counterEl) counterEl.textContent = `${idx + 1} / ${total}`;

    const imgEl = document.getElementById("map-point-img");
    if (imgEl) {
      imgEl.src = speciesMediaUrl(bird.image);
      imgEl.alt = bird.commonName;
    }

    const zoneEl = document.getElementById("map-point-zone");
    if (zoneEl) zoneEl.textContent = bird.sighting.zone;

    const nameEl = document.getElementById("map-point-bird-name");
    if (nameEl) nameEl.textContent = bird.commonName;

    const sciEl = document.getElementById("map-point-scientific");
    if (sciEl) sciEl.textContent = bird.scientificName;

    const locEl = document.getElementById("map-point-location");
    if (locEl) locEl.textContent = bird.sighting.locationName;

    const coordsEl = document.getElementById("map-point-coords");
    if (coordsEl) coordsEl.textContent = `${bird.sighting.coords[0].toFixed(4)}, ${bird.sighting.coords[1].toFixed(4)}`;

    const elevEl = document.getElementById("map-point-elevation");
    if (elevEl) elevEl.textContent = bird.sighting.elevation;

    const dateEl = document.getElementById("map-point-date");
    if (dateEl) dateEl.textContent = bird.sighting.date;

    const notesEl = document.getElementById("map-point-notes");
    if (notesEl) notesEl.textContent = bird.sighting.notes;
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
      recordsCounter.textContent = `${filtered.length} registro(s) activo(s)`;
    }

    filtered.forEach((bird, idx) => {
      const pinIcon = L.divIcon({
        className: "wireframe-marker-container",
        html: `<div class="wireframe-marker-pin" id="pin-${bird.id}" title="${bird.commonName}" style="display:flex;align-items:center;justify-content:center;background:#2e9b3a;color:#fff;font-weight:bold;font-size:10px;width:24px;height:24px;border:2px solid #fff;border-radius:50%;box-shadow:0 2px 6px rgba(0,0,0,0.35);cursor:pointer;">${idx + 1}</div>`,
        iconSize: [24, 24],
        iconAnchor: [12, 24],
        popupAnchor: [0, -24]
      });

      const marker = L.marker(bird.sighting.coords, { icon: pinIcon });

      const popupHtml = `
        <div style="width:220px;font-family:sans-serif;padding:4px;">
          <img src="${speciesMediaUrl(bird.image)}" alt="${bird.commonName}" style="width:100%;height:100px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
          <h4 style="margin:0 0 2px;font-size:13px;font-weight:bold;color:#222;">#${idx + 1} ${bird.commonName}</h4>
          <p style="margin:0 0 6px;font-size:11px;font-style:italic;color:#666;">${bird.scientificName}</p>
          <div style="font-size:11px;color:#444;border-top:1px solid #ddd;padding-top:6px;margin-bottom:8px;">
            <p style="margin:2px 0;"><strong>📍 Lugar:</strong> ${bird.sighting.locationName}</p>
            <p style="margin:2px 0;"><strong>🏔️ Elevación:</strong> ${bird.sighting.elevation}</p>
            <p style="margin:2px 0;"><strong>📅 Fecha:</strong> ${bird.sighting.date}</p>
          </div>
          <button onclick="document.dispatchEvent(new CustomEvent('open-bird-sheet', { detail: '${bird.id}' }))" style="width:100%;background:#2e9b3a;color:#fff;border:none;padding:6px 10px;border-radius:4px;font-weight:bold;font-size:11px;cursor:pointer;">
            Ver Ficha Completa →
          </button>
        </div>
      `;

      marker.bindPopup(popupHtml);

      marker.on("click", () => {
        updateSidePanel(bird, idx, filtered.length);
        document.querySelectorAll(".wireframe-marker-pin").forEach(p => p.style.background = "#2e9b3a");
        const pinEl = document.getElementById(`pin-${bird.id}`);
        if (pinEl) pinEl.style.background = "#d97706";
      });

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
          updateSidePanel(bird, idx, filtered.length);
        });

        recordsContainer.appendChild(item);
      }
    });

    if (filtered.length > 0) {
      updateSidePanel(filtered[0], 0, filtered.length);
      map.fitBounds(markersGroup.getBounds().pad(0.15));
    }
  }

  if (zoneSelect) zoneSelect.addEventListener("change", renderMapMarkers);
  if (speciesSelect) speciesSelect.addEventListener("change", renderMapMarkers);

  renderMapMarkers();

  // Asegurar que Leaflet calcule correctamente las dimensiones al cargar y al redimensionar
  setTimeout(() => map.invalidateSize(), 300);
  setTimeout(() => map.invalidateSize(), 800);
  window.addEventListener("resize", () => map.invalidateSize());

  document.addEventListener("open-bird-sheet", (e) => {
    const birdId = e.detail;
    const bird = BIOAVES_DATA.find((b) => b.id === birdId);
    if (bird) openDetailModal(bird);
  });
}
