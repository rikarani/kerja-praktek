<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Url(except: '')]
    public string $bulan = '';

    #[Url(except: '')]
    public string $tahun = '';

    public function hapus(Activity $activity): void
    {
        // delete from google drive
        Storage::disk('google')->delete($activity->title);

        // delete from db
        $activity->delete();

        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        $bulan = $this->bulan ? Carbon::parseFromLocale($this->bulan, 'id')->month : null;

        return view('livewire.admin.activity.index')->with([
            'months' => Collection::make(range(1, 12))->map(fn (int $month) => Carbon::create(null, $month)->translatedFormat('F')),
            'years' => Activity::pluck('year')->unique()->sort(),
            'activities' => Activity::bulan($bulan)->tahun($this->tahun)->search($this->search)->latest()->paginate(5),
        ]);
    }
}
