<?php

namespace App\Livewire\Modal\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;

class Update extends Component
{
    public ?Category $category = null;

    public string $name = '';

    #[On('update-category')]
    public function prepare(Category $category): void
    {
        $this->category = $category;
        $this->fill($this->category);

        $this->dispatch('open-modal', modal: 'update-category');
    }

    public function submit(): void
    {
        $this->authorize('update', $this->category);

        $data = $this->validate();
        $this->category->update($data);

        $this->dispatch('close-modal', modal: 'update-category');
        $this->redirectRoute('category.index');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('categories', 'name')->ignore($this?->category)],
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.admin.category.update');
    }
}
