<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ProjectForm extends Form
{
    use WithFileUploads;

    #[Validate(['required', 'in:personal,professional'])]
    public string $type = '';

    #[Validate(['required', 'min:3'])]
    public string $title = '';

    public string $stacks = '';

    public string $description = '';

    #[Validate('nullable', 'image', 'max:1024')]
    public $image;

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
