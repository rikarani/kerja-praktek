<?php

namespace App\Http\Controllers;

use App\Support\Helper;
use App\Models\Activity;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityFileController extends Controller
{
    public function download(Activity $activity, string $path): StreamedResponse
    {
        parse_str(parse_url(URL::previous(), PHP_URL_QUERY), $query);

        if (! empty($query['path'])) {
            $folder = $query['path'];

            return Storage::disk('google')->download("{$activity->year}/{$activity->title}/$folder/$path");
        }

        return Storage::disk('google')->download("{$activity->year}/{$activity->title}/$path");
    }

    public function delete(Activity $activity, string $path): RedirectResponse
    {
        parse_str(parse_url(URL::previous(), PHP_URL_QUERY), $query);
        $filePath = "{$activity->year}/{$activity->title}/$path";

        if (! empty($query['path'])) {
            $folder = $query['path'];
            $filePath = "{$activity->year}/{$activity->title}/$folder/$path";
        }

        Storage::disk('google')->delete($filePath);
        Helper::invalidateDocumentationCache($activity);

        return back();
    }
}
