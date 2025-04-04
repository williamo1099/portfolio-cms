<?php

namespace App\Livewire\Project;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.project.index');
    }
}
