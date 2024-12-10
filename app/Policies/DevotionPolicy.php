<?php

namespace App\Policies;

use App\Models\Devotion;
use App\Models\User;

class DevotionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('devotions.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Devotion $devotion): bool
    {
        if ($devotion->isVisible()) {
            return true;
        }

        return $user && $user->hasPermissionTo('devotions.view.any');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('devotions.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Devotion $devotion): bool
    {
        return $user->hasPermissionTo('devotions.update.any');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Devotion $devotion): bool
    {
        return $user->hasPermissionTo('devotions.delete.any');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Devotion $devotion): bool
    {
        return $user->hasPermissionTo('devotions.update.any');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Devotion $devotion): bool
    {
        return $user->hasPermissionTo('devotions.delete.any');
    }
}
