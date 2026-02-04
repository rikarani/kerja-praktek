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
use Illuminate\Support\Facades\Request;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Url(as: 'bulan', except: '')]
    public string $month = '';

    #[Url(as: 'tahun', except: '')]
    public string $year = '';

    public string $kategori = '';

    public string $author = '';

    public function mount(): void
    {
        $this->kategori = Request::query('kategori', '');
        $this->author = Request::query('author', '');
    }

    public function render(): View
    {
        $filters = [
            'month' => $this->getMonth(),
            'year' => $this->year,
            'search' => $this->search,
            'category' => $this->kategori,
            'author' => $this->author,
            'author_only' => Auth::user()->isAdmin() ? null : Auth::id(),
        ];

        return view('livewire.admin.activity.index')->with([
            'months' => Collection::make(range(1, 12))->map(fn (int $month) => Carbon::create(null, $month)->translatedFormat('F')),
            'years' => Activity::pluck('year')->unique()->sort(),
            'activities' => Activity::filters($filters)->latest()->paginate(5),
        ]);
    }

    private function getMonth(): ?int
    {
        return $this->month ? Carbon::parseFromLocale($this->month, 'id')->month : null;
    }

    private function mapMonth(): Collection
    {
        return Collection::make(range(1, 12))->map(fn (int $month) => Carbon::create(null, $month)->translatedFormat('F'));
    }
}
