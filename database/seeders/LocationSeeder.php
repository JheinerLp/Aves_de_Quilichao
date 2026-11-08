<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Cuenca del Río Quilichao - Sendero Fluvial',
                'slug' => 'cuenca-rio-quilichao',
                'zone' => 'Zona Urbana y Ribereña',
                'latitude' => 3.0145,
                'longitude' => -76.4880,
                'elevation_msnm' => 1060,
                'description' => 'Sendero ecológico paralelo al cauce del río con sauces, yarumos y vegetación de galería.',
                'access_notes' => 'Acceso libre peatonal desde el puente del centro.',
            ],
            [
                'name' => 'Reserva Forestal Vereda San Antonio',
                'slug' => 'reserva-vereda-san-antonio',
                'zone' => 'Cordillera Central / Bosque de Niebla',
                'latitude' => 3.0520,
                'longitude' => -76.4410,
                'elevation_msnm' => 1750,
                'description' => 'Fragmento conservado de bosque de niebla andino, hábitat clave de la Pava Caucana.',
                'access_notes' => 'Requiere permiso previo y guía comunitario.',
            ],
            [
                'name' => 'Faldas de Mondomo - Finca Agroecológica',
                'slug' => 'faldas-mondomo',
                'zone' => 'Zona Cafetera Suroccidente',
                'latitude' => 2.9720,
                'longitude' => -76.5310,
                'elevation_msnm' => 1280,
                'description' => 'Matriz agroforestal de cafetales bajo sombra y franjas de bosque secundario.',
                'access_notes' => 'Vía veredal transitable todo el año.',
            ],
            [
                'name' => 'Parque Principal Francisco de Paula Santander',
                'slug' => 'parque-principal-santander',
                'zone' => 'Casco Urbano',
                'latitude' => 3.0094,
                'longitude' => -76.4847,
                'elevation_msnm' => 1056,
                'description' => 'Corazón urbano con samanes históricos, palmas y jardines ornamentales con alta afluencia de colibríes.',
                'access_notes' => 'Pleno centro urbano, acceso total.',
            ],
            [
                'name' => 'Humedal El Samán y Microcuenca Sur',
                'slug' => 'humedal-el-saman',
                'zone' => 'Área de Humedales',
                'latitude' => 2.9920,
                'longitude' => -76.4715,
                'elevation_msnm' => 1045,
                'description' => 'Cuerpo de agua léntico con vegetación acuática densa, refugio de garzas y aves limícolas.',
                'access_notes' => 'Ingreso por la variante sur.',
            ],
            [
                'name' => 'Guaduales de la Vereda Santa Inés',
                'slug' => 'guaduales-santa-ines',
                'zone' => 'Zona Agropecuaria y Guaduales',
                'latitude' => 3.0210,
                'longitude' => -76.4680,
                'elevation_msnm' => 1070,
                'description' => 'Bosques densos de guadua (Guadua angustifolia) ideales para especies nidificantes de cavidades.',
                'access_notes' => 'Sendero rural transitable a pie o en bicicleta.',
            ],
            [
                'name' => 'Campus Universitario del Norte del Cauca',
                'slug' => 'campus-universitario-unicauca',
                'zone' => 'Zona Urbana y Académica',
                'latitude' => 3.0290,
                'longitude' => -76.4950,
                'elevation_msnm' => 1062,
                'description' => 'Áreas verdes institucionales y arboledas de frutales en el sector norte de la ciudad.',
                'access_notes' => 'Horario académico diurno.',
            ],
            [
                'name' => 'Cerro y Mirador de Belén',
                'slug' => 'cerro-mirador-belen',
                'zone' => 'Cerros Tutelares',
                'latitude' => 3.0040,
                'longitude' => -76.4910,
                'elevation_msnm' => 1120,
                'description' => 'Cerro tutelar con mirador panorámico, cobertura de matorral subandino y hábitat de rapaces nocturnas.',
                'access_notes' => 'Graderías y sendero señalizado.',
            ],
        ];

        foreach ($locations as $loc) {
            Location::firstOrCreate(['slug' => $loc['slug']], $loc);
        }
    }
}
