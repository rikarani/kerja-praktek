<?php

namespace App\Livewire\Modal\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;

class Create extends Component
{
    #[Validate(rule: 'required', message: 'Wajib Diisi')]
    public string $name = '';

    #[On('create-category')]
    public function prepare(): void
    {
        $this->dispatch('open-modal', modal: 'create-category');
    }

    public function submit(): void
    {
        $data = $this->validate();

        try {
            Category::create($data);

            $this->dispatch('close-modal');
            $this->redirectRoute('category.index');
        } catch (\Exception $exception) {
            return;
        }
    }

    public function render(): View
    {
        return view('livewire.modal.admin.category.create');
    }
}
