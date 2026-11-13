/**
 * routes-module.js - BioAves Quilichao
 * Lógica interactiva para el Módulo de Senderos y Rutas
 * Maneja la interacción entre las tarjetas de destinos y el mapa Leaflet.
 */

let routesMap = null;
let currentRoutePolyline = null;
let currentRoutePolylineBg = null;
let startMarker = null;
let endMarker = null;
let activeRouteId = null;

function initRoutesModule() {
  const mapEl = document.getElementById("routes-map-element");
  if (!mapEl || typeof L === "undefined") return;

  // Centro de referencia: Santander de Quilichao
  const centerQuilichao = [3.0094, -76.4847];

  routesMap = L.map("routes-map-element", {
    center: centerQuilichao,
    zoom: 13,
    zoomControl: false,
    scrollWheelZoom: true
  });

  L.control.zoom({ position: "bottomright" }).addTo(routesMap);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors',
    maxZoom: 19
  }).addTo(routesMap);

  // Botón para recentrar la ruta activa
  const fitBtn = document.getElementById("btn-fit-route");
  if (fitBtn) {
    fitBtn.addEventListener("click", () => {
      if (currentRoutePolyline) {
        routesMap.fitBounds(currentRoutePolyline.getBounds().pad(0.25));
      } else {
        routesMap.flyTo(centerQuilichao, 13, { duration: 1.0 });
      }
    });
  }

  // Vincular eventos a las tarjetas de ruta
  bindRouteCards();

  // Filtros de categoría de rutas
  bindRouteFilters();

  // Seleccionar la primera ruta por defecto al cargar
  if (Array.isArray(window.BIOAVES_ROUTES) && window.BIOAVES_ROUTES.length > 0) {
    selectRoute(window.BIOAVES_ROUTES[0].id, false);
  }

  // Recalcular tamaño de Leaflet para evitar tiles incompletos
  setTimeout(() => routesMap.invalidateSize(), 300);
  setTimeout(() => routesMap.invalidateSize(), 800);
  window.addEventListener("resize", () => routesMap.invalidateSize());
}

function bindRouteCards() {
  const cards = document.querySelectorAll(".route-card");
  cards.forEach((card) => {
    card.addEventListener("click", () => {
      const routeId = card.dataset.routeId;
      if (routeId) {
        selectRoute(routeId, true);
      }
    });
  });
}

function bindRouteFilters() {
  const filterBtns = document.querySelectorAll(".route-filter-btn");
  filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      filterBtns.forEach((b) => {
        b.classList.remove("bg-[#333333]", "text-[#FFFFFF]", "border-[#333333]");
        b.classList.add("bg-[#FFFFFF]", "text-[#777777]", "border-[#B0B0B0]");
      });
      btn.classList.add("bg-[#333333]", "text-[#FFFFFF]", "border-[#333333]");
      btn.classList.remove("bg-[#FFFFFF]", "text-[#777777]", "border-[#B0B0B0]");

      const filterType = btn.dataset.filter;
      const cards = document.querySelectorAll(".route-card");
      let firstVisible = null;

      cards.forEach((card) => {
        const routeType = card.dataset.routeType || "";
        const match = filterType === "all" || routeType.toLowerCase().includes(filterType.toLowerCase());
        card.style.display = match ? "flex" : "none";
        if (match && !firstVisible) {
          firstVisible = card.dataset.routeId;
        }
      });

      if (firstVisible && activeRouteId !== firstVisible) {
        selectRoute(firstVisible, false);
      }
    });
  });
}

function selectRoute(routeId, shouldScroll = false) {
  if (!Array.isArray(window.BIOAVES_ROUTES)) return;
  const route = window.BIOAVES_ROUTES.find((r) => r.id === routeId);
  if (!route) return;

  activeRouteId = route.id;

  // 1. Resaltar visualmente la tarjeta activa
  document.querySelectorAll(".route-card").forEach((c) => {
    if (c.dataset.routeId === route.id) {
      c.classList.add("border-[#333333]", "ring-2", "ring-[#333333]", "shadow-lg");
      c.classList.remove("border-[#B0B0B0]");
      const badge = c.querySelector(".active-route-indicator");
      if (badge) badge.classList.remove("hidden");
    } else {
      c.classList.remove("border-[#333333]", "ring-2", "ring-[#333333]", "shadow-lg");
      c.classList.add("border-[#B0B0B0]");
      const badge = c.querySelector(".active-route-indicator");
      if (badge) badge.classList.add("hidden");
    }
  });

  // 2. Actualizar el mapa
  if (routesMap) {
    // Remover capas previas
    if (currentRoutePolylineBg) routesMap.removeLayer(currentRoutePolylineBg);
    if (currentRoutePolyline) routesMap.removeLayer(currentRoutePolyline);
    if (startMarker) routesMap.removeLayer(startMarker);
    if (endMarker) routesMap.removeLayer(endMarker);

    // Íconos personalizados
    const startIcon = L.divIcon({
      className: "route-marker-container",
      html: `
        <div style="background:#2e9b3a;color:#fff;font-family:monospace;font-size:11px;font-weight:900;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #fff;box-shadow:0 3px 8px rgba(0,0,0,0.4);" title="Punto de Inicio">
          A
        </div>
      `,
      iconSize: [30, 30],
      iconAnchor: [15, 15]
    });

    const endIcon = L.divIcon({
      className: "route-marker-container",
      html: `
        <div style="background:#d97706;color:#fff;font-family:monospace;font-size:11px;font-weight:900;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #fff;box-shadow:0 3px 8px rgba(0,0,0,0.4);" title="Punto de Llegada">
          B
        </div>
      `,
      iconSize: [32, 32],
      iconAnchor: [16, 16]
    });

    // Marcador de inicio
    startMarker = L.marker(route.punto_inicio.coords, { icon: startIcon }).addTo(routesMap);
    startMarker.bindPopup(`
      <div style="padding:4px;font-family:sans-serif;font-size:12px;">
        <strong style="color:#2e9b3a;display:block;margin-bottom:2px;">🚩 PUNTO DE PARTIDA (A)</strong>
        <span>${route.punto_inicio.nombre}</span>
        <span style="display:block;font-size:10px;color:#777;font-family:monospace;margin-top:2px;">Santander de Quilichao, Cauca</span>
      </div>
    `);

    // Marcador de destino
    endMarker = L.marker([route.latitud, route.longitud], { icon: endIcon }).addTo(routesMap);
    endMarker.bindPopup(`
      <div style="width:220px;font-family:sans-serif;padding:4px;">
        <img src="${route.imagen}" alt="${route.nombre}" style="width:100%;height:100px;object-fit:cover;border-radius:4px;margin-bottom:6px;">
        <strong style="color:#d97706;display:block;font-size:10px;text-transform:uppercase;font-family:monospace;">📍 DESTINO NATURAL (B)</strong>
        <h4 style="margin:2px 0 4px;font-size:13px;font-weight:bold;color:#222;">${route.nombre}</h4>
        <div style="font-size:11px;color:#555;border-top:1px solid #eee;padding-top:4px;">
          <p style="margin:2px 0;"><strong>Distancia:</strong> ${route.distancia} · <strong>Tiempo:</strong> ${route.duracion}</p>
          <p style="margin:2px 0;"><strong>Dificultad:</strong> ${route.dificultad}</p>
        </div>
      </div>
    `);

    // Dibujar línea de la ruta
    currentRoutePolylineBg = L.polyline(route.coordenadas_ruta, {
      color: "#ffffff",
      weight: 8,
      opacity: 0.8,
      lineJoin: "round"
    }).addTo(routesMap);

    currentRoutePolyline = L.polyline(route.coordenadas_ruta, {
      color: "#2e9b3a",
      weight: 5,
      opacity: 0.95,
      lineJoin: "round",
      dashArray: null
    }).addTo(routesMap);

    // Centrar mapa ajustando a los límites del recorrido
    routesMap.fitBounds(currentRoutePolyline.getBounds().pad(0.25));

    // Abrir popup de destino tras breve pausa
    setTimeout(() => {
      endMarker.openPopup();
    }, 400);
  }

  // 3. Actualizar el panel de detalle lateral
  updateRouteDetailPanel(route);

  // 4. Si el usuario hizo clic explícito en móvil, hacer scroll suave al mapa
  if (shouldScroll && window.innerWidth < 1024) {
    const mapSection = document.getElementById("routes-map-container");
    if (mapSection) {
      mapSection.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  }
}

function updateRouteDetailPanel(route) {
  const titleEl = document.getElementById("route-panel-title");
  const typeEl = document.getElementById("route-panel-type");
  const diffEl = document.getElementById("route-panel-difficulty");
  const imgEl = document.getElementById("route-panel-img");
  const descEl = document.getElementById("route-panel-desc");
  const startEl = document.getElementById("route-panel-start");
  const endEl = document.getElementById("route-panel-end");
  const distEl = document.getElementById("route-panel-distance");
  const timeEl = document.getElementById("route-panel-duration");
  const elevEl = document.getElementById("route-panel-elevation");
  const notesEl = document.getElementById("route-panel-notes");
  const birdsListEl = document.getElementById("route-panel-birds");
  const gmapsLink = document.getElementById("route-gmaps-link");
  const activePill = document.getElementById("route-active-pill-name");

  if (activePill) activePill.textContent = route.nombre;
  if (titleEl) titleEl.textContent = route.nombre;
  if (typeEl) typeEl.textContent = route.tipo;
  if (diffEl) {
    diffEl.textContent = route.dificultad;
    diffEl.className = "px-2 py-0.5 rounded-sm font-mono text-[10px] font-bold uppercase border ";
    if (route.dificultad === "Fácil") {
      diffEl.className += "bg-[#FFFFFF] text-[#2e9b3a] border-[#2e9b3a]";
    } else if (route.dificultad === "Moderado") {
      diffEl.className += "bg-[#FFFFFF] text-[#d97706] border-[#d97706]";
    } else {
      diffEl.className += "bg-[#FFFFFF] text-[#dc2626] border-[#dc2626]";
    }
  }

  if (imgEl) {
    imgEl.src = route.imagen;
    imgEl.alt = route.nombre;
  }

  if (descEl) descEl.textContent = route.descripcion;
  if (startEl) startEl.textContent = route.punto_inicio.nombre;
  if (endEl) endEl.textContent = `${route.nombre} (${route.latitud.toFixed(4)}, ${route.longitud.toFixed(4)})`;
  if (distEl) distEl.textContent = route.distancia;
  if (timeEl) timeEl.textContent = route.duracion;
  if (elevEl) elevEl.textContent = route.desnivel;
  if (notesEl) notesEl.textContent = route.recomendaciones;

  if (birdsListEl) {
    birdsListEl.innerHTML = "";
    if (Array.isArray(route.aves_destacadas)) {
      route.aves_destacadas.forEach((birdName, idx) => {
        const birdId = (route.aves_ids && route.aves_ids[idx]) ? route.aves_ids[idx] : null;
        const tag = document.createElement("button");
        tag.type = "button";
        tag.className = "inline-flex items-center gap-1 px-2.5 py-1 bg-[#FFFFFF] border border-[#B0B0B0] hover:border-[#333333] text-[11px] font-mono text-[#333333] rounded-sm transition-colors cursor-pointer";
        tag.innerHTML = `<span>🐦</span> <span>${birdName}</span> ${birdId ? '<span class="text-[9px] text-[#777777]">↗</span>' : ''}`;
        
        if (birdId) {
          tag.addEventListener("click", () => {
            document.dispatchEvent(new CustomEvent("open-bird-sheet", { detail: birdId }));
          });
        }
        birdsListEl.appendChild(tag);
      });
    }
  }

  if (gmapsLink) {
    const origin = `${route.punto_inicio.coords[0]},${route.punto_inicio.coords[1]}`;
    const destination = `${route.latitud},${route.longitud}`;
    gmapsLink.href = `https://www.google.com/maps/dir/?api=1&origin=${origin}&destination=${destination}&travelmode=walking`;
  }
}

// Inicialización automática
document.addEventListener("DOMContentLoaded", () => {
  initRoutesModule();
});
