<?php
namespace App\Policies;
use App\Models\Shift;
use App\Models\User;
use App\UserStatus;
class ShiftPolicy {
    /**
     * Managers can see all shifts.
     * Employees can only see their own shifts and open (unassigned) shifts.
     */
    public function view(User $user, Shift $shift): bool {
        return $user->status === UserStatus::Manager || $shift->user_id === null || $shift->user_id === $user->id;
    }
    /**
     * Only managers can create shifts.
     */
    public function create(User $user): bool {
        return $user->status === UserStatus::Manager;
    }
    /**
     * Managers can update any shift.
     * Employees can only self-assign an open (unassigned) shift.
     */
    public function update(User $user, Shift $shift): bool {
        if ($user->status === UserStatus::Manager) {
            return true;
        }
        return $shift->user_id === null;// Employees may only claim a currently unassigned shift for themselves
    }
    /**
     * Only managers can delete shifts.
     */
    public function delete(User $user, Shift $shift): bool {
        return $user->status === UserStatus::Manager;
    }
}