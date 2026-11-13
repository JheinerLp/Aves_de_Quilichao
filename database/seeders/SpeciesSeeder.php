<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Habitat;
use App\Models\Media;
use App\Models\Species;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $speciesList = [
            [
                'slug' => 'momoto-andino',
                'common_name' => 'Momoto Andino (Barranquero)',
                'scientific_name' => 'Momotus aequatorialis',
                'family' => 'Momotidae',
                'habitat_slug' => 'bosque-andino',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Ave arborícola de tamaño mediano caracterizada por su corona azul turquesa, antifaz negro y cola larga terminada en dos raquetas desnudas que balancea como péndulo ante posibles amenazas o interacción territorial.',
                'physical_characteristics' => 'Longitud de 48 a 50 cm. Plumaje predominantemente verde oliva con tonos canela en el pecho. Iris rojo encendido y pico aserrado adaptado a la captura de presas resbaladizas.',
                'diet' => 'Omnívora: escarabajos, grillos, lagartijas pequeñas, ranas y frutos silvestres de yarumo y arrayán.',
                'behavior' => 'Solitario o en parejas. Permanece inmóvil en perchas sombreadas del estrato medio antes de lanzarse en vuelo directo hacia el suelo o follaje.',
                'distribution' => 'Cordillera Central y Occidental de los Andes, entre 1.000 y 2.400 msnm.',
                'photos' => [
                    ['caption' => 'Momoto Andino registrado en Santander de Quilichao. Foto: Litrato15 (iNaturalist, CC BY-NC); mejora técnica con IA.', 'file' => 'momoto-andino.png', 'asset' => 'img/aves/momoto-andino.png'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE CORONA Y PICO]', 'file' => 'momoto-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: AVE EN HÁBITAT RIBEREÑO]', 'file' => 'momoto-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4e/Momotus_aequatorialis_-_Blue-crowned_Motmot_XC28717.ogg',
                    'caption' => 'Canto territorial del Momoto Andino',
                    'duration' => 28,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: COMPORTAMIENTO DE BALANCEO DE COLA]',
                    'file' => 'video-momoto.mp4',
                ],
            ],
            [
                'slug' => 'chicao',
                'common_name' => 'Chicao',
                'scientific_name' => 'Icterus nigrogularis',
                'family' => 'Icteridae',
                'habitat_slug' => 'cafetal-agroecosistema',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Ave amarilla y negra conocida localmente como Chicao o Pájaro de Oro. Es una especie emblemática de Santander de Quilichao y suele observarse en árboles altos, bordes de bosque y zonas abiertas arboladas.',
                'physical_characteristics' => 'Ave mediana de plumaje amarillo intenso, alas y cola negras, con una máscara oscura alrededor del ojo y la garganta.',
                'diet' => 'Omnívora: consume insectos, frutos, néctar y flores.',
                'behavior' => 'Se desplaza en parejas o grupos pequeños y vocaliza con frecuencia desde perchas visibles.',
                'distribution' => 'Presente en zonas cálidas y premontanas del norte del Cauca, en ambientes abiertos con árboles y bordes de bosque.',
                'photos' => [
                    ['caption' => 'Chicao posado entre el follaje', 'file' => 'CHICAO.png', 'asset' => 'img/aves/CHICAO.png'],
                    ['caption' => '[FOTOGRAFÍA PENDIENTE: DETALLE DEL PLUMAJE AMARILLO Y NEGRO]', 'file' => 'chicao-2.svg'],
                    ['caption' => '[FOTOGRAFÍA PENDIENTE: CHICAO EN SU HÁBITAT]', 'file' => 'chicao-3.svg'],
                ],
                'audio' => null,
                'videos' => [
                    ['caption' => 'Chicao vocalizando', 'file' => 'CHICAO HABLANDO.mp4', 'asset' => 'video/CHICAO HABLANDO.mp4', 'duration' => 10],
                    ['caption' => 'Registro del canto del Chicao', 'file' => 'CHICAO SONIDO.mp4', 'asset' => 'video/CHICAO SONIDO.mp4', 'duration' => 8],
                ],
            ],
            [
                'slug' => 'pava-caucana',
                'common_name' => 'Pava Caucana',
                'scientific_name' => 'Penelope perspicax',
                'family' => 'Cracidae',
                'habitat_slug' => 'bosque-andino',
                'category' => 'endemica',
                'uicn_status' => 'EN',
                'is_featured' => true,
                'description' => 'Especie endémica de las laderas andinas del Valle del Cauca y Cauca. Ave de gran tamaño fundamental para la dispersión de semillas de árboles maderables y palmas nativas.',
                'physical_characteristics' => 'Longitud de 70 a 76 cm. Plumaje pardo oliváceo con bordes blanquecinos en el cuello y pecho. Destaca su garganta desnuda roja (gola gular) y patas rojizas.',
                'diet' => 'Frugívora estricta: frutos carnosos de laureles, higuerones y palmas de cera.',
                'behavior' => 'Habita el dosel superior en pequeños grupos familiares. Emite llamados guturales resonantes durante las primeras horas del amanecer.',
                'distribution' => 'Restringida a relictos de bosque de niebla de la vertiente occidental de la Cordillera Central (1.400 - 2.100 msnm).',
                'photos' => [
                    ['caption' => 'Pava Caucana en bosque andino', 'file' => 'PAVA CAUCANA.png', 'asset' => 'img/aves/PAVA CAUCANA.png'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE GOLA GULAR ROJA]', 'file' => 'pava-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: GRUPO FAMILIAR EN RAMAS]', 'file' => 'pava-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e4/Penelope_perspicax_-_Cauca_Guan_XC151978.ogg',
                    'caption' => 'Llamado estridente de la Pava Caucana',
                    'duration' => 34,
                ],
                'videos' => [
                    ['caption' => 'Pava Caucana vocalizando', 'file' => 'PAVA CAUCANA HABLANDO.mp4', 'asset' => 'video/PAVA CAUCANA HABLANDO.mp4', 'duration' => 10],
                    ['caption' => 'Registro del canto de la Pava Caucana', 'file' => 'PAVA CAUCANA SONIDO.mp4', 'asset' => 'video/PAVA CAUCANA SONIDO.mp4', 'duration' => 8],
                ],
            ],
            [
                'slug' => 'tangara-rastrojera',
                'common_name' => 'Tangara Rastrojera (Matorralera)',
                'scientific_name' => 'Tangara vitriolina',
                'family' => 'Thraupidae',
                'habitat_slug' => 'cafetal-agroecosistema',
                'category' => 'endemica',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Ave canora casi endémica de los valles interandinos colombianos. Muy común y activa en cercas vivas, matorrales y fincas con sombrío de plátano.',
                'physical_characteristics' => 'Longitud de 14 cm. Coronilla castaño rojizo vivo que contrasta con el plumaje grisáceo en el cuerpo y destellos verdes en alas.',
                'diet' => 'Semillas, bayas de arbustos pioneros y pequeños insectos foliares.',
                'behavior' => 'Muy inquieta, salta continuamente entre ramitas densas en parejas o formando bandadas mixtas con otras tangaras.',
                'distribution' => 'Valles del Río Cauca y Magdalena (500 a 2.200 msnm).',
                'photos' => [
                    ['caption' => 'Tangara Rastrojera. Foto de referencia externa: olegvasiliev (iNaturalist, CC BY-NC), Valle del Cauca; no corresponde a un registro municipal de Santander de Quilichao.', 'file' => 'tangara-rastrojera.jpg', 'asset' => 'img/aves/tangara-rastrojera.jpg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE CORONA CASTAÑA]', 'file' => 'tangara-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: FORRAJEANDO ENTRE MATORRALES]', 'file' => 'tangara-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Tangara_vitriolina_-_Scrub_Tanager_XC33502.ogg',
                    'caption' => 'Trino rápido de la Tangara Rastrojera',
                    'duration' => 19,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: CANTO Y ALIMENTACIÓN EN CERCA VIVA]',
                    'file' => 'video-tangara.mp4',
                ],
            ],
            [
                'slug' => 'colibri-colirrufo',
                'common_name' => 'Colibrí Colirrufo',
                'scientific_name' => 'Amazilia tzacatl',
                'family' => 'Trochilidae',
                'habitat_slug' => 'urbano-jardines',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Colibrí de tamaño medio y temperamento sumamente territorial. Defiende con agresividad sus parches de flores ante otros colibríes más grandes.',
                'physical_characteristics' => 'Longitud de 9 a 10 cm. Garganta y pecho verde metálico brillante, vientre grisáceo y cola rojizo castaño característica.',
                'diet' => 'Néctar de flores de heliconias, veraneras e hibiscos, complementado con mosquitos al vuelo.',
                'behavior' => 'Vuelo rápido en zigzag. Realiza perchas visibles en ramas secas para vigilar su territorio floral.',
                'distribution' => 'Desde el nivel del mar hasta 1.800 msnm en todo el territorio quilichagüeño.',
                'photos' => [
                    ['caption' => 'Colibrí Colirrufo posado en una rama', 'file' => 'COLIBRI.png', 'asset' => 'img/aves/COLIBRI.png'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE PICO RECTO]', 'file' => 'colibri-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: PERCHADO EN RAMA DELGADA]', 'file' => 'colibri-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/1/1a/Amazilia_tzacatl_-_Rufous-tailed_Hummingbird_XC24361.ogg',
                    'caption' => 'Chirrido territorial del Colibrí Colirrufo',
                    'duration' => 15,
                ],
                'videos' => [
                    ['caption' => 'Colibrí vocalizando', 'file' => 'COLIBIRI HABLANDO.mp4', 'asset' => 'video/COLIBIRI HABLANDO.mp4', 'duration' => 10],
                    ['caption' => 'Registro del canto del Colibrí', 'file' => 'COLIBRI SONIDO.mp4', 'asset' => 'video/COLIBRI SONIDO.mp4', 'duration' => 8],
                ],
            ],
            [
                'slug' => 'mirla-azul',
                'common_name' => 'Mirla Azul',
                'scientific_name' => 'Turdus sp. (identificación pendiente)',
                'family' => 'Turdidae',
                'habitat_slug' => 'bosque-andino',
                'category' => 'residente',
                'uicn_status' => 'NE',
                'is_featured' => true,
                'description' => 'Registro multimedia recibido con el nombre común Mirla Azul. La identificación taxonómica queda pendiente para evitar asignar una especie científica sin verificación.',
                'physical_characteristics' => 'Ave mediana de plumaje azul grisáceo, alas de azul más intenso, pico recto oscuro y cola alargada.',
                'diet' => 'Información pendiente de confirmación taxonómica.',
                'behavior' => 'En los registros se observa posada y vocalizando desde ramas expuestas.',
                'distribution' => 'Registro local en Santander de Quilichao; la distribución precisa depende de confirmar la especie.',
                'photos' => [
                    ['caption' => 'Registro fotográfico de la Mirla Azul', 'file' => 'COLIBRI COLIRRUFO.png', 'asset' => 'img/aves/COLIBRI COLIRRUFO.png'],
                    ['caption' => '[FOTOGRAFÍA PENDIENTE: VISTA FRONTAL]', 'file' => 'mirla-2.svg'],
                    ['caption' => '[FOTOGRAFÍA PENDIENTE: AVE EN SU HÁBITAT]', 'file' => 'mirla-3.svg'],
                ],
                'audio' => null,
                'videos' => [
                    ['caption' => 'Mirla Azul vocalizando', 'file' => 'MIRLA AZUL HABLANDO.mp4', 'asset' => 'video/MIRLA AZUL HABLANDO.mp4', 'duration' => 10],
                    ['caption' => 'Registro del canto de la Mirla Azul', 'file' => 'MIRLA AZUL SONIDO.mp4', 'asset' => 'video/MIRLA AZUL SONIDO.mp4', 'duration' => 8],
                ],
            ],
            [
                'slug' => 'garza-tigre',
                'common_name' => 'Garza Tigre Cuellifasta',
                'scientific_name' => 'Tigrisoma lineatum',
                'family' => 'Ardeidae',
                'habitat_slug' => 'humedal-rio',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Garza solitaria de hábitos crepusculares. Su postura rígida y su plumaje rayado le permiten camuflarse entre la enea y vegetación ribereña.',
                'physical_characteristics' => 'Longitud de 66 a 75 cm. Cuello robusto con llamativo rayado fino blanco y pardo rojizo. Pico largo y recto color cuerno.',
                'diet' => 'Peces dulceacuícolas, ranas, renacuajos y crustáceos de río.',
                'behavior' => 'Permanece quieta durante períodos prolongados en la orilla del agua esperando el paso de presas.',
                'distribution' => 'Humedales y ríos de tierras bajas hasta 1.200 msnm.',
                'photos' => [
                    ['caption' => 'Garza Tigre Cuellifasta. Foto de referencia externa: andresftvera (iNaturalist, CC BY-NC), Florencia, Caquetá; no corresponde a un registro municipal de Santander de Quilichao.', 'file' => 'garza-tigre.jpg', 'asset' => 'img/aves/garza-tigre.jpg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DEL RAYADO DEL CUELLO]', 'file' => 'garza-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: CAZANDO EN EL ESPEJO DE AGUA]', 'file' => 'garza-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Tigrisoma_lineatum_-_Rufescent_Tiger-Heron_XC14838.ogg',
                    'caption' => 'Vocalización crepuscular de la Garza Tigre',
                    'duration' => 22,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: TÉCNICA DE PESCA SIGILOSA]',
                    'file' => 'video-garza.mp4',
                ],
            ],
            [
                'slug' => 'carpintero-habado',
                'common_name' => 'Carpintero Habado',
                'scientific_name' => 'Melanerpes rubricapillus',
                'family' => 'Picidae',
                'habitat_slug' => 'urbano-jardines',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Carpintero adaptable con plumaje cebra en el dorso. Conocido por sus tamborileos sonoros en postes secos y tallos maduros de guadua.',
                'physical_characteristics' => 'Longitud de 17 cm. Dorso listado de blanco y negro, vientre gris cremoso con mancha roja abdominal; corona carmesí en machos.',
                'diet' => 'Larvas taladradoras de madera, termitas, hormigas y frutos maduros como papaya y guayaba.',
                'behavior' => 'Trepador activo sobre troncos verticales; taladra cavidades para nidificar en madera blanda.',
                'distribution' => 'Valles cálidos y zonas premontanas de Colombia (0 a 1.600 msnm).',
                'photos' => [
                    ['caption' => 'Carpintero Habado registrado en Santander de Quilichao. Foto: Litrato15 (iNaturalist, CC BY-NC); mejora técnica con IA.', 'file' => 'carpintero-habado.png', 'asset' => 'img/aves/carpintero-habado.png'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: PRIMER PLANO DE CORONA ROJA]', 'file' => 'carpintero-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: INSPECCIONANDO CAVIDAD DE NIDO]', 'file' => 'carpintero-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Melanerpes_rubricapillus_-_Red-crowned_Woodpecker_XC33005.ogg',
                    'caption' => 'Tamborileo y trino del Carpintero Habado',
                    'duration' => 18,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: TAMBORILEO Y COMUNICACIÓN SONORA]',
                    'file' => 'video-carpintero.mp4',
                ],
            ],
            [
                'slug' => 'azulejo-comun',
                'common_name' => 'Azulejo Común',
                'scientific_name' => 'Thraupis episcopus',
                'family' => 'Thraupidae',
                'habitat_slug' => 'urbano-jardines',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Una de las aves más reconocibles del municipio gracias a su plumaje azul celeste uniforme. Muy confiado cerca de asentamientos humanos.',
                'physical_characteristics' => 'Longitud de 16 cm. Cabeza y pecho grisáceo perla con tonos azulados claros; alas azul cobalto vivo sin rayas marcadas.',
                'diet' => 'Frugívoro e insectívoro oportunista: mangos, papayas, plátanos y polillas.',
                'behavior' => 'Gregarismo moderado. Frecuenta comederos comunitarios y árboles frutales en parejas.',
                'distribution' => 'Ampliamente distribuido en Colombia por debajo de 2.200 msnm.',
                'photos' => [
                    ['caption' => 'Azulejo Común registrado en Santander de Quilichao. Foto: Henry Dubán Alegría (iNaturalist, CC BY-NC); mejora técnica y reencuadre con IA.', 'file' => 'azulejo-comun.png', 'asset' => 'img/aves/azulejo-comun.png'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: DETALLE DE PLUMAJE CELESTE]', 'file' => 'azulejo-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: VOLANDO ENTRE JARDINES]', 'file' => 'azulejo-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/9/90/Thraupis_episcopus_-_Blue-gray_Tanager_XC41982.ogg',
                    'caption' => 'Pío matutino del Azulejo Común',
                    'duration' => 25,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: VOCALIZACIONES MATUTINAS EN COPA]',
                    'file' => 'video-azulejo.mp4',
                ],
            ],
            [
                'slug' => 'buho-currucutu',
                'common_name' => 'Currucutú Común (Búho Chillón)',
                'scientific_name' => 'Megascops choliba',
                'family' => 'Strigidae',
                'habitat_slug' => 'bosque-andino',
                'category' => 'residente',
                'uicn_status' => 'LC',
                'is_featured' => true,
                'description' => 'Pequeña rapaz nocturna de plumaje estrictamente mimético similar a la corteza de árboles añosos. Su trino característico es sinónimo de las noches quilichagüeñas.',
                'physical_characteristics' => 'Longitud de 21 a 23 cm. Penachos auriculares móviles (\'orejitas\'). Plumaje vermiculado en grises y castaños con ojos amarillos intensos.',
                'diet' => 'Caza activa nocturna de escarabajos rinoceronte, polillas grandes, ciempiés y ratones.',
                'behavior' => 'Estrictamente nocturno; pasa el día inmóvil apoyado contra el tronco de un árbol frondoso.',
                'distribution' => 'Tierras bajas y medias andinas de todo el departamento del Cauca.',
                'photos' => [
                    ['caption' => 'Currucutú Común. Foto de referencia externa: gabo_utria (iNaturalist, CC BY-NC), Jamundí, Valle del Cauca; no corresponde a un registro municipal de Santander de Quilichao.', 'file' => 'currucutu-comun.jpg', 'asset' => 'img/aves/currucutu-comun.jpg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 2 DE 3: OJOS AMARILLOS Y PENACHOS]', 'file' => 'currucutu-2.svg'],
                    ['caption' => '[PLACEHOLDER DE FOTOGRAFÍA 3 DE 3: SILUETA NOCTURNA EN RAMA SECA]', 'file' => 'currucutu-3.svg'],
                ],
                'audio' => [
                    'url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e0/Megascops_choliba_-_Tropical_Screech-Owl_XC61291.ogg',
                    'caption' => 'Llamado nocturno del Currucutú Común',
                    'duration' => 21,
                ],
                'video' => [
                    'caption' => '[PLACEHOLDER DE VIDEO: LLAMADO NOCTURNO "CURRU-CU-TÚ"]',
                    'file' => 'video-currucutu.mp4',
                ],
            ],
        ];

        foreach ($speciesList as $sData) {
            $family = Family::where('name', $sData['family'])->first();
            $habitat = Habitat::where('slug', $sData['habitat_slug'])->first();

            $species = Species::updateOrCreate(
                ['slug' => $sData['slug']],
                [
                    'family_id' => $family?->id,
                    'habitat_id' => $habitat?->id,
                    'common_name' => $sData['common_name'],
                    'scientific_name' => $sData['scientific_name'],
                    'category' => $sData['category'],
                    'uicn_status' => $sData['uicn_status'],
                    'description' => $sData['description'],
                    'physical_characteristics' => $sData['physical_characteristics'],
                    'diet' => $sData['diet'],
                    'behavior' => $sData['behavior'],
                    'distribution' => $sData['distribution'],
                    'is_featured' => $sData['is_featured'],
                    'is_archived' => false,
                ]
            );

            // Photos
            foreach ($sData['photos'] as $idx => $photo) {
                $isLocalAsset = isset($photo['asset']);
                Media::updateOrCreate(
                    [
                        'mediable_type' => Species::class,
                        'mediable_id' => $species->id,
                        'type' => 'photo',
                        'order' => $idx + 1,
                    ],
                    [
                        'disk' => 'public',
                        'storage_path' => $isLocalAsset ? 'asset:' . $photo['asset'] : 'placeholders/' . $photo['file'],
                        'file_name' => $photo['file'],
                        'mime_type' => $isLocalAsset
                            ? match (strtolower(pathinfo($photo['file'], PATHINFO_EXTENSION))) {
                                'jpg', 'jpeg' => 'image/jpeg',
                                'png' => 'image/png',
                                'webp' => 'image/webp',
                                default => 'application/octet-stream',
                            }
                            : 'image/svg+xml',
                        'file_size' => $isLocalAsset && is_file(public_path($photo['asset']))
                            ? filesize(public_path($photo['asset']))
                            : 1024,
                        'visibility' => 'public',
                        'caption' => $photo['caption'],
                        'created_by' => $admin?->id,
                    ]
                );
            }

            // Audio
            if (!empty($sData['audio'])) {
                Media::updateOrCreate(
                    [
                        'mediable_type' => Species::class,
                        'mediable_id' => $species->id,
                        'type' => 'audio',
                    ],
                    [
                        'disk' => 'public',
                        'storage_path' => $sData['audio']['url'],
                        'file_name' => 'vocalizacion.ogg',
                        'mime_type' => 'audio/ogg',
                        'file_size' => 204800,
                        'duration_seconds' => $sData['audio']['duration'],
                        'visibility' => 'public',
                        'order' => 1,
                        'caption' => $sData['audio']['caption'],
                        'created_by' => $admin?->id,
                    ]
                );
            }

            // Videos locales o marcador de video
            $videos = $sData['videos'] ?? (!empty($sData['video']) ? [$sData['video']] : []);
            foreach ($videos as $idx => $video) {
                $isLocalAsset = isset($video['asset']);
                Media::updateOrCreate(
                    [
                        'mediable_type' => Species::class,
                        'mediable_id' => $species->id,
                        'type' => 'video',
                        'order' => $idx + 1,
                    ],
                    [
                        'disk' => 'public',
                        'storage_path' => $isLocalAsset ? 'asset:' . $video['asset'] : 'placeholders/' . $video['file'],
                        'file_name' => $video['file'],
                        'mime_type' => 'video/mp4',
                        'file_size' => $isLocalAsset && is_file(public_path($video['asset']))
                            ? filesize(public_path($video['asset']))
                            : 1048576,
                        'duration_seconds' => $video['duration'] ?? 45,
                        'visibility' => 'public',
                        'caption' => $video['caption'],
                        'created_by' => $admin?->id,
                    ]
                );
            }
        }
    }
}
