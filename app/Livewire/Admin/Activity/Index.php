<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public function publish(Activity $activity): void
    {
        $activity->update([
            'published' => true,
        ]);

        $this->redirectRoute('activity.index');
    }

    public function unpublish(Activity $activity): void
    {
        $activity->update([
            'published' => false,
        ]);

        $this->redirectRoute('activity.index');
    }

    public function hapus(Activity $activity): void
    {
        // delete from google drive
        Storage::disk('google')->delete($activity->title);

        // delete from db
        $activity->delete();

        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.admin.activity.index')->with([
            'activities' => Activity::latest()->paginate(4),
        ]);
    }
}
