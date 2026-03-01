<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
        public function before(User $user): bool
    {
        return $user->role === UserRoles::ADMIN;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === UserRoles::ADMIN;
    }
}
