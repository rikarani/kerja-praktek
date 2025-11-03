<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    public function render(): View
    {
        return view('livewire.admin.user.index')->with([
            'users' => User::with('activities')
                ->whereDoesntHave('role', fn (Builder $query) => $query->where('name', 'Admin'))
                ->search($this->search)
                ->latest()
                ->except(Auth::user())
                ->paginate(6),
        ]);
    }
}
