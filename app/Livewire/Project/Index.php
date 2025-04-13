<?php

namespace App\Livewire\Project;

use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public string $typeFilter = '';

    protected ProjectService $service;

    /**
     * Boot the component and inject project service.
     * 
     * @param ProjectService $service
     * @return void
     */
    public function boot(ProjectService $service): void
    {
        // Initialize the service.
        $this->service = $service;
    }

    /**
     * Render the project index view which includes the list of projects and their count.
     * 
     * @return View
     */
    public function render(): View
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
     * Check if the given type is the currently active filter.
     * 
     * @param string $type
     * @return bool
     */
    public function isActive($type): bool
    {
        return $this->typeFilter === $type;
    }

    /**
     * Update the current type filter.
     * If the selected type is already active, reset the filter.
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
     * Toggle the active status of the project by its id.
     * Delegates the operation to the project service.
     * 
     * @param int $projectId
     * @return bool
     */
    public function toggleProjectStatus($projectId): bool
    {
        return $this->service->toggleProjectStatus($projectId);
    }

    /**
     * Delete the project by its id.
     * Delegates the operation to the project service.
     * 
     * @param int $projectId
     * @return bool
     */
    public function deleteProject($projectId): bool
    {
        return $this->service->deleteProject($projectId);
    }
}
