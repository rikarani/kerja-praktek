<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class Detail extends Component
{
    public Activity $activity;

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    public function render(): View
    {
        return view('livewire.admin.activity.detail');
    }
}
