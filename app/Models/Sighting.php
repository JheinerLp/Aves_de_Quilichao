<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sighting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'species_id',
        'user_id',
        'observer_email',
        'observer_name',
        'location_id',
        'habitat_id',
        'sighting_date',
        'sighting_time',
        'individuals_count',
        'latitude',
        'longitude',
        'description',
        'status',
        'reviewer_id',
        'reviewed_at',
        'rejection_reason',
    ];

    protected $casts = [
        'sighting_date' => 'date',
        'reviewed_at' => 'datetime',
        'individuals_count' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('order');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->where('type', 'photo')->orderBy('order');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }
}
