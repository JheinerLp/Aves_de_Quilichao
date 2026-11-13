const fs = require('fs');
const path = require('path');

const NEW_SPECIES = [
  {
    id: "carrao",
    slug: "carrao",
    commonName: "Carrao",
    scientificName: "Aramus guarauna",
    family: "Aramidae",
    order: "Gruiformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Humedales, ciénagas y lagunas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Ave zancuda de plumaje pardo con marcas claras y pico largo, ligeramente curvado. Se alimenta de caracoles de agua dulce en humedales y ciénagas.",
    physicalCharacteristics: "Ave zancuda de plumaje pardo con marcas claras y pico largo, ligeramente curvado.",
    diet: "Caracoles de agua dulce, especialmente grandes caracoles acuáticos; ocasionalmente otros invertebrados.",
    behavior: "Busca moluscos en el agua somera y los extrae con el pico; su dieta lo vincula estrechamente con los humedales. Nido de material vegetal, generalmente sobre vegetación próxima al agua.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/carrao.jpg",
    photoCaption: "Carrao (Aramus guarauna). Foto de referencia externa: leppyone (Wikimedia Commons, CC BY 2.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/e/ee/Aramus_guarauna_-_Limpkin_XC250488.mp3",
    audioDuration: "0:15",
    audioDurationSec: 15,
    audioCaption: "Vocalización del Carrao (Aramus guarauna)",
    author: "leppyone",
    license: "CC BY 2.0"
  },
  {
    id: "ciguenuela-cuellinegra",
    slug: "ciguenuela-cuellinegra",
    commonName: "Cigüeñuela Cuellinegra",
    scientificName: "Himantopus mexicanus",
    family: "Recurvirostridae",
    order: "Charadriiformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Charcas someras y orillas fangosas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Ave playera de patas rosadas muy largas, dorso oscuro y partes inferiores blancas, común en charcas someras y humedales abiertos.",
    physicalCharacteristics: "Ave playera de patas rosadas muy largas, dorso oscuro y partes inferiores blancas.",
    diet: "Insectos acuáticos, larvas, crustáceos y otros invertebrados.",
    behavior: "Explora aguas poco profundas; suele emitir llamadas de alarma cerca del nido. Pone huevos sobre el suelo o pequeñas elevaciones próximas al agua.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/ciguenuela-cuellinegra.jpg",
    photoCaption: "Cigüeñuela cuellinegra (Himantopus mexicanus). Foto de referencia externa: Mike Baird (Wikimedia Commons, CC BY 2.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/c/c5/Himantopus_mexicanus_-_Black-necked_Stilt_-_XC99570.ogg",
    audioDuration: "0:20",
    audioDurationSec: 20,
    audioCaption: "Llamado de alarma de la Cigüeñuela cuellinegra",
    author: "Mike Baird",
    license: "CC BY 2.0"
  },
  {
    id: "garceta-nivea",
    slug: "garceta-nivea",
    commonName: "Garceta Nívea",
    scientificName: "Egretta thula",
    family: "Ardeidae",
    order: "Pelecaniformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Humedales, riberas y bordes de lagunas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Garza blanca pequeña y estilizada con pico negro, patas negras y característicos dedos amarillos contrastantes.",
    physicalCharacteristics: "Garza blanca pequeña con pico negro, patas negras y dedos amarillos contrastantes.",
    diet: "Peces pequeños, camarones, insectos acuáticos y anfibios.",
    behavior: "Puede mover los pies para hacer salir presas del fondo; controla poblaciones de animales acuáticos pequeños. Anida colonialmente en árboles o arbustos próximos al agua.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/garceta-nivea.jpg",
    photoCaption: "Garceta nívea (Egretta thula). Foto de referencia externa: Dori (Wikimedia Commons, CC BY-SA 3.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/93/Littleblueheronfishes.ogg",
    audioDuration: "0:10",
    audioDurationSec: 10,
    audioCaption: "Sonidos de colonia y forrajeo de garzas",
    author: "Dori",
    license: "CC BY-SA 3.0"
  },
  {
    id: "garceta-azul",
    slug: "garceta-azul",
    commonName: "Garceta Azul",
    scientificName: "Egretta caerulea",
    family: "Ardeidae",
    order: "Pelecaniformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Lagunas, orillas de ríos y humedales",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Garza de plumaje azul pizarra en adultos y blanco en juveniles, observada en lagunas y orillas de ríos.",
    physicalCharacteristics: "Garza de plumaje azul pizarra en adultos; los juveniles suelen ser blancos.",
    diet: "Peces, crustáceos, insectos acuáticos y anfibios.",
    behavior: "Camina despacio y captura presas con movimientos rápidos del pico. Suele anidar en colonias, con nidos de ramas en árboles o arbustos.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/garceta-azul.jpg",
    photoCaption: "Garceta azul (Egretta caerulea). Foto de referencia externa: Wing-Chi Poon (Wikimedia Commons, CC BY-SA 2.5).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/93/Littleblueheronfishes.ogg",
    audioDuration: "0:10",
    audioDurationSec: 10,
    audioCaption: "Sonidos de colonia y forrajeo de garzas",
    author: "Wing-Chi Poon",
    license: "CC BY-SA 2.5"
  },
  {
    id: "morito-comun",
    slug: "morito-comun",
    commonName: "Morito Común",
    scientificName: "Plegadis falcinellus",
    family: "Threskiornithidae",
    order: "Pelecaniformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Humedales y pastizales encharcados",
    category: "migratoria",
    categoryLabel: "Migratoria / Humedales",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Ibis oscuro de reflejos iridiscentes y pico largo curvado hacia abajo, habitante de pastizales húmedos y suelos fangosos.",
    physicalCharacteristics: "Ibis oscuro de reflejos iridiscentes y pico largo curvado hacia abajo.",
    diet: "Insectos, larvas, moluscos, gusanos y otros invertebrados.",
    behavior: "Sondea el lodo con el pico; conecta ambientes acuáticos y terrestres. Construye nidos de vegetación en colonias de humedales.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/morito-comun.jpg",
    photoCaption: "Morito común (Plegadis falcinellus). Foto de referencia externa: Debivort (Wikimedia Commons, CC BY-SA 2.5).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/8/8e/Glossy_ibis.ogg",
    audioDuration: "0:12",
    audioDurationSec: 12,
    audioCaption: "Llamados del Morito común en vuelo",
    author: "Debivort",
    license: "CC BY-SA 2.5"
  },
  {
    id: "caracolero-comun",
    slug: "caracolero-comun",
    commonName: "Caracolero Común",
    scientificName: "Rostrhamus sociabilis",
    family: "Accipitridae",
    order: "Accipitriformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Ciénagas y humedales de agua dulce",
    category: "residente",
    categoryLabel: "Residente Especialista",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Rapaz de pico fuertemente curvado y garras adaptadas para manipular presas, especializada en caracoles acuáticos Pomacea.",
    physicalCharacteristics: "Rapaz de pico fuertemente curvado y garras adaptadas para manipular presas.",
    diet: "Principalmente caracoles acuáticos del género Pomacea.",
    behavior: "Captura caracoles y extrae el cuerpo de la concha; es un depredador especializado. Nido de ramas y vegetación en árboles o plantas emergentes.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/caracolero-comun.jpg",
    photoCaption: "Caracolero común (Rostrhamus sociabilis). Foto de referencia externa: Claudney Neves (Wikimedia Commons, CC BY-SA 3.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/97/Rostrhamus_sociabilis_-_Snail_Kite_XC251465.mp3",
    audioDuration: "0:15",
    audioDurationSec: 15,
    audioCaption: "Llamado del Caracolero común (Rostrhamus sociabilis)",
    author: "Claudney Neves",
    license: "CC BY-SA 3.0"
  },
  {
    id: "bandurria-comun",
    slug: "bandurria-comun",
    commonName: "Bandurria Común",
    scientificName: "Theristicus caudatus",
    family: "Threskiornithidae",
    order: "Pelecaniformes",
    habitatType: "cafetal-agroecosistema",
    habitatSlug: "cafetal-agroecosistema",
    habitatLabel: "Potreros, pastizales y sabanas abiertas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Ibis grande de cuello claro, cuerpo grisáceo y pico largo curvado, frecuente en potreros y terrenos abiertos.",
    physicalCharacteristics: "Ibis grande de cuello claro, cuerpo grisáceo y pico largo curvado.",
    diet: "Insectos, lombrices y pequeños vertebrados.",
    behavior: "Busca presas caminando sobre el suelo; puede observarse en parejas o grupos. Nido voluminoso de ramas en árboles, según disponibilidad del entorno.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/bandurria-comun.jpg",
    photoCaption: "Bandurria común (Theristicus caudatus). Foto de referencia externa: Dario Sanches (Wikimedia Commons, CC BY-SA 2.0).",
    audioSample: null,
    audioDuration: "0:15",
    audioDurationSec: null,
    audioCaption: null,
    author: "Dario Sanches",
    license: "CC BY-SA 2.0"
  },
  {
    id: "golondrina-pechigris",
    slug: "golondrina-pechigris",
    commonName: "Golondrina Pechigrís",
    scientificName: "Progne chalybea",
    family: "Hirundinidae",
    order: "Passeriformes",
    habitatType: "urbano-jardines",
    habitatSlug: "urbano-jardines",
    habitatLabel: "Espacios abiertos, fincas y áreas urbanas",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Golondrina de dorso azul oscuro brillante y pecho grisáceo, común en áreas urbanas, fincas y sobrevolando aguas.",
    physicalCharacteristics: "Golondrina de dorso azul oscuro brillante y pecho grisáceo.",
    diet: "Insectos voladores capturados en el aire.",
    behavior: "Vuelo rápido y maniobrable; contribuye al consumo de insectos aéreos. Puede usar cavidades y estructuras construidas para anidar.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/golondrina-pechigris.jpg",
    photoCaption: "Golondrina pechigrís (Progne chalybea). Foto de referencia externa: Cláudio Dias Timm (Wikimedia Commons, CC BY-SA 2.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/9f/Progne_chalybea_-_Grey-breasted_Martin_XC243000.mp3",
    audioDuration: "0:18",
    audioDurationSec: 18,
    audioCaption: "Trino de la Golondrina pechigrís (Progne chalybea)",
    author: "Cláudio Dias Timm",
    license: "CC BY-SA 2.0"
  },
  {
    id: "piojito-pardo",
    slug: "piojito-pardo",
    commonName: "Piojito Pardo",
    scientificName: "Nesotriccus murinus",
    family: "Tyrannidae",
    order: "Passeriformes",
    habitatType: "cafetal-agroecosistema",
    habitatSlug: "cafetal-agroecosistema",
    habitatLabel: "Matorrales, rastrojos y vegetación secundaria",
    category: "residente",
    categoryLabel: "Residente Discreto",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Pequeño atrapamoscas de tonos pardos y vientre más claro que forrajea activamente entre matorrales y rastrojos.",
    physicalCharacteristics: "Pequeño atrapamoscas de tonos pardos y vientre más claro.",
    diet: "Insectos y otros artrópodos pequeños.",
    behavior: "Se posa en ramas y hace vuelos cortos para atrapar presas. Nido pequeño de fibras vegetales, normalmente oculto entre ramas.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sinónimo taxonómico previo: Phaeomyias murina. Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/piojito-pardo.jpg",
    photoCaption: "Piojito pardo (Nesotriccus murinus). Ilustración zoológica de referencia: John Jennens (Dominio Público).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/3/3e/Phaeomyias_tumbezana_-_Tumbesian_Tyrannulet_XC251321.mp3",
    audioDuration: "0:14",
    audioDurationSec: 14,
    audioCaption: "Vocalización representativa de tiranino afín (Phaeomyias / Nesotriccus)",
    author: "John Jennens",
    license: "Public domain"
  },
  {
    id: "suiriri-piquirrojo",
    slug: "suiriri-piquirrojo",
    commonName: "Suirirí Piquirrojo",
    scientificName: "Dendrocygna autumnalis",
    family: "Anatidae",
    order: "Anseriformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Lagunas, humedales y arrozales",
    category: "residente",
    categoryLabel: "Residente Gregario",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Pato silbador de pico rosado-rojizo y patas rosadas, muy gregario en lagunas, arrozales y humedales.",
    physicalCharacteristics: "Pato silbador de pico rosado-rojizo y patas rosadas.",
    diet: "Semillas, plantas acuáticas y algunos invertebrados.",
    behavior: "Gregario, activo en grupos; consume material vegetal en ambientes acuáticos. A menudo anida en cavidades de árboles o sitios protegidos.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/suiriri-piquirrojo.jpg",
    photoCaption: "Suirirí piquirrojo (Dendrocygna autumnalis). Foto de referencia externa: Alan D. Wilson (Wikimedia Commons, CC BY-SA 2.5).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/9/9d/Dendrocygna_autumnalis_-_Black-bellied_Whistling_Duck_XC541688.mp3",
    audioDuration: "0:22",
    audioDurationSec: 22,
    audioCaption: "Silbidos en vuelo del Suirirí piquirrojo (Dendrocygna autumnalis)",
    author: "Alan D. Wilson",
    license: "CC BY-SA 2.5"
  },
  {
    id: "elanio-enano",
    slug: "elanio-enano",
    commonName: "Elanio Enano",
    scientificName: "Gampsonyx swainsonii",
    family: "Accipitridae",
    order: "Accipitriformes",
    habitatType: "cafetal-agroecosistema",
    habitatSlug: "cafetal-agroecosistema",
    habitatLabel: "Pastizales, sabanas y campos abiertos con árboles dispersos",
    category: "residente",
    categoryLabel: "Residente Rapaz",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Rapaz pequeña de dorso grisáceo y partes inferiores claras que acecha desde perchas descubiertas en sabanas y campos.",
    physicalCharacteristics: "Rapaz pequeña de dorso grisáceo y partes inferiores claras.",
    diet: "Insectos grandes, lagartijas y pequeños vertebrados.",
    behavior: "Acecha desde perchas y desciende rápidamente sobre sus presas. Nido pequeño de ramas colocado en árboles.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/elanio-enano.jpg",
    photoCaption: "Elanio enano (Gampsonyx swainsonii). Foto de referencia externa: Tony1957 (Wikimedia Commons, CC BY-SA 3.0).",
    audioSample: null,
    audioDuration: "0:15",
    audioDurationSec: null,
    audioCaption: null,
    author: "Tony1957",
    license: "CC BY-SA 3.0"
  },
  {
    id: "suiriri-cariblanco",
    slug: "suiriri-cariblanco",
    commonName: "Suirirí Cariblanco",
    scientificName: "Dendrocygna viduata",
    family: "Anatidae",
    order: "Anseriformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Lagunas, pastizales inundados y humedales",
    category: "residente",
    categoryLabel: "Residente Común",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Pato silbador de cara blanca contrastante y cuello oscuro que forma grupos y se comunica mediante silbidos característicos.",
    physicalCharacteristics: "Pato silbador de cara blanca contrastante y cuello oscuro.",
    diet: "Semillas, plantas acuáticas e invertebrados pequeños.",
    behavior: "Forma grupos y se comunica mediante silbidos. Anida entre vegetación densa, normalmente cerca del agua.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/suiriri-cariblanco.jpg",
    photoCaption: "Suirirí cariblanco (Dendrocygna viduata). Foto de referencia externa: Richard Bartz (Wikimedia Commons, CC BY-SA 2.5).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/c/c3/Dendrocygna_viduata_call_001.ogg",
    audioDuration: "0:16",
    audioDurationSec: 16,
    audioCaption: "Silbidos tritonados del Suirirí cariblanco (Dendrocygna viduata)",
    author: "Richard Bartz",
    license: "CC BY-SA 2.5"
  },
  {
    id: "anhinga-americana",
    slug: "anhinga-americana",
    commonName: "Anhinga Americana",
    scientificName: "Anhinga anhinga",
    family: "Anhingidae",
    order: "Suliformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Ríos tranquilos, lagunas y humedales arbolados",
    category: "residente",
    categoryLabel: "Residente Acuática",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Ave acuática de cuello largo y pico puntiagudo; suele extender las alas para secarlas al sol tras bucear en busca de peces.",
    physicalCharacteristics: "Ave acuática de cuello largo y pico puntiagudo; suele extender las alas para secarlas.",
    diet: "Peces y otros pequeños animales acuáticos.",
    behavior: "Nada y bucea con gran parte del cuerpo sumergido; captura peces bajo el agua. Nidos de ramas en árboles, con frecuencia cerca de otras aves acuáticas.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/anhinga-americana.jpg",
    photoCaption: "Anhinga americana (Anhinga anhinga). Foto de referencia externa: Daniel Schwen (Wikimedia Commons, CC BY-SA 4.0).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/d/d5/Anhinga_Everglades_National_Park.ogg",
    audioDuration: "0:20",
    audioDurationSec: 20,
    audioCaption: "Vocalizaciones de colonia de Anhinga americana",
    author: "Daniel Schwen",
    license: "CC BY-SA 4.0"
  },
  {
    id: "polluela-sora",
    slug: "polluela-sora",
    commonName: "Polluela Sora",
    scientificName: "Porzana carolina",
    family: "Rallidae",
    order: "Gruiformes",
    habitatType: "humedal-rio",
    habitatSlug: "humedal-rio",
    habitatLabel: "Pantanos y humedales con juncos o vegetación emergente",
    category: "migratoria",
    categoryLabel: "Migratoria Boreal",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Rálido pequeño y discreto, de pico corto y cuerpo compacto que se mueve entre vegetación palustre densa.",
    physicalCharacteristics: "Rálido pequeño y discreto, de pico corto y cuerpo compacto.",
    diet: "Semillas, insectos, caracoles y pequeños invertebrados.",
    behavior: "Se mueve entre vegetación densa y suele detectarse más por su voz que por observación directa. Nido oculto en vegetación palustre; reproducción principalmente en Norteamérica.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Migratoria boreal. Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/polluela-sora.jpg",
    photoCaption: "Polluela sora (Porzana carolina). Foto de referencia externa: Elaine R. Wilson (Wikimedia Commons, CC BY-SA 2.5).",
    audioSample: "https://upload.wikimedia.org/wikipedia/commons/1/16/Porzana_carolina_-_Sora_-_XC111154.ogg",
    audioDuration: "0:15",
    audioDurationSec: 15,
    audioCaption: "Llamados descendentes de la Polluela sora (Porzana carolina)",
    author: "Elaine R. Wilson",
    license: "CC BY-SA 2.5"
  },
  {
    id: "ermitano-hirsuto",
    slug: "ermitano-hirsuto",
    commonName: "Ermitaño Hirsuto",
    scientificName: "Glaucis hirsutus",
    family: "Trochilidae",
    order: "Apodiformes",
    habitatType: "bosque-andino",
    habitatSlug: "bosque-andino",
    habitatLabel: "Bosques húmedos, sotobosque y vegetación ribereña",
    category: "residente",
    categoryLabel: "Residente Nectarívoro",
    status: "Preocupación Menor (LC)",
    uicn_status: "LC",
    is_featured: false,
    description: "Colibrí de pico largo y curvo, tonos bronceados y verdosos que visita flores en el sotobosque y participa activamente en la polinización.",
    physicalCharacteristics: "Colibrí de pico largo y curvo, tonos bronceados y verdosos.",
    diet: "Néctar floral y pequeños artrópodos.",
    behavior: "Visita flores y participa en la polinización; también consume insectos. Nido colgante o adherido a vegetación, construido con fibras vegetales.",
    distribution: "Mención nominal en inventario ornitológico municipal de Santander de Quilichao (UNAD, 2022). Sin registro individual con coordenadas verificables en fuentes primarias; localidad específica: No documentado.",
    image: "img/aves/ermitano-hirsuto.jpg",
    photoCaption: "Ermitaño hirsuto (Glaucis hirsutus). Foto de referencia externa: Dominic Sherony (Wikimedia Commons, CC BY-SA 2.0).",
    audioSample: null,
    audioDuration: "0:15",
    audioDurationSec: null,
    audioCaption: null,
    author: "Dominic Sherony",
    license: "CC BY-SA 2.0"
  }
];

function updateBirdsDataFiles() {
  const filePaths = [
    path.join(__dirname, '..', 'public', 'js', 'birds-data.js'),
    path.join(__dirname, '..', 'js', 'birds-data.js'),
  ];

  for (const fPath of filePaths) {
    if (!fs.existsSync(fPath)) continue;
    const content = fs.readFileSync(fPath, 'utf8');
    const existingData = new Function(content + '; return BIOAVES_DATA;')();

    // Check duplicates and append
    const updatedList = [...existingData];
    let added = 0;
    let skipped = 0;

    for (const s of NEW_SPECIES) {
      const idx = updatedList.findIndex(e => e.id === s.id || e.scientificName.toLowerCase() === s.scientificName.toLowerCase());
      const birdObj = {
        id: s.id,
        commonName: s.commonName,
        scientificName: s.scientificName,
        family: s.family,
        habitatType: s.habitatType,
        habitatLabel: s.habitatLabel,
        category: s.category,
        categoryLabel: s.categoryLabel,
        status: s.status,
        description: s.description,
        physicalCharacteristics: s.physicalCharacteristics,
        diet: s.diet,
        behavior: s.behavior,
        distribution: s.distribution,
        image: s.image,
        imageFit: "cover",
        imagePosition: "center",
        multimedia: {
          photos: [
            { id: 1, src: s.image, label: s.photoCaption },
            { id: 2, label: `[FOTOGRAFÍA 2 DE 3: DETALLE O SILUETA EN HÁBITAT]` },
            { id: 3, label: `[FOTOGRAFÍA 3 DE 3: COMPORTAMIENTO]` }
          ],
          videoPlaceholder: `[PLACEHOLDER DE VIDEO: REGISTRO DE ${s.commonName.toUpperCase()}]`,
          audioDuration: s.audioDuration,
          audioSample: s.audioSample
        },
        sighting: {
          locationName: "Santander de Quilichao (No documentado en fuentes primarias)",
          zone: "Inventario municipal general (UNAD, 2022)",
          date: "Sin fecha verificable",
          notes: "Mención nominal en inventario ornitológico municipal (UNAD, 2022 / eBird). Sin coordenadas comprobables.",
          coords: null,
          elevation: "No documentado"
        }
      };

      if (idx >= 0) {
        updatedList[idx] = birdObj;
        skipped++;
      } else {
        updatedList.push(birdObj);
        added++;
      }
    }

    const header = `/**\n * birds-data.js - BioAves Quilichao\n * Base de datos estructurada con las 25 especies registradas para Santander de Quilichao.\n */\n\nconst BIOAVES_DATA = `;
    const output = header + JSON.stringify(updatedList, null, 2) + ';\n';
    fs.writeFileSync(fPath, output, 'utf8');
    console.log(`Updated ${path.basename(path.dirname(fPath))}/${path.basename(fPath)}: ${added} added, ${skipped} updated, total ${updatedList.length}`);
  }
}

function updateCreditosMultimedia() {
  const credPath = path.join(__dirname, '..', 'CREDITOS_MULTIMEDIA.md');
  let credContent = fs.readFileSync(credPath, 'utf8');

  for (const s of NEW_SPECIES) {
    if (!credContent.includes(s.scientificName)) {
      const row = `| ${s.commonName} (*${s.scientificName}*) | ${s.author} | Wikimedia Commons ([${s.license}](https://creativecommons.org/)) | Referencia visual externa; no es registro municipal primario | \`public/${s.image}\` |\n`;
      credContent += row;
    }
  }

  fs.writeFileSync(credPath, credContent, 'utf8');
  console.log(`Updated CREDITOS_MULTIMEDIA.md with all new species attributions.`);
}

function updateCatalogoJsFiles() {
  const catPaths = [
    path.join(__dirname, '..', 'public', 'js', 'catalogo.js'),
    path.join(__dirname, '..', 'js', 'catalogo.js')
  ];

  for (const p of catPaths) {
    if (!fs.existsSync(p)) continue;
    let code = fs.readFileSync(p, 'utf8');
    // Ensure coordsEl handles null gracefully
    const target = `    if (coordsEl && Array.isArray(bird.sighting.coords)) {
      coordsEl.textContent = \`Coordenadas: \${bird.sighting.coords[0].toFixed(4)}° N, \${bird.sighting.coords[1].toFixed(4)}° W\`;
    }`;
    const replacement = `    if (coordsEl) {
      coordsEl.textContent = Array.isArray(bird.sighting.coords)
        ? \`Coordenadas: \${bird.sighting.coords[0].toFixed(4)}° N, \${bird.sighting.coords[1].toFixed(4)}° W\`
        : "Coordenadas: No documentado";
    }`;
    if (code.includes(target)) {
      code = code.replace(target, replacement);
      fs.writeFileSync(p, code, 'utf8');
      console.log(`Patched coords display in ${path.basename(p)}`);
    }
  }
}

function updateSpeciesSeederPhp() {
  const seederPath = path.join(__dirname, '..', 'database', 'seeders', 'SpeciesSeeder.php');
  let content = fs.readFileSync(seederPath, 'utf8');

  // We build the array of 15 species to append to $speciesList
  let phpEntries = NEW_SPECIES.map(s => {
    const audioBlock = s.audioSample ? `
                'audio' => [
                    'url' => '${s.audioSample}',
                    'caption' => '${s.audioCaption}',
                    'duration' => ${s.audioDurationSec},
                ],` : `
                'audio' => null,`;

    return `            [
                'slug' => '${s.slug}',
                'common_name' => '${s.commonName}',
                'scientific_name' => '${s.scientificName}',
                'family' => '${s.family}',
                'habitat_slug' => '${s.habitatSlug}',
                'category' => '${s.category}',
                'uicn_status' => '${s.uicn_status}',
                'is_featured' => false,
                'description' => '${s.description.replace(/'/g, "\\'")}',
                'physical_characteristics' => '${s.physicalCharacteristics.replace(/'/g, "\\'")}',
                'diet' => '${s.diet.replace(/'/g, "\\'")}',
                'behavior' => '${s.behavior.replace(/'/g, "\\'")}',
                'distribution' => '${s.distribution.replace(/'/g, "\\'")}',
                'photos' => [
                    ['caption' => '${s.photoCaption.replace(/'/g, "\\'")}', 'file' => '${path.basename(s.image)}', 'asset' => '${s.image}'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO]', 'file' => '${s.slug}-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: AVE EN HÁBITAT]', 'file' => '${s.slug}-3.svg'],
                ],${audioBlock}
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: REGISTRO DE ${s.commonName.toUpperCase()}]',
                    'file' => 'video-${s.slug}.mp4',
                ],
            ],`;
  }).join('\n');

  // Insert before the closing bracket of $speciesList
  // Target: the end of Megascops choliba block before `        ];`
  const target = `                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: LLAMADO NOCTURNO "CURRU-CU-TÚ"]',
                    'file' => 'video-currucutu.mp4',
                ],
            ],
        ];`;

  if (content.includes(target)) {
    const replacement = `                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: LLAMADO NOCTURNO "CURRU-CU-TÚ"]',
                    'file' => 'video-currucutu.mp4',
                ],
            ],
${phpEntries}
        ];`;
    content = content.replace(target, replacement);
    fs.writeFileSync(seederPath, content, 'utf8');
    console.log(`Appended 15 species into database/seeders/SpeciesSeeder.php`);
  } else {
    console.warn(`Target not found in SpeciesSeeder.php, check manually`);
  }
}

updateBirdsDataFiles();
updateCreditosMultimedia();
updateCatalogoJsFiles();
updateSpeciesSeederPhp();
console.log('Integrations prepared successfully!');

