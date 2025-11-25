<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Activity $activity): bool
    {
        return $user->isAdmin() || $activity->author_id === $user->id;
    }

    public function detail(User $user, Activity $activity): Response
    {
        return $user->isAdmin() || $activity->author_id === $user->id ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk melihat detail kegiatan ini.');
    }

    public function preview(User $user, Activity $activity): Response
    {
        return $user->isAdmin() || $activity->author_id === $user->id ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk melihat preview kegiatan ini.');
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
}
