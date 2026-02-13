<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class RenameFolder extends Component
{
    public string $new = '';

    public string $old = '';

    #[Url]
    public ?string $path = null;

    public ?Activity $activity = null;

    #[On('rename-folder')]
    public function prepare(Activity $activity, string $old): void
    {
        $this->activity = $activity;
        $this->old = $old;

        $this->dispatch('open-modal', modal: 'rename-folder');
    }

    public function rename(): void
    {
        if (filled($this->path)) {
            Storage::disk('google')->move("{$this->activity->year}/{$this->activity->title}/{$this->path}/{$this->old}", "{$this->activity->year}/{$this->activity->title}/{$this->path}/{$this->new}");

            $this->redirect("/kegiatan/{$this->activity->slug}/detail?path=$this->path");
        } else {
            Storage::disk('google')->move("{$this->activity->year}/{$this->activity->title}/{$this->old}", "{$this->activity->year}/{$this->activity->title}/{$this->new}");

            $this->redirectRoute('admin.activity.detail', ['activity' => $this->activity->slug]);
        }

        $this->dispatch('close-modal');
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string'],
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.rename-folder');
    }
}
