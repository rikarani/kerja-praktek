<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;

class ActivityController extends Controller
{
    public function detail(Activity $activity): View
    {
        return view('admin.activity.detail', [
            'title' => "Detail Kegiatan $activity->title",
            'activity' => $activity,
        ]);
    }

    public function preview(Activity $activity): View
    {
        return view('admin.activity.preview', [
            'title' => "Preview Kegiatan $activity->title",
            'activity' => $activity,
            'others' => Activity::published()->get()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
