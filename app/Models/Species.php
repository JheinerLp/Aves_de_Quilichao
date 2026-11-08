<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'species';

    protected $fillable = [
        'common_name',
        'scientific_name',
        'slug',
        'family_id',
        'habitat_id',
        'category',
        'uicn_status',
        'description',
        'physical_characteristics',
        'diet',
        'behavior',
        'distribution',
        'is_featured',
        'is_archived',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_archived' => 'boolean',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function sightings(): HasMany
    {
        return $this->hasMany(Sighting::class);
    }

    public function approvedSightings(): HasMany
    {
        return $this->hasMany(Sighting::class)->where('status', 'approved');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('order');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->where('type', 'photo')->orderBy('order');
    }

    public function audios(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->where('type', 'audio')->orderBy('order');
    }

    public function videos(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->where('type', 'video')->orderBy('order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_archived', false);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->where('is_archived', false);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('common_name', 'like', "%{$term}%")
              ->orWhere('scientific_name', 'like', "%{$term}%");
        });
    }
}
