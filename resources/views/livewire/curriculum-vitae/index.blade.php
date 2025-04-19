<div class="flex flex-col gap-3 h-full">
    <div class="flex flex-row items-center justify-between">
        <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

        <div class="flex flex-row gap-3">
            <label for="files"
                class="flex items-center gap-2 px-4 py-2 bg-accent/80 text-white font-semibold rounded cursor-pointer hover:bg-accent transition h-fit">
                <i class="bi bi-cloud-arrow-up"></i> Upload New CV
            </label>
            <input wire:model="form.document" type="file" id="files" class="hidden">
        </div>
    </div>

    {{-- Table --}}
    <div class="flex flex-row gap-5 h-[calc(80vh)]">
        @if ($form->document)
            <embed src="{{ asset('storage/' . $form->document) }}" class="rounded border shadow w-1/3" />
        @else
            <div
                class="w-1/3 h-full flex items-center justify-center rounded border-2 border-dashed border-gray-400 text-gray-500 text-center">
                <span>No document uploaded</span>
            </div>
        @endif

        <div class="grow">
            <x-curriculum-vitae.table :curriculumVitaes="$curriculumVitaes" />
        </div>
    </div>
</div>
