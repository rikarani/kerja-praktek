<?php

namespace App\Support;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class Helper
{
    private static ?Filesystem $storage = null;

    public static function getDocumentationLinks(Activity $activity): array
    {
        $paths = Collection::make(self::storage()->allFiles("$activity->year/$activity->title"));

        [$photosPath, $videosPath] = $paths->partition(fn ($path) => Collection::make(['jpg', 'jpeg', 'png', 'gif'])->contains(Str::afterLast($path, '.')));

        return [
            $photosPath->map(fn ($path) => static::getPhotoURL($path)),
            $videosPath->map(fn ($path) => static::getVideoURL($path)),
        ];
    }

    public static function getPhotoCount(Activity $activity): int
    {
        return static::getDocumentationCounts($activity)['photos'];
    }

    public static function getVideoCount(Activity $activity): int
    {
        return static::getDocumentationCounts($activity)['videos'];
    }

    private static function getDocumentationCounts(Activity $activity): array
    {
        $paths = Collection::make(self::storage()->allFiles("$activity->year/$activity->title"));

        [$photosPath, $videosPath] = $paths->partition(fn ($path) => Collection::make(['jpg', 'jpeg', 'png', 'gif'])->contains(Str::afterLast($path, '.')));

        return [
            'photos' => $photosPath->count(),
            'videos' => $videosPath->count(),
        ];
    }

    private static function getPhotoURL(string $path): string
    {
        $url = self::storage()->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://lh3.googleusercontent.com/d/$1', $url);
    }

    private static function getVideoURL(string $path): string
    {
        $url = self::storage()->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://drive.google.com/file/d/$1/preview', $url);
    }

    private static function storage(): Filesystem
    {
        return self::$storage ??= Storage::disk('google');
    }
}
