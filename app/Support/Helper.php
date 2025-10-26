<?php

namespace App\Support;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function getDocumentationLinks(Activity $activity): array
    {
        $paths = Collection::make(Storage::disk('google')->allFiles("$activity->year/$activity->title"));

        [$photosPath, $videosPath] = $paths->partition(fn ($path) => Collection::make(['jpg', 'jpeg', 'png', 'gif'])->contains(Str::afterLast($path, '.')));

        return [
            $photosPath->map(fn ($path) => static::getPhotoURL($path)),
            $videosPath->map(fn ($path) => static::getVideoURL($path)),
        ];
    }

    private static function getPhotoURL(string $path): string
    {
        $url = Storage::disk('google')->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://lh3.googleusercontent.com/d/$1', $url);
    }

    private static function getVideoURL(string $path): string
    {
        $url = Storage::disk('google')->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://drive.google.com/file/d/$1/preview', $url);
    }
}
