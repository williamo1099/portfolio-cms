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
            $projects = $this->service->getProjects();
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
     * Update project grid order.
     */
    public function updateProjectsOrder($projects)
    {
        // TODO: Add reordering logic here.
    }
}
