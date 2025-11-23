<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityFileController extends Controller
{
    public function download(Activity $activity, string $path): StreamedResponse
    {
        return Storage::disk('google')->download("{$activity->year}/{$activity->title}/$path");
    }

    public function delete(Activity $activity, string $path)
    {
        Storage::disk('google')->delete("{$activity->year}/{$activity->title}/$path");

        return to_route('admin.activity.detail', ['activity' => $activity]);
    }
}
