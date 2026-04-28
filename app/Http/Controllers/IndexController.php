<?php

namespace App\Http\Controllers;

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

        return view('berita.detail', [
            'activity' => $activity,
            'title' => $activity->title,
        ]);
    }
}
