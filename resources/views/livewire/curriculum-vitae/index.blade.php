<div class="flex flex-col gap-3 h-full">
    <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

    <x-card class="flex flex-row justify-start items-center gap-3">
        {{-- Preview --}}
        <div class="flex flex-col gap-3 w-1/3">
            <h2 class="text-xl font-bold">Current Curriculum Vitae</h2>
            <embed src="{{ asset('storage/' . $form->document) }}" class="rounded border shadow" />
        </div>

        {{-- Form Submit --}}
        <form class="flex flex-col gap-3" wire:submit="save">
            <input wire:model="form.document" type="file">

            @error('form.document')
                <span class="error">{{ $message }}</span>
            @enderror

            <button
                class="px-4 py-2 bg-green-500 text-white font-semibold rounded cursor-pointer hover:bg-green-600 transition"
                type="submit">Save document</button>
        </form>
    </x-card>

    {{-- List --}}
    <x-curriculum-vitae.list :curriculumVitaes="$curriculumVitaes" />
</div>
