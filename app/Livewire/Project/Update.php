<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public ProjectForm $form;

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
        $this->form->update();
        redirect()->route('projects.index');
    }
}
