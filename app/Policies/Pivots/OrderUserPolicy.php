<?php

namespace App\Policies\Pivots;

use App\Models\{User, Pivots\OrderUser};
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderUserPolicy
{
    use HandlesAuthorization;

    public function any(User $user, OrderUser $orderUser): bool
    {
        return $user->isActive() && ($orderUser->user_id == $user->id || $user->isAdmin());
    }
}
