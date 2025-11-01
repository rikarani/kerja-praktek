<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Url(as: 'bulan', except: '')]
    public string $month = '';

    #[Url(as: 'tahun', except: '')]
    public string $year = '';

    public function hapus(Activity $activity): void
    {
        Storage::disk('google')->delete($activity->title);
        $activity->delete();

        $this->redirectRoute('activity.index');
    }

    public function render(): View
    {
        return view('livewire.admin.activity.index')->with([
            'months' => Collection::make(range(1, 12))->map(fn (int $month) => Carbon::create(null, $month)->translatedFormat('F')),
            'years' => Activity::pluck('year')->unique()->sort(),
            'activities' => Activity::month($this->getMonth())->year($this->year)->search($this->search)->when(! Auth::user()->isAdmin(), fn (Builder $query) => $query->where('author_id', Auth::id()))->latest()->paginate(5),
        ]);
    }

    private function getMonth(): ?int
    {
        return $this->month ? Carbon::parseFromLocale($this->month, 'id')->month : null;
    }
}
