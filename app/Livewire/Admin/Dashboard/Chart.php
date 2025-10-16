<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;

class Chart extends Component
{
    public function render(): View
    {
        return view('livewire.admin.dashboard.chart')->with([
            'sales' => Activity::all()->groupBy(fn ($activity) => Carbon::parse($activity->start_date)->month)->sortKeys()->mapWithKeys(fn ($group, $month) => [
                Carbon::create()->month($month)->translatedFormat('F') => $group->count(),
            ])->toArray(),
        ]);
    }
}
