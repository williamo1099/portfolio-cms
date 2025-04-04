<div class="d-flex flex-column gap-2">
    <h3 class="fw-bold">
        @if ($form->id)
            Update Project
        @else
            Create a New Project
        @endif
    </h3>

    <form wire:submit.prevent="save">
        {{-- Hidden ID Field for Update --}}
        @isset($project)
            <input wire:model="form.id" type="hidden">
        @endisset

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label">Type</label>
            <div>
                <div class="form-check form-check-inline">
                    <input wire:model="form.type" class="form-check-input" type="radio" id="type-professional"
                        value="professional">
                    <label class="form-check-label" for="type-professional">Professional</label>
                </div>
                <div class="form-check form-check-inline">
                    <input wire:model="form.type" class="form-check-input" type="radio" id="type-personal"
                        value="personal">
                    <label class="form-check-label" for="type-personal">Personal</label>
                </div>
            </div>
            @error('form.type')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Title --}}
        <div class="mb-3">
            <label for="input-title" class="form-label">Title</label>
            <input wire:model="form.title" type="text" class="form-control" id="input-title"
                placeholder="Enter title">
            @error('form.title')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Stacks --}}
        <div class="mb-3">
            <label for="input-stacks" class="form-label">Stacks</label>
            <input wire:model="form.stacks" type="text" class="form-control" id="input-stacks"
                placeholder="Enter stacks">
            <small id="stacks-help" class="form-text">To have multiple stacks, separate each stack with a comma.</small>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="input-description" class="form-label">Description</label>
            <textarea wire:model="form.description" class="form-control" id="input-description" rows="3"
                placeholder="Enter description"></textarea>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <input type="file" wire:model="form.image">
            @error('form.image')
                <span class="error text-danger">{{ $message }}</span>
            @enderror

            {{-- Image Preview --}}
            @if ($form->image && is_object($form->image))
                <div class="mt-2">
                    <img src="{{ $form->image->temporaryUrl() }}" class="img-thumbnail" width="150">
                </div>
            @elseif ($form->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $form->image) }}" class="img-thumbnail" width="150">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            @if ($form->id)
                Update Project
            @else
                Create New Project
            @endif
        </button>
    </form>
</div>
