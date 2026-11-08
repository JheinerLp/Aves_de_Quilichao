<?php

namespace App\Services;

use App\Jobs\ProcessMediaVariantJob;
use App\Models\AuditLog;
use App\Models\Media;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class MediaUploadService
{
    /**
     * Upload an uploaded file and attach to a model.
     */
    public function upload(
        UploadedFile $file,
        Model $mediable,
        string $type,
        ?string $caption = null,
        int $order = 0,
        ?int $userId = null
    ): Media {
        $this->validateFile($file, $type);

        $disk = env('FILESYSTEM_DISK', 'public');
        $extension = $file->getClientOriginalExtension() ?: 'bin';
        $safeFileName = Str::uuid() . '.' . strtolower($extension);
        $folder = 'uploads/' . $type . '/' . date('Y/m');
        $storagePath = $folder . '/' . $safeFileName;

        $path = $file->storeAs($folder, $safeFileName, $disk);

        $media = Media::create([
            'mediable_type' => get_class($mediable),
            'mediable_id' => $mediable->getKey(),
            'type' => $type,
            'disk' => $disk,
            'storage_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
            'file_size' => $file->getSize(),
            'visibility' => 'public',
            'order' => $order,
            'caption' => $caption,
            'created_by' => $userId ?? auth()->id(),
        ]);

        AuditLog::log('uploaded_media', $media, "Archivo {$file->getClientOriginalName()} cargado como {$type}.");

        // Dispatch background processing if image
        if ($type === 'photo') {
            ProcessMediaVariantJob::dispatch($media);
        }

        return $media;
    }

    /**
     * Validate file type and size.
     */
    protected function validateFile(UploadedFile $file, string $type): void
    {
        $maxMb = Setting::get('max_upload_size_mb', 15);
        $maxBytes = $maxMb * 1024 * 1024;

        if ($file->getSize() > $maxBytes) {
            throw new InvalidArgumentException("El archivo excede el tamaño máximo permitido de {$maxMb}MB.");
        }

        $mime = $file->getMimeType();

        $allowedMimes = match ($type) {
            'photo' => ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/svg+xml'],
            'audio' => ['audio/mpeg', 'audio/ogg', 'audio/wav', 'audio/x-wav', 'audio/aac', 'audio/mp4'],
            'video' => ['video/mp4', 'video/webm', 'video/ogg'],
            default => throw new InvalidArgumentException("Tipo de multimedia desconocido: {$type}"),
        };

        if (!in_array($mime, $allowedMimes)) {
            throw new InvalidArgumentException("Formato no soportado ({$mime}) para categoría {$type}.");
        }
    }

    /**
     * Delete a media item and its physical file.
     */
    public function delete(Media $media): bool
    {
        foreach ($media->variants as $variant) {
            Storage::disk($media->disk)->delete($variant->storage_path);
            $variant->delete();
        }

        Storage::disk($media->disk)->delete($media->storage_path);
        AuditLog::log('deleted_media', $media, "Archivo {$media->file_name} eliminado.");
        return $media->delete();
    }
}
