<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class AddFolder extends Component
{
    public ?Activity $activity = null;

    public string $title = '';

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

        Storage::disk('google')->makeDirectory("{$this->activity->year}/{$this->activity->title}/{$data['title']}");

        $this->dispatch('close-modal');
        $this->redirectRoute('admin.activity.detail', ['activity' => $this->activity]);
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
