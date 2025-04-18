<?php

namespace App\Livewire\CurriculumVitae;

use App\Livewire\Forms\CurriculumVitaeForm;
use App\Models\CurriculumVitae;
use App\Services\CurriculumVitaeService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Curriculum Vitaes')]

class Index extends Component
{
    use WithFileUploads;

    public string $title;
    public array $breadcrumbs;

    protected CurriculumVitaeService $service;

    public CurriculumVitaeForm $form;

    /**
     * Boot the component and inject properties.
     * 
     * @param CurriculumVitaeService $service
     * @return void
     */
    public function boot(CurriculumVitaeService $service): void
    {
        // Initialize the service.
        $this->service = $service;

        // Initialize page title and breadcrumbs.
        $this->title = 'Curriculum Vitaes';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Curriculum Vitaes'],
        ];
    }

    /**
     * Initialize the form with the given project data.
     * 
     * @param Project $project
     * @return void
     */
    public function mount(): void
    {
        $curriculumVitae = CurriculumVitae::where("is_active", 1)->first();
        $this->form->setCurriculumVitae($curriculumVitae);
    }

    /**
     * Render the curriculum vitae index view.
     * This reuses the same view as the create form.
     * 
     * @return View
     */
    public function render(): View
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
     * Handle the save submit button click event.
     * 
     * @return void
     */
    public function save(): void
    {
        $this->form->store();
    }

    /**
     * Set the status of the CV to active by its id.
     * 
     * @param int $curriculumVitaeId
     * @return bool
     */
    public function activateCurriculumVitae(int $curriculumVitaeId): bool
    {
        try {
            $project = $this->service->setCurriculumVitaeStatusToActive($curriculumVitaeId);
            return $project instanceof CurriculumVitae;
        } catch (Exception $ex) {
            Log::error('Error activating curriculum vitae', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Delete the CV by its id.
     * Delegates the operation to the CV service.
     * 
     * @param int $curriculumVitaeId
     * @return bool
     */
    public function deleteCurriculumVitae(int $curriculumVitaeId): bool
    {
        try {
            $curriculumVitae = $this->service->deleteCurriculumVitae($curriculumVitaeId);
            return $curriculumVitae instanceof CurriculumVitae;
        } catch (Exception $ex) {
            Log::error('Error deleting curriculum vitae', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }
}
