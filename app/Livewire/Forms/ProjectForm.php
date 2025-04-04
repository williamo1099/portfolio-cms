<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    #[Validate(['required', 'in:personal,professional'])]
    public string $type = '';

    #[Validate(['required', 'min:3'])]
    public string $title = '';

    public string $stacks = '';

    public string $description = '';

    public function store()
    {
        $validated = $this->validate();
        $validated['stacks'] = json_encode(array_map('trim', explode(',', $this->stacks)));
        Project::create($validated);
        $this->reset();
    }

    public function update()
    {
        // TODO: Add update logic.
    }
}
