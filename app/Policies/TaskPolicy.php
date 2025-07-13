<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER]) ||
            $task->assignees->contains($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        // Admins can update any task
        if ($user->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER])) {
            return true;
        }

        // Assignees can only update specific statuses
        if ($task->assignees->contains($user)) {
            $onlyStatus = request()->only('status');

            if (count(request()->all()) === 1 && isset($onlyStatus['status'])) {
                return in_array($onlyStatus['status'], ['pending', 'in_progress', 'completed']);
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->hasRole(UserRole::ADMIN);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->hasRole(UserRole::ADMIN);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->hasRole(UserRole::ADMIN);
    }
}
