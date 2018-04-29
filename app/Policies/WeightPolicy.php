<?php

namespace App\Policies;

use App\User;
use App\Weight;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeightPolicy
{
    use HandlesAuthorization;

    /**
     * Determikne if the authenticated user has permission to update a reply.
     *
     * @param User $user
     * @param Weight $weight
     * @return bool
     */
    public function update(User $user, Weight $weight)
    {
        return $weight->user_id == $user->id;
    }

}
