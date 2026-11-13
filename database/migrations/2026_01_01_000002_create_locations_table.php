<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->string('zone', 100);
            $table->integer('elevation_msnm')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->text('description')->nullable();
            $table->text('access_notes')->nullable();
            $table->timestamps();

            $table->index(['latitude', 'longitude']);
            $table->index('zone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
