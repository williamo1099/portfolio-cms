<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutButton extends Component
{
    /**
     * Render the logout button.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth.logout-button');
    }

    /**
     * Handle user logout by invalidating the current session.
     * 
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        redirect()->route('login');
    }
}
