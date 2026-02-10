<?php

namespace App\Livewire\Modal\Admin\Activity;

use App\Support\Helper;
use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
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

    #[Url]
    public ?string $path = null;

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
        $this->redirect("/kegiatan/{$this->activity->slug}/detail?path=$this->path");
    }

    public function render(): View
    {
        return view('livewire.modal.admin.activity.add-documentations')->with([
            'folders' => Helper::getExplorer($this->activity, $this->path)['folders'],
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
        if (filled($this->path)) {
            if (filled($this->folder)) {
                $documentation->storeAs("{$this->activity->year}/{$this->activity->title}/$this->path/{$this->folder}", $documentation->getClientOriginalName(), 'google');
            } else {
                $documentation->storeAs("{$this->activity->year}/{$this->activity->title}/$this->path", $documentation->getClientOriginalName(), 'google');
            }
        } else {
            if (filled($this->folder)) {
                $documentation->storeAs("{$this->activity->year}/{$this->activity->title}/{$this->folder}", $documentation->getClientOriginalName(), 'google');
            } else {
                $documentation->storeAs("{$this->activity->year}/{$this->activity->title}", $documentation->getClientOriginalName(), 'google');
            }
        }
    }
}
