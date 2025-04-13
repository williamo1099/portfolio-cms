<?php

namespace App\Livewire\Forms;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate(['required', 'email'])]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    #[Validate('required')]
    public bool $remember = false;

    /** 
     * Validate the form data and attempt authentication.
     * 
     * @return bool Returns true if authentication is successful, false otherwise.
     */
    public function login(): bool
    {
        try {
            $this->validate();
            $credentials = [
                'email' => $this->email,
                'password' => $this->password,
            ];

            if (Auth::attempt($credentials, $this->remember)) {
                session()->regenerate();
                return true;
            }

            return false;
        } catch (Exception $ex) {
            Log::error($ex);
            return false;
        }
    }
}
