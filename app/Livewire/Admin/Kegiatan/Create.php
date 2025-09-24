<?php

namespace App\Livewire\Admin\Kegiatan;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public string $title;

    public string $type = '';

    public string $start_date;

    public string $description;

    public array $photos = [];

    public function submit()
    {
        // upload ke gdrive
        foreach ($this->photos as $photo) {
            // rename first
            $name = $this->title.' - '.$photo->getClientOriginalName();

            // then upload
            $photo->storeAs($this->title, $name, 'google');
        }

        Activity::query()->create([
            'title' => $this->title,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'description' => $this->description,
            'published' => false,
        ]);

        $this->redirectRoute('kegiatan.index');
    }

    public function render()
    {
        return view('livewire.admin.kegiatan.create');
    }
}
