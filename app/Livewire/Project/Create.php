<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public ProjectForm $form;

    public function render()
    {
        return view('livewire.project.create');
    }

    public function save()
    {
        $this->form->store();

        return $this->redirect(route('projects.index'));
    }
}
