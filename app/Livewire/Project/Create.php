<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Projects')]

class Create extends Component
{
    use WithFileUploads;

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
        $this->form->store();
        redirect()->route('projects.index');
    }
}
