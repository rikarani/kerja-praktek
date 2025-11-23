<?php

namespace App\Livewire\Modal\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rules\File;
use Spatie\LivewireFilepond\WithFilePond;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AddDocumentations extends Component
{
    use WithFilePond, WithFileUploads;

    public ?Activity $activity = null;

    public array $documentations = [];

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;
    }

    #[On('add-documentations')]
    public function prepare(): void
    {
        $this->dispatch('open-modal', modal: 'add-documentations');
    }

    public function addDocumentation(): void
    {
        $data = $this->validate();

        foreach ($data['documentations'] as $documentation) {
            $this->uploadDocumentation($documentation);
        }

        $this->dispatch('close-modal');
        $this->redirectRoute('admin.activity.detail', ['activity' => $this->activity]);
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.add-documentations');
    }

    protected function rules(): array
    {
        return [
            'documentations' => ['required'],
            'documentations.*' => File::types(['jpg', 'jpeg', 'png', 'mp4']),
        ];
    }

    private function uploadDocumentation(TemporaryUploadedFile $documentation): void
    {
        $documentation->storeAs("{$this->activity->year}/{$this->activity->title}", "{$this->activity->title} - {$documentation->getClientOriginalName()}", 'google');
    }
}
