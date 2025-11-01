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

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Activity $activity): bool
    {
        return $user->isAdmin() || $activity->author_id === $user->id;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $user->isAdmin() || $activity->author_id === $user->id;
    }

    public function restore(User $user, Activity $activity): bool
    {
        return true;
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return true;
    }
}
