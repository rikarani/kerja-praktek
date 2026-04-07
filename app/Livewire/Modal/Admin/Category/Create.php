<?php

namespace App\Livewire\Modal\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class Create extends Component
{
    public string $name = '';

    #[On('create-category')]
    public function prepare(): void
    {
        $this->dispatch('open-modal', modal: 'create-category');
    }

    public function submit(): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $data = $this->validate();

        Category::create($data);

        $this->dispatch('close-modal');

        return Redirect::route('category.index')->success('Kategori berhasil ditambahkan');
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('categories', 'name')],
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.admin.category.create');
    }
}
