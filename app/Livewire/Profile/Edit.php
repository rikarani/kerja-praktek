<?php

namespace App\Livewire\Profile;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public ?User $user = null;

    public string $name = '';

    public string $username = '';

    public string $email = '';

    public string $role_id = '';

    public ?string $password = null;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->fill(Auth::user());
    }

    public function submit(): void
    {
        $data = $this->validate();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $this->user->update($data);
        $this->redirectRoute('profile.edit');
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($this->user)],
            'email' => ['required', 'string', 'email:dns', Rule::unique('users', 'email')->ignore($this->user)],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function render(): View
    {
        return view('livewire.profile.edit')->with([
            'roles' => Role::all(),
        ]);
    }
}
