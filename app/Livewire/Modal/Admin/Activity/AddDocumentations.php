<?php

namespace App\Livewire\Modal\Admin\Activity;

use App\Support\Helper;
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

    public string $folder = '';

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

        Helper::invalidateDocumentationCache($this->activity);

        $this->dispatch('close-modal');
        $this->redirectRoute('admin.activity.detail', ['activity' => $this->activity]);
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.add-documentations')->with([
            'folders' => Helper::getExplorer($this->activity)['folders'],
        ]);
    }

    protected function rules(): array
    {
        return [
            'folder' => ['nullable', 'string'],
            'documentations' => ['required', 'array'],
            'documentations.*' => File::types(['jpg', 'jpeg', 'png', 'mp4']),
        ];
    }

    private function uploadDocumentation(TemporaryUploadedFile $documentation): void
    {
        if (filled($this->folder)) {
            $documentation->storeAs("{$this->activity->year}/{$this->activity->title}/$this->folder", "{$this->activity->title} - {$documentation->getClientOriginalName()}", 'google');
        } else {
            $documentation->storeAs("{$this->activity->year}/{$this->activity->title}", "{$this->activity->title} - {$documentation->getClientOriginalName()}", 'google');

        }

    }
}
