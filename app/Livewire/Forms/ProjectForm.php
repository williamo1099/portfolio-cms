<?php

namespace App\Livewire\Forms;

use App\Models\Project;
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

    public ?string $stacks = '';

    public ?string $description = '';

    #[Validate('nullable', 'image', 'max:1024')]
    public $image;

    public function setProject(Project $project)
    {
        $this->id = $project->id;
        $this->type = $project->type;
        $this->title = $project->title;
        $this->stacks = implode(', ', json_decode($project->stacks, true));
        $this->description = $project->description;
        $this->image = $project->image_path;
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['stacks'] = json_encode(array_map('trim', explode(',', $this->stacks)));
        if ($this->image) {
            $validated['image_path'] = $this->image->store('projects', 'public');
        }
        Project::create($validated);
        $this->reset();
    }

    public function update()
    {
        // TODO: Add update logic.
    }
}
