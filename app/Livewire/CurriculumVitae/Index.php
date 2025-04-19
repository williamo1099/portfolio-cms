<?php

namespace App\Livewire\CurriculumVitae;

use App\Livewire\Forms\CurriculumVitaeForm;
use App\Models\CurriculumVitae;
use App\Services\CurriculumVitaeService;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Curriculum Vitaes')]

class Index extends Component
{
    use WithFileUploads, HasLogging;

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
            // Log exception.
            $this->logException('fetching CVs', $ex);

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
            $this->logException('activating curriculum vitae', $ex);
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
            $this->logException('deleting curriculum vitae', $ex);
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
            // Log exception.
            $this->logException('fetching active curriculum vitae', $ex);

            // Set fallback data.
            $path = '';
        }

        $this->activeCurriculumVitaePath = $path;
    }
}
