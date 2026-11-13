<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Ingreso Administrativo');
    }

    public function test_admin_can_authenticate_using_the_login_screen(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $user = User::factory()->create([
            'email' => 'admin@bioavesquilichao.co',
            'password' => Hash::make('SecretPassword123!'),
        ]);
        $user->roles()->attach($adminRole->id);

        $response = $this->post('/login', [
            'email' => 'admin@bioavesquilichao.co',
            'password' => 'SecretPassword123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@bioavesquilichao.co',
            'password' => Hash::make('SecretPassword123!'),
        ]);

        $this->post('/login', [
            'email' => 'admin@bioavesquilichao.co',
            'password' => 'WrongPassword',
        ]);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }
}
