<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    public ?Activity $activity = null;

    public string $originalTitle = '';

    public string $originalYear = '';

    public string $title = '';

    public string $category_id = '';

    public string $start_date = '';

    public string $excerpt = '';

    public string $description = '';

    public function mount(Activity $activity): void
    {
        $this->activity = $activity;

        $this->fill([
            'originalTitle' => $activity->title,
            'originalYear' => $activity->year,
            'title' => $activity->title,
            'category_id' => $activity->category_id,
            'start_date' => $activity->start_date->translatedFormat('d F Y'),
            'excerpt' => $activity->excerpt,
            'description' => $activity->description,
        ]);
    }

    public function save(): void
    {
        $this->authorize('update', $this->activity);

        $data = $this->validate();
        $year = $this->getYearFromDate($data['start_date']);

        if ($this->originalYear !== $year || $this->originalTitle !== $data['title']) {
            $oldPath = "$this->originalYear/$this->originalTitle";
            $newPath = "$year/{$data['title']}";

            Storage::disk('google')->move($oldPath, $newPath);
        }

        $this->activity->update([
            ...$data,
            'year' => $year,
            'start_date' => Carbon::parseFromLocale($data['start_date'], 'id'),
        ]);

        Toaster::success('Kegiatan berhasil diperbarui');
        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.activity.edit')->with([
            'categories' => Category::all(),
        ]);
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('activities')->where('year', $this->getYearFromDate($this->start_date))->ignore($this->activity)],
            'category_id' => ['required', 'exists:categories,id'],
            'start_date' => ['required'],
            'excerpt' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'max:10000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul harus berupa teks',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'title.unique' => 'Judul sudah ada, silakan gunakan judul lain',
            'category_id.required' => 'Jenis kegiatan harus dipilih',
            'category_id.exists' => 'Jenis kegiatan tidak valid',
            'start_date.required' => 'Tanggal kegiatan harus diisi',
            'excerpt.required' => 'Ringkasan harus diisi',
            'excerpt.string' => 'Ringkasan harus berupa teks',
            'excerpt.max' => 'Ringkasan tidak boleh lebih dari 500 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.max' => 'Deskripsi tidak boleh lebih dari 10000 karakter',
        ];
    }

    private function getYearFromDate(string $date): int
    {
        return Carbon::parseFromLocale($date, 'id')->year;
    }
}
