<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rules\File;
use Spatie\LivewireFilepond\WithFilePond;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Create extends Component
{
    use WithFilePond, WithFileUploads;

    public string $title;

    public string $type = '';

    public string $start_date;

    public string $excerpt;

    public string $description;

    public array $documentations = [];

    public function saveAsDraft(): void
    {
        $this->createActivity(shouldPublish: false);
    }

    public function saveAndPublish(): void
    {
        $this->createActivity(shouldPublish: true);
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:activities,title', 'max:255'],
            'type' => ['required'],
            'start_date' => ['required'],
            'excerpt' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'max:10000'],
            'documentations' => ['required'],
            'documentations.*' => File::types(['jpg', 'jpeg', 'png', 'mp4']),
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul harus berupa teks',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'title.unique' => 'Judul sudah ada, silakan gunakan judul lain',
            'type.required' => 'Jenis kegiatan harus dipilih',
            'start_date.required' => 'Tanggal kegiatan harus diisi',
            'excerpt.required' => 'Ringkasan harus diisi',
            'excerpt.string' => 'Ringkasan harus berupa teks',
            'excerpt.max' => 'Ringkasan tidak boleh lebih dari 255 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.max' => 'Deskripsi tidak boleh lebih dari 10000 karakter',
            'documentations.required' => 'upload la dokumentasi ni',
            'documentations.*.mimes' => 'format yang dibolehkan: :values',
        ];
    }

    private function createActivity(bool $shouldPublish): void
    {
        $data = $this->validate();

        foreach ($data['documentations'] as $documentation) {
            $this->uploadDocumentation($documentation);
        }

        Activity::create([
            'title' => $data['title'],
            'type' => $data['type'],
            'start_date' => Carbon::parseFromLocale($data['start_date'], 'id_ID'),
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'published' => $shouldPublish,
        ]);

        $this->redirectRoute('activity.index');
    }

    private function uploadDocumentation(TemporaryUploadedFile $documentation): void
    {
        $documentation->storeAs($this->title, "{$this->title} - {$documentation->getClientOriginalName()}", 'google');
    }

    public function render(): View
    {
        return view('livewire.admin.activity.create');
    }
}
