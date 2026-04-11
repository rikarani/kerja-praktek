<?php

namespace App\Livewire\Modal\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class Create extends Component
{
    public string $name = '';

    public string $username = '';

    public string $email = '';

    public string $role_id = '';

    public ?string $password = null;

    #[On('create-user')]
    public function prepare(): void
    {
        $this->dispatch('open-modal', modal: 'create-user');
    }

    public function submit(): void
    {
        $this->authorize('create', User::class);

        $data = $this->validate();

        User::create([
            ...$data,
            'password' => Hash::make($data['password'] ?? Config::get('app.default_password')),
        ]);

        Toaster::success('Pengguna berhasil ditambahkan');
        $this->dispatch('close-modal');
        $this->redirectRoute('user.index');
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')],
            'email' => ['required', 'email:dns', Rule::unique('users', 'email')],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function render(): View
    {
        return view('livewire.modal.user.create')->with([
            'roles' => Role::all(),
        ]);
    }
}
