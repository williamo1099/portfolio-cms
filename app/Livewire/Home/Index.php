<?php

namespace App\Livewire\Home;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
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
