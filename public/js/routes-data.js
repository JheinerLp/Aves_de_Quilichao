/**
 * routes-data.js - BioAves Quilichao
 * Estructura de datos estandarizada para el Módulo de Senderos y Rutas Ecológicas
 * Santander de Quilichao, Cauca.
 */

const BIOAVES_ROUTES = [
  {
    id: "sendero-rio-quilichao",
    nombre: "Sendero Ecológico Río Quilichao",
    descripcion: "Paseo ribereño sombreado por sauces, yarumos y vegetación de galería a lo largo del Río Quilichao. Excelente para observación matutina de aves acuáticas y paseriformes.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/sendero-rio-quilichao.jpg",
    latitud: 3.0145,
    longitud: -76.4880,
    distancia: "2.4 km",
    duracion: "1 h 15 min",
    dificultad: "Fácil",
    tipo: "Sendero Fluvial y Parque Lineal",
    desnivel: "1.055 - 1.070 msnm (+15 m)",
    aves_destacadas: ["Momoto Andino", "Azulejo Común", "Garza Tigre", "Martín Pescador"],
    aves_ids: ["momoto-andino", "azulejo-comun", "garza-tigre"],
    recomendaciones: "Ruta peatonal accesible para toda la familia. Se sugiere calzado cómodo, binoculares y realizar el recorrido entre las 06:00 y las 09:00.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0098, -76.4855],
      [3.0105, -76.4862],
      [3.0112, -76.4870],
      [3.0123, -76.4876],
      [3.0135, -76.4879],
      [3.0145, -76.4880]
    ]
  },
  {
    id: "reserva-san-antonio",
    nombre: "Reserva Forestal Vereda San Antonio",
    descripcion: "Fragmento de bosque andino y de niebla en las estribaciones de la Cordillera Central. Refugio vital de especies amenazadas como la Pava Caucana y orquídeas nativas.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/reserva-san-antonio.jpg",
    latitud: 3.0520,
    longitud: -76.4410,
    distancia: "6.8 km",
    duracion: "2 h 45 min",
    dificultad: "Moderado",
    tipo: "Reserva Natural y Bosque de Niebla",
    desnivel: "1.060 - 1.750 msnm (+690 m)",
    aves_destacadas: ["Pava Caucana", "Barranquero Coronado", "Tucancito Esmeralda", "Tangara Coronidorada"],
    aves_ids: ["pava-caucana", "momoto-andino"],
    recomendaciones: "Sendero de montaña con humedad alta y gradiente pronunciado. Requiere botas de campo, impermeable y coordinación con guías locales de la vereda.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0130, -76.4810],
      [3.0195, -76.4750],
      [3.0270, -76.4670],
      [3.0350, -76.4580],
      [3.0430, -76.4495],
      [3.0520, -76.4410]
    ]
  },
  {
    id: "humedal-el-saman",
    nombre: "Humedal El Samán y Microcuenca Sur",
    descripcion: "Ecosistema léntico urbano-rural con lagunas someras, juncales y franjas de samanes centenarios. Punto estratégico de descanso para aves migratorias boreales y zancudas.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/humedal-el-saman.jpg",
    latitud: 2.9920,
    longitud: -76.4715,
    distancia: "3.1 km",
    duracion: "1 h 30 min",
    dificultad: "Fácil",
    tipo: "Humedal y Ecosistema Acuático",
    desnivel: "1.045 - 1.056 msnm (+11 m)",
    aves_destacadas: ["Garza Tigre Cuellifasta", "Polla de Agua", "Suiriri Piquirrojo", "Garceta Azul"],
    aves_ids: ["garza-tigre", "suiriri-piquirrojo", "garceta-azul"],
    recomendaciones: "Terreno plano y de fácil acceso. Recomendado llevar repelente ecológico, gorra para el sol y telescopio o binoculares para observación acuática.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0050, -76.4830],
      [3.0005, -76.4795],
      [2.9960, -76.4760],
      [2.9935, -76.4735],
      [2.9920, -76.4715]
    ]
  },
  {
    id: "cerro-belen",
    nombre: "Sendero Cerro y Mirador de Belén",
    descripcion: "Ascenso hacia el cerro tutelar de Santander de Quilichao coronado por la tradicional Capilla de Belén. Ofrece una vista panorámica de 360 grados sobre el valle geográfico y la cordillera.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/cerro-belen.jpg",
    latitud: 3.0040,
    longitud: -76.4910,
    distancia: "1.8 km",
    duracion: "50 min",
    dificultad: "Moderado",
    tipo: "Mirador Panorámico y Cerro Tutelar",
    desnivel: "1.056 - 1.130 msnm (+74 m)",
    aves_destacadas: ["Currucutú Común", "Gavilán Caminero", "Tortolita Azulada", "Colibrí Colirrufo"],
    aves_ids: ["buho-currucutu", "colibri-colirrufo"],
    recomendaciones: "Sendero empedrado con tramos de escalinatas. Ideal para avistamiento en el atardecer y anochecer para detectar rapaces nocturnas como el currucutú.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0080, -76.4870],
      [3.0065, -76.4890],
      [3.0052, -76.4902],
      [3.0040, -76.4910]
    ]
  },
  {
    id: "faldas-mondomo",
    nombre: "Ruta Agroecológica Faldas de Mondomo",
    descripcion: "Circuito entre fincas agroecológicas, cafetales bajo sombra y cañadas naturales en el corregimiento de Mondomo. Gran densidad de tráupidos y carpinteros.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/faldas-mondomo.jpg",
    latitud: 2.9720,
    longitud: -76.5310,
    distancia: "8.5 km",
    duracion: "3 h 15 min",
    dificultad: "Moderado",
    tipo: "Zona Cafetera y Piedemonte Andino",
    desnivel: "1.056 - 1.280 msnm (+224 m)",
    aves_destacadas: ["Tangara Rastrojera", "Chicao", "Semillero Coliblanco", "Carpintero Habado"],
    aves_ids: ["tangara-rastrojera", "chicao", "carpintero-habado"],
    recomendaciones: "Vía mixta (carreteable rural y senderos entre cafetales). Apoya los emprendimientos locales de café especial y solicita permiso al cruzar fincas.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0010, -76.4920],
      [2.9920, -76.5030],
      [2.9830, -76.5140],
      [2.9770, -76.5230],
      [2.9720, -76.5310]
    ]
  },
  {
    id: "guaduales-santa-ines",
    nombre: "Ruta de los Guaduales Vereda Santa Inés",
    descripcion: "Camino rural rodeado de imponentes guaduales ribereños y setos vivos tradicionales. Microhábitat propicio para colibríes, carpinteros y tiranos cazadores de insectos.",
    municipio: "Santander de Quilichao",
    departamento: "Cauca",
    imagen: "img/rutas/guaduales-santa-ines.jpg",
    latitud: 3.0210,
    longitud: -76.4680,
    distancia: "4.2 km",
    duracion: "2 h 00 min",
    dificultad: "Fácil",
    tipo: "Bosque de Guadua y Vía Rural",
    desnivel: "1.056 - 1.075 msnm (+19 m)",
    aves_destacadas: ["Colibrí Colirrufo", "Carpintero Habado", "Cucarachero Común", "Pájaro Péndulo"],
    aves_ids: ["colibri-colirrufo", "carpintero-habado"],
    recomendaciones: "Ideal para caminatas tranquilas o ciclomontañismo de baja intensidad. El follaje denso de guadua ofrece frescura incluso en horas del mediodía.",
    estado: "activo",
    punto_inicio: {
      nombre: "Parque Principal Francisco de Paula Santander",
      coords: [3.0094, -76.4847]
    },
    coordenadas_ruta: [
      [3.0094, -76.4847],
      [3.0125, -76.4800],
      [3.0160, -76.4750],
      [3.0185, -76.4710],
      [3.0210, -76.4680]
    ]
  }
];

if (typeof window !== "undefined") {
  window.BIOAVES_ROUTES = BIOAVES_ROUTES;
}
