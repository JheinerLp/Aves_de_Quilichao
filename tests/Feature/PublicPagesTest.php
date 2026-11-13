<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('BIOAVES QUILICHAO');
        $response->assertSee('Santander de Quilichao');
        $response->assertSee('Momoto Andino');
    }

    public function test_catalog_page_renders_successfully(): void
    {
        $response = $this->get('/catalogo');
        $response->assertStatus(200);
        $response->assertSee('Catálogo de Aves de Santander de Quilichao');
    }

    public function test_species_detail_page_renders_successfully(): void
    {
        $response = $this->get('/especie/momoto-andino');
        $response->assertStatus(200);
        $response->assertSee('Momoto Andino (Barranquero)');
        $response->assertSee('Momotus aequatorialis');
    }

    public function test_species_api_endpoint_returns_json(): void
    {
        $response = $this->getJson('/api/v1/species');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'count',
            'data' => [
                '*' => ['id', 'common_name', 'scientific_name', 'slug', 'family', 'habitat']
            ]
        ]);
    }

    public function test_sightings_geojson_api_endpoint_returns_feature_collection(): void
    {
        $response = $this->getJson('/api/v1/sightings/geojson');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'type',
            'features' => [
                '*' => [
                    'type',
                    'geometry' => ['type', 'coordinates'],
                    'properties' => ['id', 'common_name', 'scientific_name', 'location_name']
                ]
            ]
        ]);
        $this->assertEquals('FeatureCollection', $response->json('type'));
    }

    public function test_sightings_stats_api_endpoint_returns_metrics(): void
    {
        $response = $this->getJson('/api/v1/sightings/stats');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'total_approved',
            'total_species_recorded',
            'total_locations'
        ]);
    }

    public function test_public_user_can_submit_sighting_with_email_and_it_is_regulated(): void
    {
        $species = \App\Models\Species::first();
        $location = \App\Models\Location::first();

        // 1er envío exitoso
        $res1 = $this->post('/avistamientos/reportar', [
            'observer_name' => 'María Pérez',
            'observer_email' => 'maria@observacioncauca.org',
            'species_id' => $species->id,
            'location_id' => $location->id,
            'sighting_date' => now()->format('Y-m-d'),
            'individuals_count' => 2,
            'description' => 'Dos ejemplares observados forrajeando en el estrato medio.',
        ]);
        $res1->assertSessionHas('sighting_success');
        $this->assertDatabaseHas('sightings', [
            'observer_email' => 'maria@observacioncauca.org',
            'status' => 'pending',
        ]);

        // 2do envío exitoso
        $res2 = $this->post('/avistamientos/reportar', [
            'observer_name' => 'María Pérez',
            'observer_email' => 'maria@observacioncauca.org',
            'species_id' => $species->id,
            'location_id' => $location->id,
            'sighting_date' => now()->format('Y-m-d'),
            'individuals_count' => 1,
            'description' => 'Un individuo vocalizando al atardecer sobre un sauce.',
        ]);
        $res2->assertSessionHas('sighting_success');

        // 3er envío exitoso
        $res3 = $this->post('/avistamientos/reportar', [
            'observer_name' => 'María Pérez',
            'observer_email' => 'maria@observacioncauca.org',
            'species_id' => $species->id,
            'location_id' => $location->id,
            'sighting_date' => now()->format('Y-m-d'),
            'individuals_count' => 3,
            'description' => 'Grupo familiar perchado en ramas altas.',
        ]);
        $res3->assertSessionHas('sighting_success');

        // 4to envío: debe ser regulado y bloqueado (máximo 3 envíos)
        $res4 = $this->post('/avistamientos/reportar', [
            'observer_name' => 'María Pérez',
            'observer_email' => 'maria@observacioncauca.org',
            'species_id' => $species->id,
            'location_id' => $location->id,
            'sighting_date' => now()->format('Y-m-d'),
            'individuals_count' => 1,
            'description' => 'Intento número 4 excediendo el límite.',
        ]);
        $res4->assertSessionHas('sighting_error');
    }
}
