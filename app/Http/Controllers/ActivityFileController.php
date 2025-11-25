<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Support\Helper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityFileController extends Controller
{
    public function download(Activity $activity, string $path): StreamedResponse
    {
        return Storage::disk('google')->download("{$activity->year}/{$activity->title}/$path");
    }

    public function delete(Activity $activity, string $path): RedirectResponse
    {
        Storage::disk('google')->delete("{$activity->year}/{$activity->title}/$path");
        Helper::invalidateDocumentationCache($activity);

        return to_route('admin.activity.detail', ['activity' => $activity]);
    }
}
