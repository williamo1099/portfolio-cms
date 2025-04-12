<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(): void
    {
        $loggedIn = $this->form->login();

        if (!$loggedIn) {
            $this->addError('authentication', 'The provided credentials do not match our records.');
            return;
        }

        // Redirect to home page.
        redirect()->intended('home.index');
    }
}
