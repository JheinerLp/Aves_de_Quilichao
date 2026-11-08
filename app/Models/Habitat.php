<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function species(): BelongsToMany
    {
        return $this->belongsToMany(Species::class, 'species_habitat');
    }

    public function sightings(): HasMany
    {
        return $this->hasMany(Sighting::class);
    }
}
