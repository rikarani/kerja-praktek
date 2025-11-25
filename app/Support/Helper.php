<?php

namespace App\Support;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class Helper
{
    private static ?Filesystem $storage = null;

    /**
     * Ambil semua link dokumentasi (foto & video), dipisah berdasarkan tipe.
     * Biasanya dipakai di tampilan gallery berita acara.
     */
    public static function getDocumentationLinks(Activity $activity): array
    {
        [$photosPath, $videosPath] = self::getPartitionedPaths($activity);

        return [
            $photosPath->map(fn ($path) => static::getPhotoURL($path)),
            $videosPath->map(fn ($path) => static::getVideoURL($path)),
        ];
    }

    public static function getExplorer(Activity $activity, ?string $path = null): array
    {
        $basePath = "{$activity->year}/{$activity->title}";
        $targetPath = $path ? "$basePath/$path" : $basePath;

        // ambil folder
        $folders = collect(self::storage()->directories($targetPath))
            ->map(fn ($dir) => Str::after($dir, "$targetPath/"))
            ->values()
            ->all();

        // ambil file
        $files = collect(self::storage()->files($targetPath))
            ->map(function ($file) {
                $extension = Str::lower(Str::afterLast($file, '.'));

                return [
                    'name' => basename($file),
                    'type' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])
                        ? 'photo'
                        : 'video',
                    'url' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])
                        ? static::getPhotoURL($file)
                        : static::getVideoURL($file),
                ];
            })
            ->values()
            ->all();

        return [
            'folders' => $folders,
            'files' => $files,
            'path' => $path,        // buat breadcrumb
        ];
    }

    /**
     * Hitung total foto dari dokumentasi kegiatan.
     */
    public static function getPhotoCount(Activity $activity): int
    {
        [$photosPath] = self::getPartitionedPaths($activity);

        return $photosPath->count();
    }

    /**
     * Hitung total video dari dokumentasi kegiatan.
     */
    public static function getVideoCount(Activity $activity): int
    {
        [, $videosPath] = self::getPartitionedPaths($activity);

        return $videosPath->count();
    }

    public static function extractID(string $url): ?string
    {
        preg_match('/\/d\/([^\/]+)/', $url, $m);

        return $m[1] ?? null;
    }

    /**
     * Invalidate the documentation cache for an activity.
     * Call this when files are added or removed.
     */
    public static function invalidateDocumentationCache(Activity $activity): void
    {
        $cacheKey = sprintf('activity_docs:%s:%s', $activity->year, $activity->slug);
        Cache::forget($cacheKey);
    }

    private static function getPartitionedPaths(Activity $activity): Collection
    {
        $cacheKey = sprintf('activity_docs:%s:%s', $activity->year, $activity->slug);

        return Cache::remember($cacheKey, Carbon::now()->addMinute(), function () use ($activity) {
            $paths = Collection::make(self::storage()->allFiles("{$activity->year}/{$activity->title}"));

            return $paths->partition(fn ($path) => Collection::make(['jpg', 'jpeg', 'png', 'gif'])
                ->contains(Str::lower(Str::afterLast($path, '.')))
            );
        });
    }

    /**
     * Generate URL foto (Google Drive direct image).
     */
    private static function getPhotoURL(string $path): string
    {
        $url = self::storage()->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://lh3.googleusercontent.com/d/$1', $url);
    }

    /**
     * Generate URL video (Google Drive preview link).
     */
    private static function getVideoURL(string $path): string
    {
        $url = self::storage()->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://drive.google.com/file/d/$1/preview', $url);
    }

    /**
     * Akses disk Google Drive hanya sekali.
     */
    private static function storage(): Filesystem
    {
        return self::$storage ??= Storage::disk('google');
    }
}
