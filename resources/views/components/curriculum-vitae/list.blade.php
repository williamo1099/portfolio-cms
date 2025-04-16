@props(['curriculumVitaes'])

<div class="flex flex-row gap-3 overflow-x-auto">
    @foreach ($curriculumVitaes as $curriculumVitae)
        <x-summary-card :title="$curriculumVitae->path" :text="$curriculumVitae->updated_at->diffForHumans()" />
    @endforeach
</div>
