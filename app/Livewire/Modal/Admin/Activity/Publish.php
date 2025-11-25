<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;

class Publish extends Component
{
    public ?Activity $activity = null;

    #[On('publish-activity')]
    public function prepare(Activity $activity): void
    {
        $this->activity = $activity;

        $this->dispatch('open-modal', modal: 'publish-activity');
    }

    public function publish(): void
    {
        $this->activity?->update(['published' => true]);

        $this->dispatch('close-modal');
        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.publish');
    }
}
