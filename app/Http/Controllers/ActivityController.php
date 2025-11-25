<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function detail(Activity $activity): View
    {
        if (Auth::user()->cannot('view', $activity)) {
            abort(403, 'Anda tidak memiliki izin untuk melihat detail kegiatan ini');
        }

        return view('admin.activity.detail', [
            'title' => "Detail Kegiatan $activity->title",
            'activity' => $activity,
        ]);
    }

    public function preview(Activity $activity): View
    {
        if (Auth::user()->cannot('view', $activity)) {
            abort(403, 'Anda tidak memiliki izin untuk melihat preview kegiatan ini');
        }

        return view('admin.activity.preview', [
            'title' => "Preview Kegiatan $activity->title",
            'activity' => $activity,
            'others' => Activity::all()->reject(fn (Activity $item) => $item->id === $activity->id)->shuffle()->take(4),
        ]);
    }
}
