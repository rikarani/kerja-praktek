<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->isAdmin() ? $this->allow() : $this->deny('Anda tidak memiliki akses untuk melihat user');
    }

    public function create(User $user): bool {}

    public function update(User $user, User $model): bool {}

    public function delete(User $user, User $model): bool {}
}
