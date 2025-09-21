<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public function login()
    {
        $data = $this->validate();

        if (! Auth::attempt($data)) {
            return session()->flash('error', 'Email atau Password salah');
        }

        Session::regenerate();

        return $this->redirectRoute('dashboard');
    }

    protected function rules(): array
    {
        return [
            'email' => 'required|email:dns',
            'password' => 'required|min:6',
        ];
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
