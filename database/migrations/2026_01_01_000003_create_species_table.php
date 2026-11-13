<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('common_name', 150);
            $table->string('scientific_name', 150)->unique();
            $table->string('slug', 150)->unique();
            $table->foreignId('family_id')->constrained('families')->restrictOnDelete();
            $table->foreignId('habitat_id')->nullable()->constrained('habitats')->nullOnDelete();
            $table->string('category', 50)->default('residente'); // endemica, residente, migratoria, etc.
            $table->string('uicn_status', 50)->default('LC'); // LC, NT, VU, EN, CR, etc.
            $table->text('description');
            $table->text('physical_characteristics')->nullable();
            $table->text('diet')->nullable();
            $table->text('behavior')->nullable();
            $table->text('distribution')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index('family_id');
            $table->index('habitat_id');
            $table->index('category');
            $table->index('uicn_status');
            $table->index('is_featured');
            $table->index('is_archived');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
