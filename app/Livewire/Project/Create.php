<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public ProjectForm $form;

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
