<?php

namespace App\Policies;

use App\Models\Creature;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CreaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(User $user, Creature $creature): bool {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Creature $creature): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->id == $creature->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, Creature $creature): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->id == $creature->user_id;
    }
}
