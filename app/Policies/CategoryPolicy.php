<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->isAdmin() ? $this->allow() : $this->deny('Anda tidak memiliki akses untuk melihat kategori');
    }

    public function create(User $user): Response
    {
        return $user->isAdmin() ? $this->allow() : $this->deny('Anda tidak memiliki akses untuk membuat kategori');
    }

    public function update(User $user, Category $category): Response
    {
        return $user->isAdmin() ? $this->allow() : $this->deny('Anda tidak memiliki akses untuk mengubah kategori');
    }

    public function delete(User $user, Category $category): Response
    {
        return $user->isAdmin() ? $this->allow() : $this->deny('Anda tidak memiliki akses untuk menghapus kategori');
    }
}
