<?php

namespace App\Livewire\Project;

use App\Services\ProjectService;
use App\Traits\HasLogging;
use Exception;
use Illuminate\View\View;
use Livewire\Component;

class Reorder extends Component
{
    use HasLogging;

    public string $title;
    public array $breadcrumbs;
    public string $typeFilter = 'professional';

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
        $this->title = 'Reorder Projects';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Projects', 'url' => route('projects.index')],
            ['label' => 'Reorder Projects'],
        ];
    }

    /**
     * Render the project index view which includes the list of projects.
     * 
     * @return View
     */
    public function render(): View
    {
        try {
            //
            $projects = $this->service->getProjectsInOrder($this->typeFilter);
        } catch (Exception $ex) {
            // Log exception.
            $errorCode = $this->logException('fetching projects', $ex);
            session()->flash('error', "Failed to fetch projects! (Error code : {$errorCode})");

            // Set fallback data.
            $projects = collect();
        }

        return view('livewire.project.reorder', compact('projects'));
    }

    /**
     * Check if the given type is the currently active filter.
     * 
     * @param string $type
     * @return bool
     */
    public function isActive(string $type): bool
    {
        return $this->typeFilter === $type;
    }

    /**
     * Update the current type filter.
     * 
     * @param string $type
     * @return void
     */
    public function setTypeFilter(string $type): void
    {
        $this->typeFilter = $type;
    }

    /**
     * Update project grid order.
     * 
     * @param array $projects
     */
    public function updateProjectsOrder(array $projects): bool
    {
        try {
            $projectLength = count($projects);
            foreach ($projects as $project) {
                $projectId = $project['value'];
                $newOrder = $projectLength - $project['order'] + 1;
                $this->service->updateProjectOrder($projectId, $newOrder);
            }

            session()->flash('success', 'Project toggled successfully!');
            return true;
        } catch (Exception $ex) {
            $errorCode = $this->logException('updating project order', $ex);
            session()->flash('error', "Failed to update project order! (Error code : {$errorCode})");
            return false;
        }
    }
}
