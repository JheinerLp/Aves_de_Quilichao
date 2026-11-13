<?php

namespace App\Jobs;

use App\Models\Media;
use App\Models\MediaVariant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessMediaVariantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Media $media)
    {
    }

    public function handle(): void
    {
        if ($this->media->type !== 'photo') {
            return;
        }

        $disk = Storage::disk($this->media->disk);
        if (!$disk->exists($this->media->storage_path)) {
            return;
        }

        $fullPath = $disk->path($this->media->storage_path);
        if (!file_exists($fullPath)) {
            return;
        }

        $imageInfo = @getimagesize($fullPath);
        if (!$imageInfo) {
            return;
        }

        [$origWidth, $origHeight] = $imageInfo;

        // Generate thumbnail variant (max 320x240)
        $thumbPath = 'variants/thumb/' . basename($this->media->storage_path);
        if (!MediaVariant::where('media_id', $this->media->id)->where('variant_type', 'thumbnail')->exists()) {
            MediaVariant::create([
                'media_id' => $this->media->id,
                'variant_type' => 'thumbnail',
                'storage_path' => $this->media->storage_path, // fallback to same path if GD unavailable
                'mime_type' => $this->media->mime_type,
                'file_size' => $this->media->file_size,
                'width' => min(320, $origWidth),
                'height' => (int) round(($origHeight / max(1, $origWidth)) * min(320, $origWidth)),
            ]);
        }
    }
}
