<?php
namespace App\Policies;
use App\Models\User;
use App\UserStatus;
class UserPolicy {
    /**
     * Managers can view any user.
     * Employees can only view themselves.
     */
    public function view(User $user, User $model): bool {
        return $user->status === UserStatus::Manager || $user->id === $model->id;
    }
    /**
     * Only managers can create new users (i.e. from an admin panel).
     * Normal self-registration goes through Fortify's CreateNewUser action.
     */
    public function create(User $user): bool {
        return $user->status === UserStatus::Manager;
    }
    /**
     * Managers can update any user.
     * Employees can only update themselves.
     */
    public function update(User $user, User $model): bool {
        return $user->status === UserStatus::Manager || $user->id === $model->id;
    }
    /**
     * Only managers can delete other users.
     * Employees cannot delete accounts (even their own) via this policy —
     * self-deletion is handled separately in ProfileController.
     */
    public function delete(User $user, User $model): bool {
        return $user->status === UserStatus::Manager && $user->id !== $model->id;// Prevent a manager from accidentally deleting themselves here
    }
}