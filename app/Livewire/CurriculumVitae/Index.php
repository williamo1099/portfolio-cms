<?php

namespace App\Livewire\CurriculumVitae;

use App\Livewire\Forms\CurriculumVitaeForm;
use App\Models\CurriculumVitae;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public CurriculumVitaeForm $form;

    public function mount()
    {
        $curriculumVitae = CurriculumVitae::where("is_active", 1)->first();
        $this->form->setCurriculumVitae($curriculumVitae);
    }

    public function render()
    {
        return view('livewire.curriculum-vitae.index');
    }

    /**
     * 
     */
    public function save(): void
    {
        $this->form->store();
    }
}
