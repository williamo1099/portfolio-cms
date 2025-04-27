<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads, HasLogging;

    public string $title;
    public array $breadcrumbs;

    public ProjectForm $form;

    /**
     * Boot the component and inject properties.
     * 
     * @return void
     */
    public function boot(): void
    {
        // Initialize page title and breadcrumbs.
        $this->title = 'Update a Project';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Projects', 'url' => route('projects.index')],
            ['label' => 'Update Project'],
        ];
    }

    /**
     * Initialize the form with the given project data.
     * 
     * @param Project $project
     */
    public function mount(Project $project)
    {
        $this->form->setProject($project);
    }

    /**
     * Render the project create view.
     * This reuses the same view as the create form.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.project.create');
    }

    /**
     * Handle the update submit button click event.
     * 
     * @return void
     */
    public function save(): void
    {
        try {
            $success = $this->form->update();
            if (!$success)
                throw new Exception("Failed to update project!");

            session()->flash('success', 'Project updated successfully!');
            redirect()->route('projects.index');
        } catch (Exception $ex) {
            $errorCode = $this->logException('creating project', $ex);
            session()->flash('error', "Failed to update project! (Error code : {$errorCode})");
        }
    }
}
