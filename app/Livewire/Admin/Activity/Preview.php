<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class Preview extends Component
{
    public Activity $activity;

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    public function publish(): void
    {
        $this->activity->update(['published' => true]);

        $this->redirectRoute('activity.index');
    }

    public function unpublish(): void
    {
        $this->activity->update(['published' => false]);

        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.admin.activity.preview');
    }
}
