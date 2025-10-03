<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;

class Index extends Component
{
    #[Url]
    public string $search = '';

    public function render(): View
    {
        return view('livewire.activity.index')->with([
            'activities' => Activity::published()->search($this->search)->latest()->get(),
        ]);
    }
}
