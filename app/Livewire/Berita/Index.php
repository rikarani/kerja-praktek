<?php

namespace App\Livewire\Berita;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url(except: '')]
    public string $category = '';

    public function render(): View
    {
        return view('livewire.berita.index')->with([
            'activities' => Activity::published()->filters(['search' => $this->search, 'category' => $this->category])->latest()->simplePaginate(3),
            'categories' => Category::all(),
        ]);
    }
}
