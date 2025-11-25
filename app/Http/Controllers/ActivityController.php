<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class ActivityController extends Controller
{
    public function detail(Activity $activity): View
    {
        $response = Gate::inspect('detail', $activity);

        if (! $response->allowed()) {
            abort(403, $response->message());
        }

        return view('admin.activity.detail', [
            'title' => "Detail Kegiatan $activity->title",
            'activity' => $activity,
        ]);
    }

    public function preview(Activity $activity): View
    {
        $response = Gate::inspect('preview', $activity);

        if (! $response->allowed()) {
            abort(403, $response->message());
        }

        return view('admin.activity.preview', [
            'title' => "Preview Kegiatan $activity->title",
            'activity' => $activity,
            'others' => Activity::all()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
