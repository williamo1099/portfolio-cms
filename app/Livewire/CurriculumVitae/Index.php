<?php

namespace App\Livewire\CurriculumVitae;

use App\Livewire\Forms\CurriculumVitaeForm;
use App\Models\CurriculumVitae;
use App\Services\CurriculumVitaeService;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
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
            $errorCode = $this->logException('fetching CVs', $ex);
            session()->flash('error', "Failed to fetch curriculum vitaes! (Error code : {$errorCode})");

            // Set fallback data.
            $curriculumVitaes = new LengthAwarePaginator(collect(), 0, 5, 1, ['path' => request()->url()]);
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
        try {
            $success = $this->form->store();
            if (!$success) throw new Exception('Failed to upload curriculum vitae!');

            $this->setActiveCurriculumVitaePath();
            session()->flash('success', 'Curriculum vitae uploaded successfully!');
        } catch (Exception $ex) {
            $errorCode = $this->logException('creating curriculum vitae', $ex);
            session()->flash('error', "Failed to upload curriculum vitae! (Error code : {$errorCode})");
        }
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
            session()->flash('success', 'Curriculum vitae activated successfully!');
            return $curriculumVitae instanceof CurriculumVitae;
        } catch (Exception $ex) {
            $errorCode = $this->logException('activating curriculum vitae', $ex);
            session()->flash('error', "Failed to activate curriculum vitae! (Error code : {$errorCode})");
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
            session()->flash('success', 'Curriculum vitae deleted successfully!');
            return $curriculumVitae instanceof CurriculumVitae;
        } catch (Exception $ex) {
            $errorCode = $this->logException('deleting curriculum vitae', $ex);
            session()->flash('error', "Failed to delete curriculum vitae! (Error code : {$errorCode})");
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
            $errorCode = $this->logException('fetching active curriculum vitae', $ex);
            session()->flash('error', "Failed to activate curriculum vitae! (Error code : {$errorCode})");

            // Set fallback data.
            $path = '';
        }

        $this->activeCurriculumVitaePath = $path;
    }
}
