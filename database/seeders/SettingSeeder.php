<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'BioAves Quilichao', 'group' => 'general', 'type' => 'string', 'description' => 'Nombre institucional del portal'],
            ['key' => 'site_tagline', 'value' => 'Descubre. Escucha. Explora. Conserva.', 'group' => 'general', 'type' => 'string', 'description' => 'Lema oficial del proyecto'],
            ['key' => 'max_upload_size_mb', 'value' => '15', 'group' => 'multimedia', 'type' => 'integer', 'description' => 'Tamaño máximo de archivo en MB'],
            ['key' => 'allowed_image_types', 'value' => '["image/jpeg","image/png","image/webp","image/svg+xml"]', 'group' => 'multimedia', 'type' => 'json', 'description' => 'Formatos de imagen permitidos'],
            ['key' => 'allowed_audio_types', 'value' => '["audio/mpeg","audio/ogg","audio/wav"]', 'group' => 'multimedia', 'type' => 'json', 'description' => 'Formatos de audio permitidos'],
            ['key' => 'allowed_video_types', 'value' => '["video/mp4","video/webm"]', 'group' => 'multimedia', 'type' => 'json', 'description' => 'Formatos de video permitidos'],
            ['key' => 'storage_driver', 'value' => 'local', 'group' => 'multimedia', 'type' => 'string', 'description' => 'Disco de almacenamiento (local / r2)'],
            ['key' => 'enable_public_sightings_submission', 'value' => 'true', 'group' => 'sightings', 'type' => 'boolean', 'description' => 'Permitir envío de avistamientos por usuarios registrados'],
            ['key' => 'default_map_lat', 'value' => '3.0094', 'group' => 'map', 'type' => 'string', 'description' => 'Latitud central de Santander de Quilichao'],
            ['key' => 'default_map_lng', 'value' => '-76.4847', 'group' => 'map', 'type' => 'string', 'description' => 'Longitud central de Santander de Quilichao'],
            ['key' => 'default_map_zoom', 'value' => '13', 'group' => 'map', 'type' => 'integer', 'description' => 'Zoom inicial del mapa'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
