<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Validate('required')]
    public string $name;

    #[Validate('required', 'email')]
    public string $email;

    public string $password = '';
    public string $newPassword = '';
    public string $newPasswordConfirmation = '';

    /**
     * Set current profile with logged-in user.
     * 
     * @return void
     */
    public function setProfile(): void
    {
        $user = Auth::user();

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }
}
