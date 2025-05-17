<?php

namespace App\Livewire\Home;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public string $title;

    public string $portfolioUrl = 'https://williamoktavianus.dev';

    /**
     * Boot the component and inject properties.
     * 
     * @return void
     */
    public function boot(): void
    {
        // Initialize page title.
        $this->title = 'Hello, ' . Auth::user()->name . '!';
    }

    /**
     * Render the home index view.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.home.index');
    }
}
