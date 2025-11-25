<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Activity $activity): bool
    {
        return $user->isAdmin() || $activity->author_id === $user->id;
    }
}
