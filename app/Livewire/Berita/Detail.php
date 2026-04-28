<?php

namespace App\Livewire\Berita;

use App\Support\Helper;
use Livewire\Component;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class Detail extends Component
{
    public ?Activity $activity = null;

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    public function render(): View
    {
        [$photos, $videos] = Helper::getDocumentationLinks($this->activity);

        return view('livewire.berita.detail')->with([
            'title' => "Kegiatan {$this->activity->title}",
            'activity' => $this->activity,
            'photos' => $photos,
            'videos' => $videos,
        ]);
    }
}
