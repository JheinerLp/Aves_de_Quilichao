<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MediaVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'variant_type',
        'file_path',
        'disk',
        'width',
        'height',
        'file_size',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'file_size' => 'integer',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function getUrlAttribute(): string
    {
        if (filter_var($this->file_path, FILTER_VALIDATE_URL)) {
            return $this->file_path;
        }

        try {
            return Storage::disk($this->disk ?? config('filesystems.default'))->url($this->file_path);
        } catch (\Exception $e) {
            return asset($this->file_path);
        }
    }
}
