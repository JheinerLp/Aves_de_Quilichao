<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Habitat;
use Illuminate\Database\Seeder;

class TaxonomySeeder extends Seeder
{
    public function run(): void
    {
        $families = [
            ['name' => 'Momotidae', 'scientific_order' => 'Coraciiformes', 'description' => 'Barranqueros y momotos de colas en raqueta'],
            ['name' => 'Cracidae', 'scientific_order' => 'Galliformes', 'description' => 'Pavas, guacharacas y paujiles frugívoros de bosque'],
            ['name' => 'Thraupidae', 'scientific_order' => 'Passeriformes', 'description' => 'Tangaras, azulejos y semilleros neotropicales'],
            ['name' => 'Trochilidae', 'scientific_order' => 'Apodiformes', 'description' => 'Colibríes y ermitaños nectarívoros'],
            ['name' => 'Ardeidae', 'scientific_order' => 'Pelecaniformes', 'description' => 'Garzas, garzones y avetoros de humedal'],
            ['name' => 'Picidae', 'scientific_order' => 'Piciformes', 'description' => 'Pájaros carpinteros trepadores de troncos'],
            ['name' => 'Strigidae', 'scientific_order' => 'Strigiformes', 'description' => 'Búhos y mochuelos rapaces nocturnos'],
            ['name' => 'Falconidae', 'scientific_order' => 'Falconiformes', 'description' => 'Halcones y caracaras'],
            ['name' => 'Tyrannidae', 'scientific_order' => 'Passeriformes', 'description' => 'Atrapamoscas, siriríes y bichofués'],
        ];

        foreach ($families as $f) {
            Family::firstOrCreate(['name' => $f['name']], $f);
        }

        $habitats = [
            [
                'name' => 'Bosque Andino y Cañadas',
                'slug' => 'bosque-andino',
                'description' => 'Estratos boscosos andinos, cañadas húmedas y relictos de niebla de la Cordillera Central.',
            ],
            [
                'name' => 'Humedales y Riberas',
                'slug' => 'humedal-rio',
                'description' => 'Riberas de ríos, meandros, humedales y ciénagas del valle geográfico.',
            ],
            [
                'name' => 'Cafetales y Agroecosistemas',
                'slug' => 'cafetal-agroecosistema',
                'description' => 'Sistemas productivos tradicionales con café bajo sombra, plataneras y cercas vivas.',
            ],
            [
                'name' => 'Urbano y Jardines',
                'slug' => 'urbano-jardines',
                'description' => 'Parques públicos, avenidas arboladas, guaduales urbanos y solares residenciales.',
            ],
        ];

        foreach ($habitats as $h) {
            Habitat::firstOrCreate(['slug' => $h['slug']], $h);
        }
    }
}
