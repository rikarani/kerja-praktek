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

    public string $description;

    public array $documentations = [];

    public function save(): void
    {
        $data = $this->validate();

        foreach ($data['documentations'] as $documentation) {
            $this->uploadDocumentation($documentation);
        }

        Activity::create([
            'title' => $data['title'],
            'type' => $data['type'],
            'start_date' => Carbon::parseFromLocale($data['start_date'], 'id_ID'),
            'description' => $data['description'],
            'published' => false,
        ]);

        $this->redirectRoute('activity.index');
    }

    public function saveAndPublish(): void
    {
        $data = $this->validate();

        foreach ($data['documentations'] as $documentation) {
            $this->uploadDocumentation($documentation);
        }

        Activity::create([
            'title' => $data['title'],
            'type' => $data['type'],
            'start_date' => Carbon::parseFromLocale($data['start_date'], 'id_ID'),
            'description' => $data['description'],
            'published' => true,
        ]);

        $this->redirectRoute('activity.index');
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'start_date' => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'documentations' => ['required'],
            'documentations.*' => File::types(['jpg', 'jpeg', 'png', 'mp4'])->max('2mb'),
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul harus berupa teks',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'type.required' => 'Jenis kegiatan harus dipilih',
            'start_date.required' => 'Tanggal kegiatan harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'documentations.required' => 'upload la dokumentasi ni',
            'documentations.*.mimes' => 'format yang dibolehkan: :values',
            'documentations.*.max' => 'max tiap file 2mb',
        ];
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
