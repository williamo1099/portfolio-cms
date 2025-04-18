<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ProjectForm extends Form
{
    use WithFileUploads;

    public ?int $id = null;

    #[Validate(['required', 'in:personal,professional'])]
    public string $type = '';

    #[Validate(['required', 'min:3'])]
    public string $title = '';

    #[Validate(['nullable'])]
    public ?string $stacks = '';

    #[Validate(['nullable'])]
    public ?string $description = '';

    #[Validate('nullable', 'image', 'max:1024')]
    public $image;

    /**
     * Set current project (for update form).
     * 
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->id = $project->id;
        $this->type = $project->type;
        $this->title = $project->title;
        $this->stacks = implode(', ', json_decode($project->stacks, true));
        $this->description = $project->description;
        $this->image = $project->image_path;
    }

    /**
     * Store a new project.
     * Delegates the operation to the project service.
     * 
     * @return bool
     */
    public function store(): bool
    {
        try {
            $validated = $this->validate();
            if ($this->image) {
                $validated['image_path'] = $this->image->store('projects', 'public');
            }

            $project = app(\App\Services\ProjectService::class)->createProject($validated);
            $this->reset();

            return $project instanceof Project;
        } catch (Exception $ex) {
            Log::error('Error creating project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Update an existing project.
     * Delegates the operation to the project service.
     * 
     * @return bool
     */
    public function update(): bool
    {
        try {
            $validated = $this->validate();
            if ($this->image instanceof \Illuminate\Http\UploadedFile) {
                $validated['image_path'] = $this->image->store('projects', 'public');
            }

            $project = app(\App\Services\ProjectService::class)->updateProject($this->id, $validated);
            $this->reset();

            return $project instanceof Project;
        } catch (Exception $ex) {
            Log::error('Error updating project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return false;
        }
    }
}
