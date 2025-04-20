<?php

namespace App\Livewire\Forms;

use App\Models\CurriculumVitae;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CurriculumVitaeForm extends Form
{
    use HasLogging;

    #[Validate('file|mimes:pdf')]
    public $document;

    /**
     * Set current CV (for showing current active CV preview).
     * 
     * @param CurriculumVitae $curriculumVitae
     * @return void
     */
    public function setCurriculumVitae(?CurriculumVitae $curriculumVitae): void
    {
        $this->document = $curriculumVitae->path ?? null;
    }

    /**
     * Store a new CV.
     * Delegates the operation to the project service.
     * 
     * @return bool
     */
    public function store(): bool
    {
        try {
            $validated = $this->validate();
            $fileName = $this->getFileName($this->document->getClientOriginalName());
            $validated['path'] = $this->document->storeAs('curriculum-vitaes', $fileName, 'public');
            $curriculumVitae = app(\App\Services\CurriculumVitaeService::class)->createCurriculumVitae($validated);
            return $curriculumVitae instanceof CurriculumVitae;
        } catch (Exception $ex) {
            $this->logException('creating curriculum vitae', $ex);
            return false;
        }
    }

    /**
     * Get file name for the uploaded file to avoid conflicts.
     * 
     * @param string $currentFileName
     * @return string
     */
    private function getFileName(string $currentFileName): string
    {
        $path = 'curriculum-vitaes';
        $name = pathinfo($currentFileName, PATHINFO_FILENAME);
        $extension = pathinfo($currentFileName, PATHINFO_EXTENSION);
        $fileName = "{$name}.{$extension}";
        $counter = 1;

        // Check if file exists, and append (1), (2), etc. if needed
        while (Storage::disk('public')->exists("{$path}/{$fileName}")) {
            $fileName = "{$name}({$counter}).{$extension}";
            $counter++;
        }

        return $fileName;
    }
}
