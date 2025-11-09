<?php

namespace App\Providers;

use Google\Client;
use Google\Service\Drive;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Masbug\Flysystem\GoogleDriveAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Contracts\Foundation\Application;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Storage::extend('google', function (Application $app, array $config): FilesystemAdapter {
            $client = new Client;
            $client->setAuthConfig(storage_path('app/google/secret.json'));
            $client->addScope(Drive::DRIVE);

            $adapter = new GoogleDriveAdapter(new Drive($client), null, [
                'sharedFolderId' => $config['sharedFolderId'] ?? null,
            ]);

            return new FilesystemAdapter(new Filesystem($adapter), $adapter);
        });
    }
}
