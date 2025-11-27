<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __invoke(): View
    {
        Gate::authorize('view-any', Category::class);

        return view('admin.category.index', [
            'title' => 'Manajemen Kategori',
        ]);
    }
}
