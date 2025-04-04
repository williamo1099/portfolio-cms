<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public ProjectForm $form;

    public function mount(Project $project)
    {
        $this->form->setProject($project);
    }

    public function render()
    {
        return view('livewire.project.create');
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect(route('projects.index'));
    }
}
