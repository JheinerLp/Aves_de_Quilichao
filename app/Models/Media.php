<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'type',
        'disk',
        'storage_path',
        'file_name',
        'mime_type',
        'file_size',
        'duration_seconds',
        'visibility',
        'order',
        'caption',
        'created_by',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration_seconds' => 'integer',
        'file_size' => 'integer',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(MediaVariant::class);
    }

    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->storage_path, 'asset:')) {
            return asset(substr($this->storage_path, 6));
        }

        if (filter_var($this->storage_path, FILTER_VALIDATE_URL)) {
            return $this->storage_path;
        }

        try {
            return Storage::disk($this->disk ?? 'public')->url($this->storage_path);
        } catch (\Exception $e) {
            return asset($this->storage_path);
        }
    }
}
