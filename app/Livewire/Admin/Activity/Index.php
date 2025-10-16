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
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url(except: '')]
    public string $bulan = '';

    public function publish(Activity $activity): void
    {
        $activity->update([
            'published' => true,
        ]);

        $this->redirectRoute('activity.index', $this->getQueryString());
    }

    public function unpublish(Activity $activity): void
    {
        $activity->update([
            'published' => false,
        ]);

        $this->redirectRoute('activity.index', $this->getQueryString());
    }

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
        return view('livewire.admin.activity.index')->with([
            'months' => Collection::make(range(1, 12))->map(fn (int $month) => Carbon::create(null, $month)->translatedFormat('F')),
            'activities' => Activity::query()->when($this->bulan, fn (Builder $query) => $query->whereMonth('start_date', Carbon::parseFromLocale($this->bulan, 'id_ID')->month))->when($this->search, fn (Builder $query) => $query->whereLike('title', "%$this->search%"))->latest()->paginate(4),
        ]);
    }

    private function getQueryString(): array
    {
        $params = Collection::make();

        if ($this->search) {
            $params->put('search', $this->search);
        }

        if ($this->bulan) {
            $params->put('bulan', $this->bulan);
        }

        return $params->toArray();
    }
}
