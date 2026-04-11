<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class ActivityController extends Controller
{
    public function drive(Activity $activity): View
    {
        Gate::authorize('view', $activity);

        return view('activity.drive', [
            'title' => "Detail Kegiatan $activity->title",
            'activity' => $activity,
        ]);
    }

    public function edit(Activity $activity): View
    {
        return view('activity.edit', [
            'title' => "Edit Kegiatan $activity->title",
            'activity' => $activity,
        ]);
    }

    public function preview(Activity $activity): View
    {
        Gate::authorize('view', $activity);

        return view('activity.preview', [
            'title' => "Preview Kegiatan $activity->title",
            'activity' => $activity,
            'others' => Activity::all()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
