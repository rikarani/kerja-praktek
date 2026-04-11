<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Activity $activity): Response
    {
        return $activity->author_id === $user->id ? $this->allow() : $this->deny('Tidak dapat melihat kegiatan yang bukan milik Anda');
    }

    public function update(User $user, Activity $activity): Response
    {
        return $activity->author_id === $user->id ? $this->allow() : $this->deny('Tidak dapat mengedit kegiatan yang bukan milik Anda');
    }

    public function delete(User $user, Activity $activity): Response
    {
        return $activity->author_id === $user->id ? $this->allow() : $this->deny('Tidak dapat menghapus kegiatan yang bukan milik Anda');
    }
}
