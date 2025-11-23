<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;

class Unpublish extends Component
{
    public ?Activity $activity = null;

    #[On('unpublish-activity')]
    public function prepare(Activity $activity): void
    {
        $this->activity = $activity;

        $this->dispatch('open-modal', modal: 'unpublish-activity');
    }

    public function unpublish(): void
    {
        $this->activity?->update(['published' => false]);

        $this->dispatch('close-modal');
        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.unpublish');
    }
}
