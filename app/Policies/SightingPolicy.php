<?php

namespace App\Policies;

use App\Models\Sighting;
use App\Models\User;

class SightingPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Sighting $sighting): bool
    {
        return $sighting->status === 'approved' || ($user && ($user->id === $sighting->user_id || $user->hasPermission('sightings.view')));
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('sightings.create');
    }

    public function update(User $user, Sighting $sighting): bool
    {
        if ($user->hasPermission('sightings.edit.any')) {
            return true;
        }

        return $sighting->user_id === $user->id && $sighting->status === 'pending' && $user->hasPermission('sightings.edit.own');
    }

    public function review(User $user, Sighting $sighting): bool
    {
        return $user->hasPermission('sightings.review');
    }

    public function delete(User $user, Sighting $sighting): bool
    {
        return $user->hasPermission('sightings.delete');
    }
}
