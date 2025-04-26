<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Projects')]

class Create extends Component
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
        $this->title = 'Create a Project';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Projects', 'url' => route('projects.index')],
            ['label' => 'Create Project'],
        ];
    }

    /**
     * Render the project create view.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.project.create');
    }

    /**
     * Handle the create submit button click event.
     * 
     * @return void
     */
    public function save(): void
    {
        try {
            $success = $this->form->store();
            if (!$success)
                throw new Exception("Failed to update project!");

            session()->flash('success', 'Project created successfully!');
            redirect()->route('projects.index');
        } catch (Exception $ex) {
            session()->flash('error', 'Failed to create project!');
            $this->logException('creating project', $ex);
        }
    }
}
