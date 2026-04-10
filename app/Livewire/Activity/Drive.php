<?php

namespace App\Livewire\Activity;

use App\Support\Helper;
use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;

class Drive extends Component
{
    public Activity $activity;

    #[Url]
    public ?string $path = null;

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    public function render(): View
    {
        return view('livewire.activity.drive')->with([
            'explorer' => Helper::getExplorer($this->activity, $this->path),
        ]);
    }
}
