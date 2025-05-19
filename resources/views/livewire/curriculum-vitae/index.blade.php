<div class="flex flex-col gap-4 h-full">
    <div class="flex flex-col lg:flex-row gap-3 items-start lg:items-center justify-between">
        <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

        <div class="flex flex-row gap-3">
            <label for="files"
                class="flex items-center gap-2 px-4 py-2 bg-accent/80 text-white font-semibold rounded cursor-pointer hover:bg-accent transition">
                <i class="bi bi-cloud-arrow-up"></i> Upload New CV
            </label>
            <input wire:model="form.document" type="file" id="files" class="hidden">
        </div>
    </div>

    {{-- Flash alert --}}
    @foreach (['success', 'error'] as $type)
        @if (session($type))
            <x-flash-alert :type="$type">{{ session($type) }}</x-flash-alert>
        @endif
    @endforeach

    {{-- Table --}}
    <div class="flex flex-row gap-5 h-[calc(70vh)]">
        @if ($activeCurriculumVitaePath && $activeCurriculumVitaePath !== '')
            <embed src="{{ asset('storage/' . $activeCurriculumVitaePath) }}"
                class="rounded border shadow w-1/3 hidden lg:block" />
        @else
            <x-card class="items-center justify-center w-1/3 hidden lg:flex">
                <span>No CV uploaded yet.</span>
            </x-card>
        @endif

        <div class="grow">
            <x-curriculum-vitae.table :curriculumVitaes="$curriculumVitaes" />
        </div>
    </div>
</div>
