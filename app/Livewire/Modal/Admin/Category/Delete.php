<?php

namespace App\Livewire\Modal\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;

class Delete extends Component
{
    public ?Category $category = null;

    #[On('delete-category')]
    public function prepare(Category $category): void
    {
        $this->category = $category;

        $this->dispatch('open-modal', modal: 'delete-category');
    }

    public function hapus(): void
    {
        $this->category?->delete();

        $this->dispatch('close-modal', modal: 'delete-category');
        $this->redirectRoute('category.index');
    }

    public function render(): View
    {
        return view('livewire.modal.admin.category.delete');
    }
}
