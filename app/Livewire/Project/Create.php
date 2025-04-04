<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class Create extends Component
{
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
