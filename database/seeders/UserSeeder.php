<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@bioavesquilichao.co'],
            [
                'name' => 'Administrador BioAves',
                'password' => Hash::make('AdminBioAves2026!'),
                'email_verified_at' => now(),
            ]
        );

        if ($adminRole) {
            $admin->roles()->sync([$adminRole->id]);
        }
    }
}
