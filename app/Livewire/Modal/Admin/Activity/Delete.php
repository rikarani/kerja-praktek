<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use App\Support\Helper;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public ?Activity $activity = null;

    #[On('delete-activity')]
    public function prepare(Activity $activity): void
    {
        $this->activity = $activity;

        $this->dispatch('open-modal', modal: 'delete-activity');
    }

    public function hapus(): void
    {
        Storage::disk('google')->deleteDirectory("{$this->activity?->year}/{$this->activity?->title}");
        if ($this->activity) {
            Helper::invalidateDocumentationCache($this->activity);
        }
        $this->activity?->delete();

        $this->dispatch('close-modal', modal: 'delete-activity');
        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.delete');
    }
}
