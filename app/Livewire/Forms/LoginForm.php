<?php

namespace App\Livewire\Forms;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate(['required', 'email'])]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    /** */
    public function login(): RedirectResponse
    {
        $validated = $this->validate();

        if (Auth::attempt($validated)) {
            session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
