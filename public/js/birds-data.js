/**
 * birds-data.js - BioAves Quilichao
 * Base de datos estructurada para prototipo de baja fidelidad (Low-Fidelity Wireframe).
 * Todos los datos están claramente estructurados con fines de demostración y arquitectura de información.
 */

const BIOAVES_DATA = [
  {
    id: "momoto-andino",
    commonName: "Momoto Andino (Barranquero)",
    scientificName: "Momotus aequatorialis",
    family: "Momotidae",
    habitatType: "bosque-andino",
    habitatLabel: "Bosque de ribera y cañadas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    description: "Ave arborícola de tamaño mediano caracterizada por su corona azul turquesa, antifaz negro y cola larga terminada en dos raquetas desnudas que balancea como péndulo ante posibles amenazas o interacción territorial.",
    physicalCharacteristics: "Longitud de 48 a 50 cm. Plumaje predominantemente verde oliva con tonos canela en el pecho. Iris rojo encendido y pico aserrado adaptado a la captura de presas resbaladizas.",
    diet: "Omnívora: escarabajos, grillos, lagartijas pequeñas, ranas y frutos silvestres de yarumo y arrayán.",
    behavior: "Solitario o en parejas. Permanece inmóvil en perchas sombreadas del estrato medio antes de lanzarse en vuelo directo hacia el suelo o follaje.",
    distribution: "Cordillera Central y Occidental de los Andes, entre 1.000 y 2.400 msnm.",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: VISTA LATERAL EN PERCHA]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE CORONA Y PICO]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: AVE EN HÁBITAT RIBEREÑO]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: COMPORTAMIENTO DE BALANCEO DE COLA]",
      audioDuration: "0:28",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/4/4e/Momotus_aequatorialis_-_Blue-crowned_Motmot_XC28717.ogg"
    },
    sighting: {
      locationName: "Cuenca del Río Quilichao - Sendero Fluvial",
      zone: "Zona Urbana y Ribereña",
      date: "14 de Enero de 2026 [Dato de Demostración]",
      coords: [3.0145, -76.4880],
      elevation: "1.060 msnm",
      notes: "Ejemplar adulto observado posado sobre rama de sauce a 3 metros sobre el cauce del río."
    }
  },
  {
    id: "pava-caucana",
    commonName: "Pava Caucana",
    scientificName: "Penelope perspicax",
    family: "Cracidae",
    habitatType: "bosque-andino",
    habitatLabel: "Bosque de niebla altoandino",
    category: "endemica",
    categoryLabel: "Endémica / Amenazada",
    status: "En Peligro (EN) [UICN]",
    description: "Especie endémica de las laderas andinas del Valle del Cauca y Cauca. Ave de gran tamaño fundamental para la dispersión de semillas de árboles maderables y palmas nativas.",
    physicalCharacteristics: "Longitud de 70 a 76 cm. Plumaje pardo oliváceo con bordes blanquecinos en el cuello y pecho. Destaca su garganta desnuda roja (gola gular) y patas rojizas.",
    diet: "Frugívora estricta: frutos carnosos de laureles, higuerones y palmas de cera.",
    behavior: "Habita el dosel superior en pequeños grupos familiares. Emite llamados guturales resonantes durante las primeras horas del amanecer.",
    distribution: "Restringida a relictos de bosque de niebla de la vertiente occidental de la Cordillera Central (1.400 - 2.100 msnm).",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: SILUETA EN DOSEL SUPERIOR]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE GOLA GULAR ROJA]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: GRUPO FAMILIAR EN RAMAS]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: FORRAJEO EN ÁRBOL NATIVO]",
      audioDuration: "0:34",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/e/e4/Penelope_perspicax_-_Cauca_Guan_XC151978.ogg"
    },
    sighting: {
      locationName: "Reserva Forestal Vereda San Antonio",
      zone: "Cordillera Central / Bosque de Niebla",
      date: "02 de Febrero de 2026 [Dato de Demostración]",
      coords: [3.0520, -76.4410],
      elevation: "1.750 msnm",
      notes: "Tres individuos alimentándose en frutos de palma madura durante niebla baja matutina."
    }
  },
  {
    id: "tangara-rastrojera",
    commonName: "Tangara Rastrojera (Matorralera)",
    scientificName: "Tangara vitriolina",
    family: "Thraupidae",
    habitatType: "cafetal-agroecosistema",
    habitatLabel: "Bordes de bosque y cafetales",
    category: "endemica",
    categoryLabel: "Casi Endémica",
    status: "Preocupación Menor (LC)",
    description: "Ave canora casi endémica de los valles interandinos colombianos. Muy común y activa en cercas vivas, matorrales y fincas con sombrío de plátano.",
    physicalCharacteristics: "Longitud de 14 cm. Coronilla castaño rojizo vivo que contrasta con el plumaje grisáceo en el cuerpo y destellos verdes en alas.",
    diet: "Semillas, bayas de arbustos pioneros y pequeños insectos foliares.",
    behavior: "Muy inquieta, salta continuamente entre ramitas densas en parejas o formando bandadas mixtas con otras tangaras.",
    distribution: "Valles del Río Cauca y Magdalena (500 a 2.200 msnm).",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: VISTA DE PERFIL EN ARBUSTO]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE CORONA CASTAÑA]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: FORRAJEANDO ENTRE MATORRALES]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: CANTO Y ALIMENTACIÓN EN CERCA VIVA]",
      audioDuration: "0:19",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/7/7b/Tangara_vitriolina_-_Scrub_Tanager_XC33502.ogg"
    },
    sighting: {
      locationName: "Faldas de Mondomo - Finca Agroecológica",
      zone: "Zona Cafetera Suroccidente",
      date: "20 de Enero de 2026 [Dato de Demostración]",
      coords: [2.9720, -76.5310],
      elevation: "1.280 msnm",
      notes: "Pareja activa en borde de sendero cafetero en floración."
    }
  },
  {
    id: "colibri-colirrufo",
    commonName: "Colibrí Colirrufo",
    scientificName: "Amazilia tzacatl",
    family: "Trochilidae",
    habitatType: "urbano-jardines",
    habitatLabel: "Jardines urbanos y orillas de caminos",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    description: "Colibrí de tamaño medio y temperamento sumamente territorial. Defiende con agresividad sus parches de flores ante otros colibríes más grandes.",
    physicalCharacteristics: "Longitud de 9 a 10 cm. Garganta y pecho verde metálico brillante, vientre grisáceo y cola rojizo castaño característica.",
    diet: "Néctar de flores de heliconias, veraneras e hibiscos, complementado con mosquitos al vuelo.",
    behavior: "Vuelo rápido en zigzag. Realiza perchas visibles en ramas secas para vigilar su territorio floral.",
    distribution: "Desde el nivel del mar hasta 1.800 msnm en todo el territorio quilichagüeño.",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: VUELO SUSPENDIDO ANTE FLOR]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE PICO RECTO]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: PERCHADO EN RAMA DELGADA]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: LIBACIÓN RÁPIDA DE NÉCTAR]",
      audioDuration: "0:15",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/1/1a/Amazilia_tzacatl_-_Rufous-tailed_Hummingbird_XC24361.ogg"
    },
    sighting: {
      locationName: "Parque Principal Francisco de Paula Santander",
      zone: "Casco Urbano",
      date: "05 de Febrero de 2026 [Dato de Demostración]",
      coords: [3.0094, -76.4847],
      elevation: "1.056 msnm",
      notes: "Individuo libando néctar en canteros centrales frente a la iglesia principal."
    }
  },
  {
    id: "garza-tigre",
    commonName: "Garza Tigre Cuellifasta",
    scientificName: "Tigrisoma lineatum",
    family: "Ardeidae",
    habitatType: "humedal-rio",
    habitatLabel: "Humedales, ciénagas y meandros",
    category: "residente",
    categoryLabel: "Residente Acuática",
    status: "Preocupación Menor (LC)",
    description: "Garza solitaria de hábitos crepusculares. Su postura rígida y su plumaje rayado le permiten camuflarse entre la enea y vegetación ribereña.",
    physicalCharacteristics: "Longitud de 66 a 75 cm. Cuello robusto con llamativo rayado fino blanco y pardo rojizo. Pico largo y recto color cuerno.",
    diet: "Peces dulceacuícolas, ranas, renacuajos y crustáceos de río.",
    behavior: "Permanece quieta durante períodos prolongados en la orilla del agua esperando el paso de presas.",
    distribution: "Humedales y ríos de tierras bajas hasta 1.200 msnm.",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: POSTURA MIMÉTICA EN JUNCALES]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DEL RAYADO DEL CUELLO]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: CAZANDO EN EL ESPEJO DE AGUA]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: TÉCNICA DE PESCA SIGILOSA]",
      audioDuration: "0:22",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/8/87/Tigrisoma_lineatum_-_Rufescent_Tiger-Heron_XC14838.ogg"
    },
    sighting: {
      locationName: "Humedal El Samán y Microcuenca Sur",
      zone: "Área de Humedales",
      date: "28 de Enero de 2026 [Dato de Demostración]",
      coords: [2.9920, -76.4715],
      elevation: "1.045 msnm",
      notes: "Registro al atardecer sobre orilla fangosa junto al espejo de agua."
    }
  },
  {
    id: "carpintero-habado",
    commonName: "Carpintero Habado",
    scientificName: "Melanerpes rubricapillus",
    family: "Picidae",
    habitatType: "urbano-jardines",
    habitatLabel: "Guaduales y arboledas suburbanas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    description: "Carpintero adaptable con plumaje cebra en el dorso. Conocido por sus tamborileos sonoros en postes secos y tallos maduros de guadua.",
    physicalCharacteristics: "Longitud de 17 cm. Dorso listado de blanco y negro, vientre gris cremoso con mancha roja abdominal; corona carmesí en machos.",
    diet: "Larvas taladradoras de madera, termitas, hormigas y frutos maduros como papaya y guayaba.",
    behavior: "Trepador activo sobre troncos verticales; taladra cavidades para nidificar en madera blanda.",
    distribution: "Valles cálidos y zonas premontanas de Colombia (0 a 1.600 msnm).",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: TREPANDO TALLO DE GUADUA]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE CORONA ROJA]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: INSPECCIONANDO CAVIDAD DE NIDO]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: TAMBORILEO Y COMUNICACIÓN SONORA]",
      audioDuration: "0:18",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/a/a2/Melanerpes_rubricapillus_-_Red-crowned_Woodpecker_XC33005.ogg"
    },
    sighting: {
      locationName: "Guaduales de la Vereda Santa Inés",
      zone: "Zona Agropecuaria y Guaduales",
      date: "10 de Enero de 2026 [Dato de Demostración]",
      coords: [3.0210, -76.4680],
      elevation: "1.070 msnm",
      notes: "Macho observado taladrando tronco seco a media mañana."
    }
  },
  {
    id: "azulejo-comun",
    commonName: "Azulejo Común",
    scientificName: "Thraupis episcopus",
    family: "Thraupidae",
    habitatType: "urbano-jardines",
    habitatLabel: "Parques, jardines y cultivos frutales",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    description: "Una de las aves más reconocibles del municipio gracias a su plumaje azul celeste uniforme. Muy confiado cerca de asentamientos humanos.",
    physicalCharacteristics: "Longitud de 16 cm. Cabeza y pecho grisáceo perla con tonos azulados claros; alas azul cobalto vivo sin rayas marcadas.",
    diet: "Frugívoro e insectívoro oportunista: mangos, papayas, plátanos y polillas.",
    behavior: "Gregarismo moderado. Frecuenta comederos comunitarios y árboles frutales en parejas.",
    distribution: "Ampliamente distribuido en Colombia por debajo de 2.200 msnm.",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: PAREJA EN ÁRBOL FRUTAL]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE PLUMAJE CELESTE]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: VOLANDO ENTRE JARDINES]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: VOCALIZACIONES MATUTINAS EN COPA]",
      audioDuration: "0:25",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/90/Thraupis_episcopus_-_Blue-gray_Tanager_XC41982.ogg"
    },
    sighting: {
      locationName: "Campus Universitario del Norte del Cauca",
      zone: "Zona Urbana y Académica",
      date: "18 de Febrero de 2026 [Dato de Demostración]",
      coords: [3.0290, -76.4950],
      elevation: "1.062 msnm",
      notes: "Tres individuos alimentándose en copas de mango cerca a los edificios docentes."
    }
  },
  {
    id: "buho-currucutu",
    commonName: "Currucutú Común (Búho Chillón)",
    scientificName: "Megascops choliba",
    family: "Strigidae",
    habitatType: "bosque-andino",
    habitatLabel: "Arboledas periurbanas y cerros tutelares",
    category: "residente",
    categoryLabel: "Nocturna Residente",
    status: "Preocupación Menor (LC)",
    description: "Pequeña rapaz nocturna de plumaje estrictamente mimético similar a la corteza de árboles añosos. Su trino característico es sinónimo de las noches quilichagüeñas.",
    physicalCharacteristics: "Longitud de 21 a 23 cm. Penachos auriculares móviles ('orejitas'). Plumaje vermiculado en grises y castaños con ojos amarillos intensos.",
    diet: "Caza activa nocturna de escarabajos rinoceronte, polillas grandes, ciempiés y ratones.",
    behavior: "Estrictamente nocturno; pasa el día inmóvil apoyado contra el tronco de un árbol frondoso.",
    distribution: "Tierras bajas y medias andinas de todo el departamento del Cauca.",
    multimedia: {
      photos: [
        { id: 1, label: "[PLACEHOLDER DE FOTOGRAFÍA 1 DE 3: MIMETISMO EN CORTEZA DE ÁRBOL]" },
        { id: 2, label: "[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: OJOS AMARILLOS Y PENACHOS]" },
        { id: 3, label: "[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: SILUETA NOCTURNA EN RAMA SECA]" }
      ],
      videoPlaceholder: "[PLACEHOLDER DE VIDEO: LLAMADO NOCTURNO 'CURRU-CU-TÚ']",
      audioDuration: "0:21",
      audioSample: "https://upload.wikimedia.org/wikipedia/commons/e/e0/Megascops_choliba_-_Tropical_Screech-Owl_XC61291.ogg"
    },
    sighting: {
      locationName: "Cerro y Mirador de Belén",
      zone: "Cerros Tutelares",
      date: "25 de Febrero de 2026 [Dato de Demostración]",
      coords: [3.0040, -76.4910],
      elevation: "1.120 msnm",
      notes: "Vocalizando a las 7:30 PM en un árbol de caucho cerca a la capilla de Belén."
    }
  }
];
