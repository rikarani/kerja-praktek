<?php

namespace App\Livewire\Modal\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class Update extends Component
{
    public ?User $user;

    public string $name = '';

    public string $email = '';

    public string $role_id = '';

    public ?string $password = null;

    #[On('update-user')]
    public function prepare(User $user): void
    {
        $this->user = $user;
        $this->fill($user);

        $this->dispatch('open-modal', modal: 'update-user');
    }

    public function submit(): void
    {
        $this->authorize('update', $this->user);

        $data = $this->validate();
        $this->user->update([
            ...$data,
            'password' => Hash::make($data['password'] ?? Config::get('app.default_password')),
        ]);

        $this->dispatch('close-modal');
        $this->redirectRoute('user.index');
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($this?->user)],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8',
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.admin.user.update')->with([
            'roles' => Role::all(),
        ]);
    }
}
