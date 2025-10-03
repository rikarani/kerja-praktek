<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('activity.index');
    }

    public function detail(Activity $activity): View
    {
        return view('activity.detail', [
            'activity' => $activity,
        ]);
    }
}
