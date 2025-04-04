<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public function render()
    {
        $projects = Project::latest()->get();
        return view('livewire.project.index', compact('projects'));
    }
}
