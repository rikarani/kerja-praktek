<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('activity.index');
    }

    public function detail(Activity $activity): View
    {
        return view('activity.detail', [
            'activity' => $activity,
            'others' => Activity::all()->reject(fn ($item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }

    public function preview(Activity $activity): View
    {
        return view('admin.activity.preview', [
            'activity' => $activity,
            'others' => Activity::all()->reject(fn ($item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
