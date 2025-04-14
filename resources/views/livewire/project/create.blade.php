<div class="flex flex-col gap-4">
    <h3 class="text-2xl font-bold">
        @if ($form->id)
            Update Project
        @else
            Create a New Project
        @endif
    </h3>

    <form wire:submit.prevent="save" class="space-y-4">
        {{-- Hidden ID Field for Update --}}
        @isset($project)
            <input wire:model="form.id" type="hidden">
        @endisset

        {{-- Type --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">Type</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center gap-2">
                    <input wire:model="form.type" type="radio" value="professional" id="type-professional"
                        class="form-radio text-blue-600">
                    <span>Professional</span>
                </label>

                <label class="inline-flex items-center gap-2">
                    <input wire:model="form.type" type="radio" value="personal" id="type-personal"
                        class="form-radio text-blue-600">
                    <span>Personal</span>
                </label>
            </div>
            @error('form.type')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Title --}}
        <div>
            <label for="input-title" class="block font-medium mb-1 text-gray-700">Title</label>
            <input wire:model="form.title" type="text" id="input-title"
                class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                placeholder="Enter title">
            @error('form.title')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Stacks --}}
        <div>
            <label for="input-stacks" class="block font-medium mb-1 text-gray-700">Stacks</label>
            <input wire:model="form.stacks" type="text" id="input-stacks"
                class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                placeholder="Enter stacks">
            <p class="text-sm text-gray-500 mt-1">Separate stacks with commas (e.g. 'laravel, vue, tailwind')</p>
        </div>

        {{-- Description --}}
        <div>
            <label for="input-description" class="block font-medium mb-1 text-gray-700">Description</label>
            <textarea wire:model="form.description" id="input-description" rows="3"
                class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                placeholder="Enter description"></textarea>
        </div>

        {{-- Image --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">Project Image</label>
            <input type="file" wire:model="form.image" class="block w-full text-sm text-gray-500">
            @error('form.image')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            {{-- Image Preview --}}
            @if ($form->image && is_object($form->image))
                <div class="mt-2">
                    <img src="{{ $form->image->temporaryUrl() }}" class="rounded border shadow w-36">
                </div>
            @elseif ($form->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $form->image) }}" class="rounded border shadow w-36">
                </div>
            @endif
        </div>

        {{-- Submit Button --}}
        <button type="submit"
            class="px-4 py-2 bg-accent text-white font-semibold rounded cursor-pointer hover:bg-accent/80 transition">
            @if ($form->id)
                Update Project
            @else
                Create New Project
            @endif
        </button>
    </form>
</div>
