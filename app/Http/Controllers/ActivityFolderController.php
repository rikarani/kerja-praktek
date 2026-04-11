<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ActivityFolderController extends Controller
{
    public function __invoke(Request $request, Activity $activity, string $path): RedirectResponse
    {
        if ($request->has('path')) {
            $fullPath = $request->query('path');

            Storage::disk('google')->deleteDirectory("{$activity->year}/{$activity->title}/$fullPath/$path");
        } else {
            Storage::disk('google')->deleteDirectory("{$activity->year}/{$activity->title}/$path");
        }

        return to_route('activity.drive', ['activity' => $activity->slug]);
    }
}
