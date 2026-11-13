/**
 * birds-data.js - BioAves Quilichao
 * Base de datos estructurada con las 25 especies registradas para Santander de Quilichao.
 */

const BIOAVES_DATA = [
  {
    "id": "momoto-andino",
    "image": "img/aves/momoto-andino-panoramica.png",
    "imageFit": "cover",
    "imagePosition": "center 25%",
    "commonName": "Momoto Andino (Barranquero)",
    "scientificName": "Momotus aequatorialis",
    "family": "Momotidae",
    "habitatType": "bosque-andino",
    "habitatLabel": "Bosque de ribera y cañadas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Ave arborícola de tamaño mediano caracterizada por su corona azul turquesa, antifaz negro y cola larga terminada en dos raquetas desnudas que balancea como péndulo ante posibles amenazas o interacción territorial.",
    "physicalCharacteristics": "Longitud de 48 a 50 cm. Plumaje predominantemente verde oliva con tonos canela en el pecho. Iris rojo encendido y pico aserrado adaptado a la captura de presas resbaladizas.",
    "diet": "Omnívora: escarabajos, grillos, lagartijas pequeñas, ranas y frutos silvestres de yarumo y arrayán.",
    "behavior": "Solitario o en parejas. Permanece inmóvil en perchas sombreadas del estrato medio antes de lanzarse en vuelo directo hacia el suelo o follaje.",
    "distribution": "Cordillera Central y Occidental de los Andes, entre 1.000 y 2.400 msnm.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/momoto-andino-panoramica.png",
          "label": "Momoto Andino registrado en Santander de Quilichao. Foto base: Litrato15 (iNaturalist, CC BY-NC); reencuadre panorámico mediante IA."
        },
        {
          "id": 2,
          "src": "img/aves/momoto-andino-detalle.png",
          "label": "Detalle del Momoto Andino derivado de la fotografía principal mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/momoto-andino-entorno.png",
          "label": "Composición contextual del Momoto Andino derivada de la fotografía principal mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales del Momoto Andino",
      "videos": [
        {
          "src": "video/momoto - hablando.mp4",
          "label": "Momoto Andino vocalizando"
        },
        {
          "src": "video/momoto - cantando.mp4",
          "label": "Registro del canto del Momoto Andino"
        }
      ],
      "audioDuration": "0:08",
      "audioSample": "video/momoto - cantando.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Cuenca del Río Quilichao - Sendero Fluvial",
      "zone": "Zona Urbana y Ribereña",
      "date": "14 de Enero de 2026 [Dato de Demostración]",
      "coords": [
        3.0145,
        -76.488
      ],
      "elevation": "1.060 msnm",
      "notes": "Ejemplar adulto observado posado sobre rama de sauce a 3 metros sobre el cauce del río."
    }
  },
  {
    "id": "chicao",
    "image": "img/aves/chicao-panoramica.png",
    "imageFit": "cover",
    "imagePosition": "center 15%",
    "commonName": "Chicao",
    "scientificName": "Icterus nigrogularis",
    "family": "Icteridae",
    "habitatType": "cafetal-agroecosistema",
    "habitatLabel": "Bordes de bosque, cultivos y arbolado urbano",
    "category": "residente",
    "categoryLabel": "Residente Emblemática",
    "status": "Preocupación Menor (LC)",
    "description": "Ave amarilla y negra conocida localmente como Chicao o Pájaro de Oro. Es una especie emblemática de Santander de Quilichao y suele observarse en árboles altos, bordes de bosque y zonas abiertas arboladas.",
    "physicalCharacteristics": "Ave mediana de plumaje amarillo intenso, alas y cola negras, con una máscara oscura alrededor del ojo y la garganta.",
    "diet": "Omnívora: consume insectos, frutos, néctar y flores.",
    "behavior": "Se desplaza en parejas o grupos pequeños y vocaliza con frecuencia desde perchas visibles.",
    "distribution": "Presente en zonas cálidas y premontanas del norte del Cauca, en ambientes abiertos con árboles y bordes de bosque.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/chicao-panoramica.png",
          "label": "Chicao posado entre el follaje; reencuadre panorámico mediante IA a partir de la fotografía aportada."
        },
        {
          "id": 2,
          "src": "img/aves/chicao-detalle.png",
          "label": "Detalle del plumaje amarillo y negro del Chicao, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/chicao-entorno.png",
          "label": "Composición contextual del Chicao derivada de la fotografía principal mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales del Chicao",
      "videos": [
        {
          "src": "video/CHICAO HABLANDO.mp4",
          "label": "Chicao vocalizando"
        },
        {
          "src": "video/CHICAO SONIDO.mp4",
          "label": "Registro del canto del Chicao"
        }
      ],
      "audioDuration": "0:08",
      "audioSample": "video/CHICAO SONIDO.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Santander de Quilichao",
      "zone": "Zona Urbana y Agroecosistemas",
      "date": "Registro multimedia del equipo",
      "coords": [
        3.0094,
        -76.4847
      ],
      "elevation": "1.056 msnm",
      "notes": "Registro audiovisual aportado para la colección BioAves Quilichao."
    }
  },
  {
    "id": "pava-caucana",
    "image": "img/aves/pava-caucana-panoramica.png",
    "imageFit": "cover",
    "imagePosition": "center 15%",
    "commonName": "Pava Caucana",
    "scientificName": "Penelope perspicax",
    "family": "Cracidae",
    "habitatType": "bosque-andino",
    "habitatLabel": "Bosque de niebla altoandino",
    "category": "endemica",
    "categoryLabel": "Endémica / Amenazada",
    "status": "En Peligro (EN) [UICN]",
    "description": "Especie endémica de las laderas andinas del Valle del Cauca y Cauca. Ave de gran tamaño fundamental para la dispersión de semillas de árboles maderables y palmas nativas.",
    "physicalCharacteristics": "Longitud de 70 a 76 cm. Plumaje pardo oliváceo con bordes blanquecinos en el cuello y pecho. Destaca su garganta desnuda roja (gola gular) y patas rojizas.",
    "diet": "Frugívora estricta: frutos carnosos de laureles, higuerones y palmas de cera.",
    "behavior": "Habita el dosel superior en pequeños grupos familiares. Emite llamados guturales resonantes durante las primeras horas del amanecer.",
    "distribution": "Restringida a relictos de bosque de niebla de la vertiente occidental de la Cordillera Central (1.400 - 2.100 msnm).",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/pava-caucana-panoramica.png",
          "label": "Pava Caucana en bosque andino; reencuadre panorámico mediante IA a partir de la fotografía aportada."
        },
        {
          "id": 2,
          "src": "img/aves/pava-caucana-detalle.png",
          "label": "Detalle de la gola gular roja de la Pava Caucana, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/pava-caucana-entorno.png",
          "label": "Composición contextual de una Pava Caucana en bosque andino, derivada mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: FORRAJEO EN ÁRBOL NATIVO]",
      "videos": [
        {
          "src": "video/PAVA CAUCANA HABLANDO.mp4",
          "label": "Video del ave"
        },
        {
          "src": "video/PAVA CAUCANA SONIDO.mp4",
          "label": "Sonido del ave"
        }
      ],
      "audioDuration": "0:34",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/e/e4/Penelope_perspicax_-_Cauca_Guan_XC151978.ogg"
    },
    "sighting": {
      "locationName": "Reserva Forestal Vereda San Antonio",
      "zone": "Cordillera Central / Bosque de Niebla",
      "date": "02 de Febrero de 2026 [Dato de Demostración]",
      "coords": [
        3.052,
        -76.441
      ],
      "elevation": "1.750 msnm",
      "notes": "Tres individuos alimentándose en frutos de palma madura durante niebla baja matutina."
    }
  },
  {
    "id": "tangara-rastrojera",
    "image": "img/aves/tangara-rastrojera.jpg",
    "imageFit": "cover",
    "imagePosition": "center 25%",
    "commonName": "Tangara Rastrojera (Matorralera)",
    "scientificName": "Tangara vitriolina",
    "family": "Thraupidae",
    "habitatType": "cafetal-agroecosistema",
    "habitatLabel": "Bordes de bosque y cafetales",
    "category": "endemica",
    "categoryLabel": "Casi Endémica",
    "status": "Preocupación Menor (LC)",
    "description": "Ave canora casi endémica de los valles interandinos colombianos. Muy común y activa en cercas vivas, matorrales y fincas con sombrío de plátano.",
    "physicalCharacteristics": "Longitud de 14 cm. Coronilla castaño rojizo vivo que contrasta con el plumaje grisáceo en el cuerpo y destellos verdes en alas.",
    "diet": "Semillas, bayas de arbustos pioneros y pequeños insectos foliares.",
    "behavior": "Muy inquieta, salta continuamente entre ramitas densas en parejas o formando bandadas mixtas con otras tangaras.",
    "distribution": "Valles del Río Cauca y Magdalena (500 a 2.200 msnm).",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/tangara-rastrojera.jpg",
          "label": "Tangara Rastrojera. Foto de referencia externa: olegvasiliev (iNaturalist, CC BY-NC), Valle del Cauca; no corresponde a un registro municipal de Santander de Quilichao."
        },
        {
          "id": 2,
          "src": "img/aves/tangara-rastrojera-detalle.png",
          "label": "Detalle derivado con IA de la fotografía externa de referencia; no corresponde a un registro municipal."
        },
        {
          "id": 3,
          "src": "img/aves/tangara-rastrojera-entorno.png",
          "label": "Composición contextual derivada con IA de la fotografía externa de referencia; no corresponde a un registro municipal."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales de la Tangara Rastrojera",
      "videos": [
        { "src": "video/TANGARA HABLANDO.mp4", "label": "Tangara Rastrojera vocalizando" },
        { "src": "video/TANGARA SONIDO.mp4", "label": "Registro del canto de la Tangara Rastrojera" }
      ],
      "audioDuration": "0:10",
      "audioSample": "video/TANGARA SONIDO.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Faldas de Mondomo - Finca Agroecológica",
      "zone": "Zona Cafetera Suroccidente",
      "date": "20 de Enero de 2026 [Dato de Demostración]",
      "coords": [
        2.972,
        -76.531
      ],
      "elevation": "1.280 msnm",
      "notes": "Pareja activa en borde de sendero cafetero en floración."
    }
  },
  {
    "id": "colibri-colirrufo",
    "image": "img/aves/COLIBRI.png",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Colibrí Colirrufo",
    "scientificName": "Amazilia tzacatl",
    "family": "Trochilidae",
    "habitatType": "urbano-jardines",
    "habitatLabel": "Jardines urbanos y orillas de caminos",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Colibrí de tamaño medio y temperamento sumamente territorial. Defiende con agresividad sus parches de flores ante otros colibríes más grandes.",
    "physicalCharacteristics": "Longitud de 9 a 10 cm. Garganta y pecho verde metálico brillante, vientre grisáceo y cola rojizo castaño característica.",
    "diet": "Néctar de flores de heliconias, veraneras e hibiscos, complementado con mosquitos al vuelo.",
    "behavior": "Vuelo rápido en zigzag. Realiza perchas visibles en ramas secas para vigilar su territorio floral.",
    "distribution": "Desde el nivel del mar hasta 1.800 msnm en todo el territorio quilichagüeño.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/COLIBRI.png",
          "label": "Colibrí Colirrufo posado en una rama"
        },
        {
          "id": 2,
          "src": "img/aves/colibri-colirrufo-detalle.png",
          "label": "Detalle del pico y plumaje del Colibrí Colirrufo, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/colibri-colirrufo-entorno.png",
          "label": "Composición contextual del Colibrí Colirrufo derivada mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: LIBACIÓN RÁPIDA DE NÉCTAR]",
      "videos": [
        {
          "src": "video/COLIBIRI HABLANDO.mp4",
          "label": "Colibrí vocalizando"
        },
        {
          "src": "video/COLIBRI SONIDO.mp4",
          "label": "Registro del canto del Colibrí"
        }
      ],
      "audioDuration": "0:15",
      "audioSample": "video/COLIBRI SONIDO.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Parque Principal Francisco de Paula Santander",
      "zone": "Casco Urbano",
      "date": "05 de Febrero de 2026 [Dato de Demostración]",
      "coords": [
        3.0094,
        -76.4847
      ],
      "elevation": "1.056 msnm",
      "notes": "Individuo libando néctar en canteros centrales frente a la iglesia principal."
    }
  },
  {
    "id": "mirla-azul",
    "image": "img/aves/COLIBRI COLIRRUFO.png",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Mirla Azul",
    "scientificName": "Turdus sp. (identificación pendiente)",
    "family": "Turdidae",
    "habitatType": "bosque-andino",
    "habitatLabel": "Bosques montanos y bordes arbolados",
    "category": "residente",
    "categoryLabel": "Registro por Identificar",
    "status": "Identificación taxonómica pendiente",
    "description": "Registro multimedia recibido con el nombre común Mirla Azul. La ficha conserva ese nombre y deja explícita la identificación taxonómica pendiente para evitar asignar una especie científica sin verificación.",
    "physicalCharacteristics": "Ave mediana de plumaje azul grisáceo, alas de azul más intenso, pico recto oscuro y cola alargada.",
    "diet": "Información pendiente de confirmación taxonómica.",
    "behavior": "En los registros se observa posada y vocalizando desde ramas expuestas.",
    "distribution": "Registro local en Santander de Quilichao; la distribución precisa depende de confirmar la especie.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/COLIBRI COLIRRUFO.png",
          "label": "Registro fotográfico de la Mirla Azul"
        },
        {
          "id": 2,
          "src": "img/aves/mirla-azul-detalle.png",
          "label": "Detalle del ave registrada como Mirla Azul, derivado mediante edición con IA; identificación taxonómica pendiente."
        },
        {
          "id": 3,
          "src": "img/aves/mirla-azul-entorno.png",
          "label": "Composición contextual derivada mediante IA; identificación taxonómica pendiente y no corresponde a un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales de la Mirla Azul",
      "videos": [
        {
          "src": "video/MIRLA AZUL HABLANDO.mp4",
          "label": "Mirla Azul vocalizando"
        },
        {
          "src": "video/MIRLA AZUL SONIDO.mp4",
          "label": "Registro del canto de la Mirla Azul"
        }
      ],
      "audioDuration": "0:08",
      "audioSample": "video/MIRLA AZUL SONIDO.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Santander de Quilichao",
      "zone": "Zona Andina",
      "date": "Registro multimedia del equipo",
      "coords": [
        3.029,
        -76.495
      ],
      "elevation": "1.062 msnm",
      "notes": "El nombre común proviene del archivo recibido; la identificación científica requiere validación."
    }
  },
  {
    "id": "garza-tigre",
    "image": "img/aves/garza-tigre-principal-v2.png",
    "imageFit": "cover",
    "imagePosition": "center 20%",
    "commonName": "Garza Tigre Cuellifasta",
    "scientificName": "Tigrisoma lineatum",
    "family": "Ardeidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Humedales, ciénagas y meandros",
    "category": "residente",
    "categoryLabel": "Residente Acuática",
    "status": "Preocupación Menor (LC)",
    "description": "Garza solitaria de hábitos crepusculares. Su postura rígida y su plumaje rayado le permiten camuflarse entre la enea y vegetación ribereña.",
    "physicalCharacteristics": "Longitud de 66 a 75 cm. Cuello robusto con llamativo rayado fino blanco y pardo rojizo. Pico largo y recto color cuerno.",
    "diet": "Peces dulceacuícolas, ranas, renacuajos y crustáceos de río.",
    "behavior": "Permanece quieta durante períodos prolongados en la orilla del agua esperando el paso de presas.",
    "distribution": "Humedales y ríos de tierras bajas hasta 1.200 msnm.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/garza-tigre-principal-v2.png",
          "label": "Garza Tigre Cuellifasta. Fotografía aportada al proyecto; autoría, licencia y ubicación pendientes de documentación."
        },
        {
          "id": 2,
          "src": "img/aves/garza-tigre-detalle-v2.png",
          "label": "Detalle de la cabeza y el pico de la Garza Tigre, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/garza-tigre-entorno-v2.png",
          "label": "Composición contextual de la Garza Tigre junto a un humedal, derivada mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales de la Garza Tigre",
      "videos": [
        { "src": "video/Garza_tigre_hablando.mp4", "label": "Garza Tigre vocalizando" },
        { "src": "video/_GARZA_canto.mp4", "label": "Registro del canto de la Garza Tigre" }
      ],
      "audioDuration": "0:10",
      "audioSample": "video/_GARZA_canto.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Humedal El Samán y Microcuenca Sur",
      "zone": "Área de Humedales",
      "date": "28 de Enero de 2026 [Dato de Demostración]",
      "coords": [
        2.992,
        -76.4715
      ],
      "elevation": "1.045 msnm",
      "notes": "Registro al atardecer sobre orilla fangosa junto al espejo de agua."
    }
  },
  {
    "id": "carpintero-habado",
    "image": "img/aves/carpintero-habado.png",
    "imageFit": "cover",
    "imagePosition": "center top",
    "commonName": "Carpintero Habado",
    "scientificName": "Melanerpes rubricapillus",
    "family": "Picidae",
    "habitatType": "urbano-jardines",
    "habitatLabel": "Guaduales y arboledas suburbanas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Carpintero adaptable con plumaje cebra en el dorso. Conocido por sus tamborileos sonoros en postes secos y tallos maduros de guadua.",
    "physicalCharacteristics": "Longitud de 17 cm. Dorso listado de blanco y negro, vientre gris cremoso con mancha roja abdominal; corona carmesí en machos.",
    "diet": "Larvas taladradoras de madera, termitas, hormigas y frutos maduros como papaya y guayaba.",
    "behavior": "Trepador activo sobre troncos verticales; taladra cavidades para nidificar en madera blanda.",
    "distribution": "Valles cálidos y zonas premontanas de Colombia (0 a 1.600 msnm).",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/carpintero-habado.png",
          "label": "Carpintero Habado registrado en Santander de Quilichao. Foto: Litrato15 (iNaturalist, CC BY-NC); mejora técnica con IA."
        },
        {
          "id": 2,
          "src": "img/aves/carpintero-habado-detalle.png",
          "label": "Detalle de la corona roja del Carpintero Habado, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/carpintero-habado-entorno.png",
          "label": "Composición contextual del Carpintero Habado junto a una cavidad, derivada mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales del Carpintero Habado",
      "videos": [
        { "src": "video/COLIBRI HABADO HABLANDO.mp4", "label": "Carpintero Habado vocalizando" },
        { "src": "video/COLIBRI HABADO SONIDO.mp4", "label": "Registro del canto del Carpintero Habado" }
      ],
      "audioDuration": "0:10",
      "audioSample": "video/COLIBRI HABADO SONIDO.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Guaduales de la Vereda Santa Inés",
      "zone": "Zona Agropecuaria y Guaduales",
      "date": "10 de Enero de 2026 [Dato de Demostración]",
      "coords": [
        3.021,
        -76.468
      ],
      "elevation": "1.070 msnm",
      "notes": "Macho observado taladrando tronco seco a media mañana."
    }
  },
  {
    "id": "azulejo-comun",
    "image": "img/aves/azulejo-comun-rama.png",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Azulejo Común",
    "scientificName": "Thraupis episcopus",
    "family": "Thraupidae",
    "habitatType": "urbano-jardines",
    "habitatLabel": "Parques, jardines y cultivos frutales",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Una de las aves más reconocibles del municipio gracias a su plumaje azul celeste uniforme. Muy confiado cerca de asentamientos humanos.",
    "physicalCharacteristics": "Longitud de 16 cm. Cabeza y pecho grisáceo perla con tonos azulados claros; alas azul cobalto vivo sin rayas marcadas.",
    "diet": "Frugívoro e insectívoro oportunista: mangos, papayas, plátanos y polillas.",
    "behavior": "Gregarismo moderado. Frecuenta comederos comunitarios y árboles frutales en parejas.",
    "distribution": "Ampliamente distribuido en Colombia por debajo de 2.200 msnm.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/azulejo-comun-rama.png",
          "label": "Azulejo Común registrado en Santander de Quilichao. Foto base: Henry Dubán Alegría (iNaturalist, CC BY-NC); composición sobre rama mediante IA."
        },
        {
          "id": 2,
          "src": "img/aves/azulejo-comun-detalle.png",
          "label": "Detalle del plumaje celeste del Azulejo Común, derivado mediante edición con IA."
        },
        {
          "id": 3,
          "src": "img/aves/azulejo-comun-entorno.png",
          "label": "Composición contextual del Azulejo Común sobre una rama, derivada mediante IA; no es un registro independiente."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales del Azulejo Común",
      "videos": [
        { "src": "video/Azulejo_común_hablando.mp4", "label": "Azulejo Común vocalizando" },
        { "src": "video/_AZULEJO_canto.mp4", "label": "Registro del canto del Azulejo Común" }
      ],
      "audioDuration": "0:10",
      "audioSample": "video/_AZULEJO_canto.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Campus Universitario del Norte del Cauca",
      "zone": "Zona Urbana y Académica",
      "date": "18 de Febrero de 2026 [Dato de Demostración]",
      "coords": [
        3.029,
        -76.495
      ],
      "elevation": "1.062 msnm",
      "notes": "Tres individuos alimentándose en copas de mango cerca a los edificios docentes."
    }
  },
  {
    "id": "buho-currucutu",
    "image": "img/aves/currucutu-comun.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Currucutú Común (Búho Chillón)",
    "scientificName": "Megascops choliba",
    "family": "Strigidae",
    "habitatType": "bosque-andino",
    "habitatLabel": "Arboledas periurbanas y cerros tutelares",
    "category": "residente",
    "categoryLabel": "Nocturna Residente",
    "status": "Preocupación Menor (LC)",
    "description": "Pequeña rapaz nocturna de plumaje estrictamente mimético similar a la corteza de árboles añosos. Su trino característico es sinónimo de las noches quilichagüeñas.",
    "physicalCharacteristics": "Longitud de 21 a 23 cm. Penachos auriculares móviles ('orejitas'). Plumaje vermiculado en grises y castaños con ojos amarillos intensos.",
    "diet": "Caza activa nocturna de escarabajos rinoceronte, polillas grandes, ciempiés y ratones.",
    "behavior": "Estrictamente nocturno; pasa el día inmóvil apoyado contra el tronco de un árbol frondoso.",
    "distribution": "Tierras bajas y medias andinas de todo el departamento del Cauca.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/currucutu-comun.jpg",
          "label": "Currucutú Común. Foto de referencia externa: gabo_utria (iNaturalist, CC BY-NC), Jamundí, Valle del Cauca; no corresponde a un registro municipal de Santander de Quilichao."
        },
        {
          "id": 2,
          "src": "img/aves/currucutu-comun-detalle.png",
          "label": "Detalle facial del Currucutú derivado con IA de la fotografía externa; conserva los ojos entrecerrados de la toma original."
        },
        {
          "id": 3,
          "src": "img/aves/currucutu-comun-entorno.png",
          "label": "Versión nocturna contextual derivada con IA de la fotografía externa; no corresponde a un registro municipal."
        }
      ],
      "videoPlaceholder": "Registros audiovisuales del Currucutú Común",
      "videos": [
        {
          "src": "video/currucutu-hablando.mp4",
          "label": "Currucutú Común vocalizando"
        },
        {
          "src": "video/currucutu - cantando.mp4",
          "label": "Registro del canto del Currucutú Común"
        }
      ],
      "audioDuration": "0:10",
      "audioSample": "video/currucutu - cantando.mp4",
      "audioLocal": true
    },
    "sighting": {
      "locationName": "Cerro y Mirador de Belén",
      "zone": "Cerros Tutelares",
      "date": "25 de Febrero de 2026 [Dato de Demostración]",
      "coords": [
        3.004,
        -76.491
      ],
      "elevation": "1.120 msnm",
      "notes": "Vocalizando a las 7:30 PM en un árbol de caucho cerca a la capilla de Belén."
    }
  },
  {
    "id": "carrao",
    "image": "img/aves/carrao.jpg",
    "imageFit": "cover",
    "imagePosition": "center 25%",
    "commonName": "Carrao",
    "scientificName": "Aramus guarauna",
    "family": "Aramidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Humedales, ciénagas y lagunas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Ave zancuda de plumaje pardo con marcas claras y pico largo, ligeramente curvado. Se alimenta de caracoles de agua dulce en humedales y ciénagas.",
    "physicalCharacteristics": "Ave zancuda de plumaje pardo con marcas claras y pico largo, ligeramente curvado.",
    "diet": "Caracoles de agua dulce, especialmente grandes caracoles acuáticos; ocasionalmente otros invertebrados.",
    "behavior": "Busca moluscos en el agua somera y los extrae con el pico; su dieta lo vincula estrechamente con los humedales. Nido de material vegetal, generalmente sobre vegetación próxima al agua.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/carrao.jpg",
          "label": "Carrao (Aramus guarauna). Foto de referencia externa: leppyone (Wikimedia Commons, CC BY 2.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE CARRAO]",
      "audioDuration": "0:15",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/e/ee/Aramus_guarauna_-_Limpkin_XC250488.mp3"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "ciguenuela-cuellinegra",
    "image": "img/aves/ciguenuela-cuellinegra.jpg",
    "imageFit": "cover",
    "imagePosition": "center 20%",
    "commonName": "Cigüeñuela Cuellinegra",
    "scientificName": "Himantopus mexicanus",
    "family": "Recurvirostridae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Charcas someras y orillas fangosas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Ave playera de patas rosadas muy largas, dorso oscuro y partes inferiores blancas, común en charcas someras y humedales abiertos.",
    "physicalCharacteristics": "Ave playera de patas rosadas muy largas, dorso oscuro y partes inferiores blancas.",
    "diet": "Insectos acuáticos, larvas, crustáceos y otros invertebrados.",
    "behavior": "Explora aguas poco profundas; suele emitir llamadas de alarma cerca del nido. Pone huevos sobre el suelo o pequeñas elevaciones próximas al agua.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/ciguenuela-cuellinegra.jpg",
          "label": "Cigüeñuela cuellinegra (Himantopus mexicanus). Foto de referencia externa: Mike Baird (Wikimedia Commons, CC BY 2.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE CIGÜEÑUELA CUELLINEGRA]",
      "audioDuration": "0:20",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/c/c5/Himantopus_mexicanus_-_Black-necked_Stilt_-_XC99570.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "garceta-nivea",
    "image": "img/aves/garceta-nivea.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Garceta Nívea",
    "scientificName": "Egretta thula",
    "family": "Ardeidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Humedales, riberas y bordes de lagunas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Garza blanca pequeña y estilizada con pico negro, patas negras y característicos dedos amarillos contrastantes.",
    "physicalCharacteristics": "Garza blanca pequeña con pico negro, patas negras y dedos amarillos contrastantes.",
    "diet": "Peces pequeños, camarones, insectos acuáticos y anfibios.",
    "behavior": "Puede mover los pies para hacer salir presas del fondo; controla poblaciones de animales acuáticos pequeños. Anida colonialmente en árboles o arbustos próximos al agua.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/garceta-nivea.jpg",
          "label": "Garceta nívea (Egretta thula). Foto de referencia externa: Dori (Wikimedia Commons, CC BY-SA 3.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE GARCETA NÍVEA]",
      "audioDuration": "0:10",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/9/93/Littleblueheronfishes.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "garceta-azul",
    "image": "img/aves/garceta-azul.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Garceta Azul",
    "scientificName": "Egretta caerulea",
    "family": "Ardeidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Lagunas, orillas de ríos y humedales",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Garza de plumaje azul pizarra en adultos y blanco en juveniles, observada en lagunas y orillas de ríos.",
    "physicalCharacteristics": "Garza de plumaje azul pizarra en adultos; los juveniles suelen ser blancos.",
    "diet": "Peces, crustáceos, insectos acuáticos y anfibios.",
    "behavior": "Camina despacio y captura presas con movimientos rápidos del pico. Suele anidar en colonias, con nidos de ramas en árboles o arbustos.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/garceta-azul.jpg",
          "label": "Garceta azul (Egretta caerulea). Foto de referencia externa: Wing-Chi Poon (Wikimedia Commons, CC BY-SA 2.5)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE GARCETA AZUL]",
      "audioDuration": "0:10",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/9/93/Littleblueheronfishes.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "morito-comun",
    "image": "img/aves/morito-comun.jpg",
    "imageFit": "cover",
    "imagePosition": "center 25%",
    "commonName": "Morito Común",
    "scientificName": "Plegadis falcinellus",
    "family": "Threskiornithidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Humedales y pastizales encharcados",
    "category": "migratoria",
    "categoryLabel": "Migratoria / Humedales",
    "status": "Preocupación Menor (LC)",
    "description": "Ibis oscuro de reflejos iridiscentes y pico largo curvado hacia abajo, habitante de pastizales húmedos y suelos fangosos.",
    "physicalCharacteristics": "Ibis oscuro de reflejos iridiscentes y pico largo curvado hacia abajo.",
    "diet": "Insectos, larvas, moluscos, gusanos y otros invertebrados.",
    "behavior": "Sondea el lodo con el pico; conecta ambientes acuáticos y terrestres. Construye nidos de vegetación en colonias de humedales.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/morito-comun.jpg",
          "label": "Morito común (Plegadis falcinellus). Foto de referencia externa: Debivort (Wikimedia Commons, CC BY-SA 2.5)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE MORITO COMÚN]",
      "audioDuration": "0:12",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/8/8e/Glossy_ibis.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "caracolero-comun",
    "image": "img/aves/caracolero-comun.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Caracolero Común",
    "scientificName": "Rostrhamus sociabilis",
    "family": "Accipitridae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Ciénagas y humedales de agua dulce",
    "category": "residente",
    "categoryLabel": "Residente Especialista",
    "status": "Preocupación Menor (LC)",
    "description": "Rapaz de pico fuertemente curvado y garras adaptadas para manipular presas, especializada en caracoles acuáticos Pomacea.",
    "physicalCharacteristics": "Rapaz de pico fuertemente curvado y garras adaptadas para manipular presas.",
    "diet": "Principalmente caracoles acuáticos del género Pomacea.",
    "behavior": "Captura caracoles y extrae el cuerpo de la concha; es un depredador especializado. Nido de ramas y vegetación en árboles o plantas emergentes.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/caracolero-comun.jpg",
          "label": "Caracolero común (Rostrhamus sociabilis). Foto de referencia externa: Claudney Neves (Wikimedia Commons, CC BY-SA 3.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE CARACOLERO COMÚN]",
      "audioDuration": "0:15",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/9/97/Rostrhamus_sociabilis_-_Snail_Kite_XC251465.mp3"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "bandurria-comun",
    "image": "img/aves/bandurria-comun.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Bandurria Común",
    "scientificName": "Theristicus caudatus",
    "family": "Threskiornithidae",
    "habitatType": "cafetal-agroecosistema",
    "habitatLabel": "Potreros, pastizales y sabanas abiertas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Ibis grande de cuello claro, cuerpo grisáceo y pico largo curvado, frecuente en potreros y terrenos abiertos.",
    "physicalCharacteristics": "Ibis grande de cuello claro, cuerpo grisáceo y pico largo curvado.",
    "diet": "Insectos, lombrices y pequeños vertebrados.",
    "behavior": "Busca presas caminando sobre el suelo; puede observarse en parejas o grupos. Nido voluminoso de ramas en árboles, según disponibilidad del entorno.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/bandurria-comun.jpg",
          "label": "Bandurria común (Theristicus caudatus). Foto de referencia externa: Dario Sanches (Wikimedia Commons, CC BY-SA 2.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE BANDURRIA COMÚN]",
      "audioDuration": "0:15",
      "audioSample": null
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "golondrina-pechigris",
    "image": "img/aves/golondrina-pechigris.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Golondrina Pechigrís",
    "scientificName": "Progne chalybea",
    "family": "Hirundinidae",
    "habitatType": "urbano-jardines",
    "habitatLabel": "Espacios abiertos, fincas y áreas urbanas",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Golondrina de dorso azul oscuro brillante y pecho grisáceo, común en áreas urbanas, fincas y sobrevolando aguas.",
    "physicalCharacteristics": "Golondrina de dorso azul oscuro brillante y pecho grisáceo.",
    "diet": "Insectos voladores capturados en el aire.",
    "behavior": "Vuelo rápido y maniobrable; contribuye al consumo de insectos aéreos. Puede usar cavidades y estructuras construidas para anidar.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/golondrina-pechigris.jpg",
          "label": "Golondrina pechigrís (Progne chalybea). Foto de referencia externa: Cláudio Dias Timm (Wikimedia Commons, CC BY-SA 2.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE GOLONDRINA PECHIGRÍS]",
      "audioDuration": "0:18",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/9/9f/Progne_chalybea_-_Grey-breasted_Martin_XC243000.mp3"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "piojito-pardo",
    "image": "img/aves/piojito-pardo.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Piojito Pardo",
    "scientificName": "Nesotriccus murinus",
    "family": "Tyrannidae",
    "habitatType": "cafetal-agroecosistema",
    "habitatLabel": "Matorrales, rastrojos y vegetación secundaria",
    "category": "residente",
    "categoryLabel": "Residente Discreto",
    "status": "Preocupación Menor (LC)",
    "description": "Pequeño atrapamoscas de tonos pardos y vientre más claro que forrajea activamente entre matorrales y rastrojos.",
    "physicalCharacteristics": "Pequeño atrapamoscas de tonos pardos y vientre más claro.",
    "diet": "Insectos y otros artrópodos pequeños.",
    "behavior": "Se posa en ramas y hace vuelos cortos para atrapar presas. Nido pequeño de fibras vegetales, normalmente oculto entre ramas.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sinónimo taxonómico previo: Phaeomyias murina. Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/piojito-pardo.jpg",
          "label": "Piojito pardo (Nesotriccus murinus). Ilustración zoológica de referencia: John Jennens (Dominio Público)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE PIOJITO PARDO]",
      "audioDuration": "0:14",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/3/3e/Phaeomyias_tumbezana_-_Tumbesian_Tyrannulet_XC251321.mp3"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "suiriri-piquirrojo",
    "image": "img/aves/suiriri-piquirrojo.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Suirirí Piquirrojo",
    "scientificName": "Dendrocygna autumnalis",
    "family": "Anatidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Lagunas, humedales y arrozales",
    "category": "residente",
    "categoryLabel": "Residente Gregario",
    "status": "Preocupación Menor (LC)",
    "description": "Pato silbador de pico rosado-rojizo y patas rosadas, muy gregario en lagunas, arrozales y humedales.",
    "physicalCharacteristics": "Pato silbador de pico rosado-rojizo y patas rosadas.",
    "diet": "Semillas, plantas acuáticas y algunos invertebrados.",
    "behavior": "Gregario, activo en grupos; consume material vegetal en ambientes acuáticos. A menudo anida en cavidades de árboles o sitios protegidos.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/suiriri-piquirrojo.jpg",
          "label": "Suirirí piquirrojo (Dendrocygna autumnalis). Foto de referencia externa: Alan D. Wilson (Wikimedia Commons, CC BY-SA 2.5)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE SUIRIRÍ PIQUIRROJO]",
      "audioDuration": "0:22",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/9/9d/Dendrocygna_autumnalis_-_Black-bellied_Whistling_Duck_XC541688.mp3"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "elanio-enano",
    "image": "img/aves/elanio-enano.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Elanio Enano",
    "scientificName": "Gampsonyx swainsonii",
    "family": "Accipitridae",
    "habitatType": "cafetal-agroecosistema",
    "habitatLabel": "Pastizales, sabanas y campos abiertos con árboles dispersos",
    "category": "residente",
    "categoryLabel": "Residente Rapaz",
    "status": "Preocupación Menor (LC)",
    "description": "Rapaz pequeña de dorso grisáceo y partes inferiores claras que acecha desde perchas descubiertas en sabanas y campos.",
    "physicalCharacteristics": "Rapaz pequeña de dorso grisáceo y partes inferiores claras.",
    "diet": "Insectos grandes, lagartijas y pequeños vertebrados.",
    "behavior": "Acecha desde perchas y desciende rápidamente sobre sus presas. Nido pequeño de ramas colocado en árboles.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/elanio-enano.jpg",
          "label": "Elanio enano (Gampsonyx swainsonii). Foto de referencia externa: Tony1957 (Wikimedia Commons, CC BY-SA 3.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE ELANIO ENANO]",
      "audioDuration": "0:15",
      "audioSample": null
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "suiriri-cariblanco",
    "image": "img/aves/suiriri-cariblanco.jpg",
    "imageFit": "cover",
    "imagePosition": "center 20%",
    "commonName": "Suirirí Cariblanco",
    "scientificName": "Dendrocygna viduata",
    "family": "Anatidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Lagunas, pastizales inundados y humedales",
    "category": "residente",
    "categoryLabel": "Residente Común",
    "status": "Preocupación Menor (LC)",
    "description": "Pato silbador de cara blanca contrastante y cuello oscuro que forma grupos y se comunica mediante silbidos característicos.",
    "physicalCharacteristics": "Pato silbador de cara blanca contrastante y cuello oscuro.",
    "diet": "Semillas, plantas acuáticas e invertebrados pequeños.",
    "behavior": "Forma grupos y se comunica mediante silbidos. Anida entre vegetación densa, normalmente cerca del agua.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/suiriri-cariblanco.jpg",
          "label": "Suirirí cariblanco (Dendrocygna viduata). Foto de referencia externa: Richard Bartz (Wikimedia Commons, CC BY-SA 2.5)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE SUIRIRÍ CARIBLANCO]",
      "audioDuration": "0:16",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/c/c3/Dendrocygna_viduata_call_001.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "anhinga-americana",
    "image": "img/aves/anhinga-americana.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Anhinga Americana",
    "scientificName": "Anhinga anhinga",
    "family": "Anhingidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Ríos tranquilos, lagunas y humedales arbolados",
    "category": "residente",
    "categoryLabel": "Residente Acuática",
    "status": "Preocupación Menor (LC)",
    "description": "Ave acuática de cuello largo y pico puntiagudo; suele extender las alas para secarlas al sol tras bucear en busca de peces.",
    "physicalCharacteristics": "Ave acuática de cuello largo y pico puntiagudo; suele extender las alas para secarlas.",
    "diet": "Peces y otros pequeños animales acuáticos.",
    "behavior": "Nada y bucea con gran parte del cuerpo sumergido; captura peces bajo el agua. Nidos de ramas en árboles, con frecuencia cerca de otras aves acuáticas.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/anhinga-americana.jpg",
          "label": "Anhinga americana (Anhinga anhinga). Foto de referencia externa: Daniel Schwen (Wikimedia Commons, CC BY-SA 4.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE ANHINGA AMERICANA]",
      "audioDuration": "0:20",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/d/d5/Anhinga_Everglades_National_Park.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "polluela-sora",
    "image": "img/aves/polluela-sora.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Polluela Sora",
    "scientificName": "Porzana carolina",
    "family": "Rallidae",
    "habitatType": "humedal-rio",
    "habitatLabel": "Pantanos y humedales con juncos o vegetación emergente",
    "category": "migratoria",
    "categoryLabel": "Migratoria Boreal",
    "status": "Preocupación Menor (LC)",
    "description": "Rálido pequeño y discreto, de pico corto y cuerpo compacto que se mueve entre vegetación palustre densa.",
    "physicalCharacteristics": "Rálido pequeño y discreto, de pico corto y cuerpo compacto.",
    "diet": "Semillas, insectos, caracoles y pequeños invertebrados.",
    "behavior": "Se mueve entre vegetación densa y suele detectarse más por su voz que por observación directa. Nido oculto en vegetación palustre; reproducción principalmente en Norteamérica.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Migratoria boreal. Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/polluela-sora.jpg",
          "label": "Polluela sora (Porzana carolina). Foto de referencia externa: Elaine R. Wilson (Wikimedia Commons, CC BY-SA 2.5)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE POLLUELA SORA]",
      "audioDuration": "0:15",
      "audioSample": "https://upload.wikimedia.org/wikipedia/commons/1/16/Porzana_carolina_-_Sora_-_XC111154.ogg"
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  },
  {
    "id": "ermitano-hirsuto",
    "image": "img/aves/ermitano-hirsuto.jpg",
    "imageFit": "cover",
    "imagePosition": "center",
    "commonName": "Ermitaño Hirsuto",
    "scientificName": "Glaucis hirsutus",
    "family": "Trochilidae",
    "habitatType": "bosque-andino",
    "habitatLabel": "Bosques húmedos, sotobosque y vegetación ribereña",
    "category": "residente",
    "categoryLabel": "Residente Nectarívoro",
    "status": "Preocupación Menor (LC)",
    "description": "Colibrí de pico largo y curvo, tonos bronceados y verdosos que visita flores en el sotobosque y participa activamente en la polinización.",
    "physicalCharacteristics": "Colibrí de pico largo y curvo, tonos bronceados y verdosos.",
    "diet": "Néctar floral y pequeños artrópodos.",
    "behavior": "Visita flores y participa en la polinización; también consume insectos. Nido colgante o adherido a vegetación, construido con fibras vegetales.",
    "distribution": "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    "multimedia": {
      "photos": [
        {
          "id": 1,
          "src": "img/aves/ermitano-hirsuto.jpg",
          "label": "Ermitaño hirsuto (Glaucis hirsutus). Foto de referencia externa: Dominic Sherony (Wikimedia Commons, CC BY-SA 2.0)."
        },
        {
          "id": 2,
          "label": "[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]"
        },
        {
          "id": 3,
          "label": "[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]"
        }
      ],
      "videoPlaceholder": "[PLACEHOLDER DE VIDEO: REGISTRO DE ERMITAÑO HIRSUTO]",
      "audioDuration": "0:15",
      "audioSample": null
    },
    "sighting": {
      "locationName": "Santander de Quilichao (No documentado en fuentes primarias)",
      "zone": "Inventario municipal general (UNAD, 2022)",
      "date": "Sin fecha verificable",
      "notes": "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
      "coords": null,
      "elevation": "No documentado"
    }
  }
];
