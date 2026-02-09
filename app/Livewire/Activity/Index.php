<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;

class Index extends Component
{
    #[Url]
    public string $search = '';

    #[Url(except: '')]
    public string $category = '';

    public function render(): View
    {
        return view('livewire.activity.index')->with([
            'activities' => Activity::published()->filters(['search' => $this->search, 'category' => $this->category])->latest()->get(),
            'categories' => Category::all(),
        ]);
    }
}
