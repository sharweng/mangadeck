<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Genre $genre): bool
    {
        return true; // Everyone can view genres
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Genre $genre): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Genre $genre): bool
    {
        return $user->isAdmin();
    }
}

