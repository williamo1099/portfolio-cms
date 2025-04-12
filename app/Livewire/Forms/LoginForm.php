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

    /** 
     * 
     */
    public function login(): bool
    {
        try {
            $validated = $this->validate();

            if (Auth::attempt($validated)) {
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
