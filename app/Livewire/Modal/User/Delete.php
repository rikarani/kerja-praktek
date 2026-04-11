<?php

namespace App\Livewire\Modal\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use Illuminate\Contracts\View\View;

class Delete extends Component
{
    public ?User $user = null;

    #[On('delete-user')]
    public function prepare(User $user): void
    {
        $this->user = $user;

        $this->dispatch('open-modal', modal: 'delete-user');
    }

    public function hapus(): void
    {
        $this->authorize('delete', $this->user);

        $this->user->delete();

        Toaster::success('Pengguna berhasil dihapus');
        $this->dispatch('close-modal');
        $this->redirectRoute('user.index');
    }

    public function render(): View
    {
        return view('livewire.modal.user.delete');
    }
}
