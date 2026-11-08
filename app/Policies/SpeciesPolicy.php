<?php

namespace App\Policies;

use App\Models\Species;
use App\Models\User;

class SpeciesPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Species $species): bool
    {
        return !$species->is_archived || ($user && $user->hasPermission('species.view'));
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('species.create');
    }

    public function update(User $user, Species $species): bool
    {
        return $user->hasPermission('species.edit');
    }

    public function delete(User $user, Species $species): bool
    {
        return $user->hasPermission('species.archive');
    }
}
