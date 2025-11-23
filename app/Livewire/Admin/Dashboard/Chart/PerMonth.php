<?php

namespace App\Livewire\Admin\Dashboard\Chart;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PerMonth extends Component
{
    public $selectedYear;

    public function mount(): void
    {
        $this->selectedYear = Carbon::now()->year;
    }

    public function updatedSelectedYear(): void
    {
        $this->dispatch('update-chart', data: $this->getChartData());
    }

    private function getChartData(): array
    {
        $raw = DB::table('activities as a')
            ->join('categories as c', 'c.id', '=', 'a.category_id')
            ->selectRaw('
        MONTH(a.start_date) as month,
        c.name as category,
        COUNT(*) as total
    ')
            ->where('a.year', $this->selectedYear)
            ->groupBy('month', 'category')
            ->orderBy('month')
            ->get();

        $categories = $raw->pluck('category')->unique()->values();
        $months = Collection::make(range(1, 12));
        $series = Collection::make([]);

        foreach ($categories as $cat) {
            $series->push([
                'name' => $cat,
                'data' => $months->map(function ($m) use ($raw, $cat) {

                    // CARI baris: month = M dan category = CAT
                    $row = $raw->first(function ($item) use ($m, $cat) {
                        return $item->month == $m && $item->category == $cat;
                    });

                    // kalau ada → total, kalau tidak → 0
                    return $row?->total ?? 0;

                })->toArray(),
            ]);
        }

        return [
            'months' => $months->map(fn ($m) => Carbon::create()->month($m)->translatedFormat('F'))->toArray(),
            'series' => $series,
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard.chart.per-month')->with([
            'years' => Activity::select('year')->distinct()->orderByDesc('year')->pluck('year')->toArray(),
            'data' => $this->getChartData(),
        ]);
    }
}
