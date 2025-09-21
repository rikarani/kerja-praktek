<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleDriveService
{
    protected Drive $drive;

    public function __construct()
    {
        $client = new Client;

        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $client->addScope(Drive::DRIVE);
        $client->setAccessType('offline');

        $this->drive = new Drive($client);
    }

    public function upload(string $path, string $name)
    {
        $metadata = new DriveFile([
            'name' => $name,
            'parents' => [env('GOOGLE_DRIVE_FOLDER')],
        ]);

        $content = file_get_contents($path);

        return $this->drive->files->create($metadata, [
            'data' => $content,
            'uploadType' => 'multipart',
            'fields' => 'id,webViewLink',
        ]);
    }
}
