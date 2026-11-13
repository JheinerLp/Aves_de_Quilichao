<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Ver Especies', 'slug' => 'species.view', 'module' => 'species'],
            ['name' => 'Crear Especies', 'slug' => 'species.create', 'module' => 'species'],
            ['name' => 'Editar Especies', 'slug' => 'species.edit', 'module' => 'species'],
            ['name' => 'Archivar Especies', 'slug' => 'species.archive', 'module' => 'species'],
            ['name' => 'Ver Avistamientos', 'slug' => 'sightings.view', 'module' => 'sightings'],
            ['name' => 'Crear Avistamiento', 'slug' => 'sightings.create', 'module' => 'sightings'],
            ['name' => 'Revisar/Aprobar Avistamientos', 'slug' => 'sightings.review', 'module' => 'sightings'],
            ['name' => 'Eliminar Avistamientos', 'slug' => 'sightings.delete', 'module' => 'sightings'],
            ['name' => 'Subir Multimedia', 'slug' => 'media.upload', 'module' => 'media'],
            ['name' => 'Eliminar Multimedia', 'slug' => 'media.delete', 'module' => 'media'],
            ['name' => 'Gestionar Usuarios', 'slug' => 'users.manage', 'module' => 'users'],
            ['name' => 'Ver Auditoría', 'slug' => 'audit.view', 'module' => 'system'],
            ['name' => 'Gestionar Configuración', 'slug' => 'settings.manage', 'module' => 'system'],
            ['name' => 'Gestionar Conservación', 'slug' => 'conservation.manage', 'module' => 'conservation'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['slug' => $perm['slug']], $perm);
        }

        // Único Rol del Sistema: Administrador
        $admin = Role::firstOrCreate(['slug' => 'admin'], [
            'name' => 'Administrador',
            'description' => 'Acceso y control total del sistema administrativo',
        ]);

        $admin->permissions()->sync(Permission::all()->pluck('id'));
    }
}
