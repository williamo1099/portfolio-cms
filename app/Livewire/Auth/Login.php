<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    use HasLogging;

    public bool $showPassword = false;

    public LoginForm $form;

    /**
     * Render the login form view using the guest layout.
     * 
     * @return View
     */
    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    /**
     * Attempt to authenticate the user using the provided credentials.
     * On failure, adds an authentication error to the form.
     * On success, redirects the user to their intended destination or the home page if none exists.
     * 
     * @return void
     */
    public function login(): void
    {
        try {
            $isLoggedIn = $this->form->login();

            if (!$isLoggedIn) {
                $this->addError('authentication', 'Incorrect credentials. Please try again.');
                return;
            }

            redirect()->intended('/');
        } catch (Exception $ex) {
            $errorCode = $this->logException('authenticating user', $ex);
            session()->flash('error', "Failed to log in! (Error code : {$errorCode})");
        }
    }

    /**
     * Toggle show password field status.
     * 
     * @return void
     */
    public function togglePassword(): void
    {
        $this->showPassword = !$this->showPassword;
    }
}
