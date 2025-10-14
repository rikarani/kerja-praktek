<?php

namespace App\Support;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function getDocumentationLinks(array $paths)
    {
        $photos = Collection::make();
        $videos = Collection::make();

        foreach ($paths as $path) {
            $extension = Str::afterLast($path, '.');

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $photos->push(self::getPhotoURL($path));
            } elseif (in_array($extension, ['mp4'])) {
                $videos->push(self::getVideoURL($path));
            }
        }

        return [$photos, $videos];
    }

    private static function getPhotoURL(string $path)
    {
        $url = Storage::disk('google')->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://lh3.googleusercontent.com/d/$1', $url);
    }

    private static function getVideoURL(string $path)
    {
        $url = Storage::disk('google')->url($path);

        return preg_replace('/^.*id=([^&]+).*$/', 'https://drive.google.com/file/d/$1/preview', $url);
    }
}
