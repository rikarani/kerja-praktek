<?php

namespace App\Http\Controllers;

use App\Support\Helper;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('berita.index');
    }

    public function detail(Activity $activity): View
    {
        abort_unless($activity->published, 404);

        [$photos, $videos] = Helper::getDocumentationLinks($activity);

        return view('berita.detail', [
            'title' => "Kegiatan $activity->title",
            'activity' => $activity,
            'photos' => $photos,
            'videos' => $videos,
        ]);
    }
}
