<?php

namespace App\Livewire\Admin\Dashboard\Chart;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PerYear extends Component
{
    private function getChartData(): array
    {
        $raw = DB::table('activities as a')
            ->join('categories as c', 'c.id', '=', 'a.category_id')
            ->selectRaw('a.year, c.name as category, COUNT(*) as total')
            ->groupBy('a.year', 'category')
            ->orderBy('a.year')
            ->get();

        $years = $raw->pluck('year')->unique()->sort()->values();
        $categories = $raw->pluck('category')->unique()->sort()->values();

        $lookup = [];
        foreach ($raw as $item) {
            $lookup[$item->category][$item->year] = $item->total;
        }

        $series = [];
        foreach ($categories as $cat) {
            $series[] = [
                'name' => $cat,
                'data' => $years->map(function ($y) use ($lookup, $cat) {
                    return $lookup[$cat][$y] ?? 0;
                })->toArray(),
            ];
        }

        return [
            'years' => $years,
            'series' => $series,
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard.chart.per-year')->with([
            'data' => $this->getChartData(),
        ]);
    }
}
