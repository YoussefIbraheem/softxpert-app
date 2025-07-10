<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->hasAnyRole(['admin', 'manager']) ||
        $task->assignees->contains($user);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        if ($user->hasAnyRole(['admin', 'manager'])) {
            return true;
        }

        if ($task->assignees->contains($user)) {
            return request()->only('status') && count(request()->all()) === 1;
        }

        return false;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id || $user->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id || $user->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id || $user->hasAnyRole(['admin', 'manager']);
    }
}
