<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public string $typeFilter = '';

    public function render()
    {
        // Fetch projects filtered by type and ordered by newest first.
        $projects = Project::latest()
            ->ofType($this->typeFilter)
            ->paginate(10);

        // Count the number of projects by type.
        $projectCounts = Project::selectRaw('type, COUNT(*) AS total')
            ->groupBy('type')
            ->pluck('total', 'type');
        $professionalCount = $projectCounts['professional'] ?? 0;
        $personalCount = $projectCounts['personal'] ?? 0;

        return view('livewire.project.index', compact('projects', 'professionalCount', 'personalCount'));
    }

    /**
     * Updates the current type filter.
     * If the selected type is already active, resets the filter.
     * 
     * @param String $type
     * @return void
     */
    public function setTypeFilter($type): void
    {
        if ($type == $this->typeFilter) {
            $this->typeFilter = '';
            return;
        }

        $this->typeFilter = $type;
    }

    /**
     * Checks if the given type is the currently active filter.
     * 
     * @param String $type
     */
    public function isActive($type): bool
    {
        return $this->typeFilter === $type;
    }
}
