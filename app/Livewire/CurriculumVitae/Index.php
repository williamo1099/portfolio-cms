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
    public string $activeCurriculumVitaePath;

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
        $this->setActiveCurriculumVitaePath();
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
     * Store the document after it has been uploaded.
     * 
     * @return void
     */
    public function updatedFormDocument(): void
    {
        $this->form->store();
        $this->setActiveCurriculumVitaePath();
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
            $curriculumVitae = $this->service->setCurriculumVitaeStatusToActive($curriculumVitaeId);
            $this->setActiveCurriculumVitaePath($curriculumVitae->path);
            return $curriculumVitae instanceof CurriculumVitae;
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

    /** 
     * Set currently active curriculum vitae path (for CV display).
     * If path is not provided, get the active CV.
     * 
     * @param string|null $path
     * @return void
     */
    private function setActiveCurriculumVitaePath(?string $path = null): void
    {
        try {
            if (!$path) {
                $curriculumVitae = $this->service->getActiveCurriculumVitae();
                $path = $curriculumVitae?->path ?? '';
            }
        } catch (Exception $ex) {
            Log::error('Error fetching active CV', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);

            // Set fallback data.
            $path = '';
        }

        $this->activeCurriculumVitaePath = $path;
    }
}
