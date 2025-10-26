<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    #[Validate(rule: 'required', message: 'wajib diisi')]
    #[Validate(rule: 'email:dns', message: 'email tidak valid')]
    public string $email = '';

    #[Validate(rule: 'required', message: 'wajib diisi')]
    public string $password = '';

    public function login(): void
    {
        $data = $this->validate();

        if (! Auth::attempt($data)) {
            $this->reset('password');
            Session::flash('error', 'Email atau Password salah');

            return;
        }

        Session::regenerate();
        $this->redirectRoute('dashboard');
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
