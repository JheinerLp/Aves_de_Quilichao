<?php

namespace Database\Seeders;

use App\Models\Habitat;
use App\Models\Location;
use App\Models\Sighting;
use App\Models\Species;
use App\Models\User;
use Illuminate\Database\Seeder;

class SightingSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@bioavesquilichao.co')->first();

        $sightingsData = [
            [
                'species_slug' => 'momoto-andino',
                'location_slug' => 'cuenca-rio-quilichao',
                'habitat_slug' => 'bosque-andino',
                'sighting_date' => '2026-01-14',
                'sighting_time' => '08:30:00',
                'individuals_count' => 1,
                'description' => 'Ejemplar adulto observado posado sobre rama de sauce a 3 metros sobre el cauce del río. Percha sombreada en estrato medio balanceando su cola en péndulo.',
                'latitude' => 3.0145,
                'longitude' => -76.4880,
            ],
            [
                'species_slug' => 'pava-caucana',
                'location_slug' => 'reserva-vereda-san-antonio',
                'habitat_slug' => 'bosque-andino',
                'sighting_date' => '2026-02-02',
                'sighting_time' => '06:45:00',
                'individuals_count' => 3,
                'description' => 'Tres individuos alimentándose en frutos de palma madura durante niebla baja matutina. Importante registro reproductivo en zona de amortiguación.',
                'latitude' => 3.0520,
                'longitude' => -76.4410,
            ],
            [
                'species_slug' => 'tangara-rastrojera',
                'location_slug' => 'faldas-mondomo',
                'habitat_slug' => 'cafetal-agroecosistema',
                'sighting_date' => '2026-01-20',
                'sighting_time' => '09:15:00',
                'individuals_count' => 2,
                'description' => 'Pareja muy activa saltando entre matorrales de borde de finca y comiendo bayas silvestres.',
                'latitude' => 2.9720,
                'longitude' => -76.5310,
            ],
            [
                'species_slug' => 'colibri-colirrufo',
                'location_slug' => 'parque-principal-santander',
                'habitat_slug' => 'urbano-jardines',
                'sighting_date' => '2026-02-05',
                'sighting_time' => '11:20:00',
                'individuals_count' => 1,
                'description' => 'Individuo libando néctar en canteros florales centrales frente a la iglesia. Comportamiento territorial agresivo.',
                'latitude' => 3.0094,
                'longitude' => -76.4847,
            ],
            [
                'species_slug' => 'garza-tigre',
                'location_slug' => 'humedal-el-saman',
                'habitat_slug' => 'humedal-rio',
                'sighting_date' => '2026-01-28',
                'sighting_time' => '17:40:00',
                'individuals_count' => 1,
                'description' => 'Postura críptica inmóvil sobre orilla lodosa esperando presas acuáticas junto al espejo de agua principal.',
                'latitude' => 2.9920,
                'longitude' => -76.4715,
            ],
            [
                'species_slug' => 'carpintero-habado',
                'location_slug' => 'guaduales-santa-ines',
                'habitat_slug' => 'urbano-jardines',
                'sighting_date' => '2026-01-10',
                'sighting_time' => '10:10:00',
                'individuals_count' => 1,
                'description' => 'Macho trepando tallo de guadua y taladrando corteza seca en busca de insectos. Tamborileo vigoroso audible.',
                'latitude' => 3.0210,
                'longitude' => -76.4680,
            ],
            [
                'species_slug' => 'azulejo-comun',
                'location_slug' => 'campus-universitario-unicauca',
                'habitat_slug' => 'urbano-jardines',
                'sighting_date' => '2026-02-18',
                'sighting_time' => '14:15:00',
                'individuals_count' => 3,
                'description' => 'Tres individuos alimentándose en copas de mango cerca a los edificios docentes. Vuelos sociales en pareja.',
                'latitude' => 3.0290,
                'longitude' => -76.4950,
            ],
            [
                'species_slug' => 'buho-currucutu',
                'location_slug' => 'cerro-mirador-belen',
                'habitat_slug' => 'bosque-andino',
                'sighting_date' => '2026-02-25',
                'sighting_time' => '19:30:00',
                'individuals_count' => 1,
                'description' => 'Vocalizando continuamente en árbol de caucho cercano a la capilla de Belén. Grabación de audio confirmada.',
                'latitude' => 3.0040,
                'longitude' => -76.4910,
            ],
        ];

        foreach ($sightingsData as $s) {
            $species = Species::where('slug', $s['species_slug'])->first();
            $location = Location::where('slug', $s['location_slug'])->first();
            $habitat = Habitat::where('slug', $s['habitat_slug'])->first();

            if ($species && $location) {
                Sighting::create([
                    'species_id' => $species->id,
                    'user_id' => $admin?->id,
                    'observer_email' => 'observador@bioavesquilichao.co',
                    'observer_name' => 'Observador Comunitario',
                    'location_id' => $location->id,
                    'habitat_id' => $habitat?->id,
                    'sighting_date' => $s['sighting_date'],
                    'sighting_time' => $s['sighting_time'],
                    'individuals_count' => $s['individuals_count'],
                    'latitude' => $s['latitude'],
                    'longitude' => $s['longitude'],
                    'description' => $s['description'],
                    'status' => 'approved',
                    'reviewer_id' => $admin?->id,
                    'reviewed_at' => now(),
                ]);
            }
        }
    }
}
