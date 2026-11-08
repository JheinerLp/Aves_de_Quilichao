<?php

namespace Database\Seeders;

use App\Models\ConservationContent;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConservationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $contents = [
            [
                'title' => 'Ecosistemas Estratégicos y Corredores Biológicos',
                'slug' => 'ecosistemas-estrategicos-quilichao',
                'category' => 'educativo',
                'summary' => 'Santander de Quilichao actúa como un puente ecológico vital entre la Cordillera Central y el Valle Geográfico del Río Cauca.',
                'content' => 'El municipio cuenta con una notable gradiente altitudinal que va desde los 1.000 hasta más de 2.200 msnm. Esta variación geográfica favorece microclimas diversos que sostienen más de 250 especies registradas de aves residentes y migratorias boreales.',
                'order' => 1,
            ],
            [
                'title' => 'Amenazas Principales a la Avifauna Local',
                'slug' => 'amenazas-avifauna-local',
                'category' => 'amenazas',
                'summary' => 'La pérdida de cobertura vegetal nativa y la presión sobre fuentes hídricas representan los mayores desafíos de conservación.',
                'content' => 'La deforestación en cabeceras de cuenca, el uso intensivo de agroquímicos y la expansión desordenada de la frontera urbana reducen el alimento y los sitios de anidación de aves sensibles como la Pava Caucana (Penelope perspicax).',
                'order' => 2,
            ],
            [
                'title' => 'Código de Ética y Buenas Prácticas de Observación',
                'slug' => 'codigo-etica-observador',
                'category' => 'etica',
                'summary' => 'Directrices esenciales para minimizar el impacto en las aves y sus hábitats durante las salidas de campo.',
                'content' => '1. El bienestar del ave siempre prevalece sobre la fotografía o el registro. 2. No utilizar llamadas de reproducción sonora (playback) excesivas en temporada reproductiva. 3. Respetar la propiedad privada y las comunidades locales. 4. No alterar ramas ni nidos.',
                'order' => 3,
            ],
            [
                'title' => 'Red Comunitaria de Monitoreo Participativo',
                'slug' => 'red-comunitaria-monitoreo',
                'category' => 'accion_comunitaria',
                'summary' => 'Fomentamos la ciencia ciudadana involucrando a campesinos, resguardos indígenas, escuelas rurales y jóvenes.',
                'content' => 'A través de talleres de campo y la plataforma BioAves Quilichao, capacitamos a observadores locales en la identificación morfológica y auditiva de las aves de sus veredas.',
                'order' => 4,
            ],
        ];

        foreach ($contents as $item) {
            ConservationContent::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'category' => $item['category'],
                    'summary' => $item['summary'],
                    'content' => $item['content'],
                    'order' => $item['order'],
                    'is_published' => true,
                    'user_id' => $admin?->id,
                ]
            );
        }
    }
}
