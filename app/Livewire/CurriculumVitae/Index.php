<?php

namespace App\Livewire\CurriculumVitae;

use App\Livewire\Forms\CurriculumVitaeForm;
use App\Models\CurriculumVitae;
use App\Services\CurriculumVitaeService;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    protected CurriculumVitaeService $service;

    public CurriculumVitaeForm $form;

    public function boot(CurriculumVitaeService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $curriculumVitae = CurriculumVitae::where("is_active", 1)->first();
        $this->form->setCurriculumVitae($curriculumVitae);
    }

    public function render()
    {
        try {
            $curriculumVitaes = $this->service->getCurriculumVitaes();
        } catch (Exception $ex) {
            Log::error('Error fetching CVs', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            // Set fallback data.
            $curriculumVitaes = [];
        }

        return view('livewire.curriculum-vitae.index', compact('curriculumVitaes'));
    }

    /**
     * 
     */
    public function save(): void
    {
        $this->form->store();
    }
}
