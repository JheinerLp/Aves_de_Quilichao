<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Role;
use App\Models\Sighting;
use App\Models\Species;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);

        $this->adminUser = User::where('email', 'admin@bioavesquilichao.co')->first();
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Panel General de BioAves Quilichao');
    }

    public function test_admin_can_create_new_species(): void
    {
        $family = Family::first();

        $response = $this->actingAs($this->adminUser)->post('/admin/species', [
            'common_name' => 'Colibrí Esmeralda del Cauca',
            'scientific_name' => 'Chlorostilbon gibsoni',
            'family_id' => $family->id,
            'category' => 'residente',
            'uicn_status' => 'LC',
            'description' => 'Pequeño colibrí de tonalidades verdes iridiscentes.',
            'diet' => 'Néctar y pequeños insectos.',
            'is_featured' => true,
        ]);

        $response->assertRedirect('/admin/species');
        $this->assertDatabaseHas('species', [
            'common_name' => 'Colibrí Esmeralda del Cauca',
            'scientific_name' => 'Chlorostilbon gibsoni',
        ]);
    }

    public function test_admin_can_archive_species(): void
    {
        $this->withoutExceptionHandling();
        $species = Species::first();

        $response = $this->actingAs($this->adminUser)->from('/admin/species')->patch("/admin/species/{$species->id}/toggle-archive");

        $response->assertStatus(302);
        $this->assertTrue($species->fresh()->is_archived);
    }

    public function test_reviewer_can_approve_or_reject_sighting(): void
    {
        $sighting = Sighting::first();

        $response = $this->actingAs($this->adminUser)->post("/admin/sightings/{$sighting->id}/review", [
            'status' => 'rejected',
            'rejection_reason' => 'Coordenadas imprecisas fuera del área municipal.',
        ]);

        $response->assertRedirect('/admin/sightings');
        $this->assertEquals('rejected', $sighting->fresh()->status);
        $this->assertEquals('Coordenadas imprecisas fuera del área municipal.', $sighting->fresh()->rejection_reason);
    }

    public function test_admin_can_view_audit_logs(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/audit-logs');
        $response->assertStatus(200);
        $response->assertSee('Registro de Auditoría del Sistema');
    }
}
