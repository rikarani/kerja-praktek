<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('activity.index');
    }

    public function detail(Activity $activity): View
    {
        abort_unless($activity->published, 404);

        return view('activity.detail', [
            'title' => "Kegiatan $activity->title",
            'activity' => $activity,
            'others' => Activity::all()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }

    public function preview(Activity $activity): View
    {
        Gate::authorize('view', $activity);

        return view('admin.activity.preview', [
            'title' => "Preview $activity->title",
            'activity' => $activity,
            'others' => Activity::all()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
