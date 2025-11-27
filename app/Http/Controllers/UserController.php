<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __invoke(): View
    {
        Gate::authorize('view-any', User::class);

        return view('admin.user.index', [
            'title' => 'Manajemen User',
        ]);
    }
}
