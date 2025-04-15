<?php

namespace App\Livewire\Forms;

use App\Models\CurriculumVitae;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CurriculumVitaeForm extends Form
{
    #[Validate('file|mimes:pdf')]
    public $document;

    /**
     * 
     * 
     * @param CurriculumVitae $curriculumVitae
     * @return void
     */
    public function setCurriculumVitae(CurriculumVitae $curriculumVitae): void
    {
        $this->document = $curriculumVitae->path;
    }

    /**
     * 
     */
    public function store(): bool
    {
        try {
            $validated = $this->validate();
            $validated['path'] = $this->document->store('curriculum-vitaes', 'public');
            $curriculumVitae = app(\App\Services\CurriculumVitaeService::class)->createCurriculumVitae($validated);
            return $curriculumVitae instanceof CurriculumVitae;
        } catch (Exception $ex) {
            Log::error('Error creating curriculum vitae', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return false;
        }
    }
}
