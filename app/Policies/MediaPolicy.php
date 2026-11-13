<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;

class MediaPolicy
{
    public function create(User $user): bool
    {
        return $user->hasPermission('media.upload');
    }

    public function delete(User $user, Media $media): bool
    {
        if ($user->hasPermission('media.delete')) {
            return true;
        }

        return $media->created_by === $user->id;
    }
}
