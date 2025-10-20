<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    #[Url]
    public string $search = '';

    public function render(): View
    {
        return view('livewire.admin.category.index')->with([
            'categories' => Category::when($this->search, fn (Builder $query) => $query->whereLike('name', "%$this->search%"))->latest()->paginate(6),
        ]);
    }
}
