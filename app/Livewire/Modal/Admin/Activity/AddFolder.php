<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class AddFolder extends Component
{
    public ?Activity $activity = null;

    public string $title = '';

    #[Url]
    public ?string $path = null;

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    #[On('add-folder')]
    public function prepare(): void
    {
        $this->dispatch('open-modal', modal: 'add-folder');
    }

    public function addFolder(): void
    {
        $data = $this->validate();

        if (filled($this->path)) {
            Storage::disk('google')->makeDirectory("{$this->activity->year}/{$this->activity->title}/$this->path/{$data['title']}");

            $this->redirect("/kegiatan/{$this->activity->slug}/detail?path=$this->path");
        } else {
            Storage::disk('google')->makeDirectory("{$this->activity->year}/{$this->activity->title}/{$data['title']}");

            $this->redirectRoute('admin.activity.detail', ['activity' => $this->activity]);
        }

        $this->dispatch('close-modal');
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.add-folder');
    }
}
