<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'zone',
        'elevation_msnm',
        'latitude',
        'longitude',
        'description',
        'access_notes',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'elevation_msnm' => 'integer',
    ];

    public function sightings(): HasMany
    {
        return $this->hasMany(Sighting::class);
    }
}
