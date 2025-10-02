<?php

namespace App\Livewire\Admin\Kegiatan;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.admin.kegiatan.index')->with([
            'activities' => Activity::all(),
        ]);
    }

    public function publish(Activity $activity): void
    {
        $activity->update([
            'published' => true,
        ]);

        $this->redirectRoute('kegiatan.index');
    }

    public function unpublish(Activity $activity): void
    {
        $activity->update([
            'published' => false,
        ]);

        $this->redirectRoute('kegiatan.index');
    }

    public function hapus(Activity $activity): void
    {
        // delete from google drive
        Storage::disk('google')->delete($activity->title);

        // delete from db
        $activity->delete();

        $this->redirectRoute('kegiatan.index');
    }
}
