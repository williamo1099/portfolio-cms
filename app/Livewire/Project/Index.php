<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Services\ProjectService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Projects')]

class Index extends Component
{
    public string $title;
    public array $breadcrumbs;
    public string $typeFilter = '';

    protected ProjectService $service;

    /**
     * Boot the component and inject properties.
     * 
     * @param ProjectService $service
     * @return void
     */
    public function boot(ProjectService $service): void
    {
        // Initialize the service.
        $this->service = $service;

        // Initialize page title and breadcrumbs.
        $this->title = 'Projects';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Projects'],
        ];
    }

    /**
     * Render the project index view which includes the list of projects and their count.
     * 
     * @return View
     */
    public function render(): View
    {
        try {
            // Get projects filtered by type and ordered by newest first.
            $projects = $this->service->getProjects($this->typeFilter, 10);

            // Count the number of projects by type.
            $projectCounts = $this->service->getProjectCount();
            $professionalCount = $projectCounts['professional'] ?? 0;
            $personalCount = $projectCounts['personal'] ?? 0;
        } catch (Exception $ex) {
            Log::error('Error fetching projects', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            // Set fallback data.
            $projects = [];
            $professionalCount = 0;
            $personalCount = 0;
        }

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
        try {
            $project = $this->service->toggleProjectStatus($projectId);
            return $project instanceof Project;
        } catch (Exception $ex) {
            Log::error('Error toggling project status', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
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
        try {
            $project = $this->service->deleteProject($projectId);
            return $project instanceof Project;
        } catch (Exception $ex) {
            Log::error('Error deleting project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }
}
