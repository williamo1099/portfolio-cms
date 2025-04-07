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
        // Get all projects.
        $projects = Project::latest()->get();

        // Get project counts.
        $projectCounts = Project::selectRaw('type, COUNT(*) AS total')
            ->groupBy('type')
            ->pluck('total', 'type');
        $professionalCount = $projectCounts['professional'] ?? 0;
        $personalCount = $projectCounts['personal'] ?? 0;

        return view('livewire.project.index', compact('projects', 'professionalCount', 'personalCount'));
    }
}
