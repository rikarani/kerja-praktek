<?php

namespace App\Livewire\Admin\Activity;

use App\Support\Helper;
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
        [$photos, $videos] = Helper::getDocumentationLinks($this->activity);

        return view('livewire.admin.activity.preview')->with([
            'photos' => $photos,
            'videos' => $videos,
        ]);
    }
}
