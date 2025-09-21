<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleDriveService;

class DriveController extends Controller
{
    public function upload(Request $request, GoogleDriveService $drive)
    {
        $data = $request->validate([
            'file' => ['required'],
        ]);

        $name = $data['file']->getClientOriginalName();

        $request->file('file')->storeAs('pmkm', $name, 'google');

        return back();
    }
}
