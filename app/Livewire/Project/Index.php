<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Services\ProjectService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public string $typeFilter = '';

    protected ProjectService $service;

    public function boot(ProjectService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        // Get projects filtered by type and ordered by newest first.
        $projects = $this->service->getProjects($this->typeFilter, 10);

        // Count the number of projects by type.
        $projectCounts = $this->service->getProjectCount();
        $professionalCount = $projectCounts['professional'] ?? 0;
        $personalCount = $projectCounts['personal'] ?? 0;

        return view('livewire.project.index', compact('projects', 'professionalCount', 'personalCount'));
    }

    /**
     * Updates the current type filter.
     * If the selected type is already active, resets the filter.
     * 
     * @param string $type
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
     * @param string $type
     */
    public function isActive($type): bool
    {
        return $this->typeFilter === $type;
    }

    /** 
     * Toggle the project active status.
     * 
     * @param int $projectId
     */
    public function toggleProjectStatus($projectId): bool
    {
        $project = Project::findOrFail($projectId);
        $project->is_active = !$project->is_active;
        return $project->save();
    }

    /**
     * Delete the project.
     * 
     * @param int $projectId
     */
    public function deleteProject($projectId): bool
    {
        $project = Project::findOrFail($projectId);
        return $project->delete();
    }
}
