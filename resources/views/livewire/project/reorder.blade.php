<div class="flex flex-col gap-3">
    <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

    <div class="grid grid-cols-4 gap-4" wire:sortable="updateProjectsOrder">
        @foreach ($projects as $project)
            <x-card class="cursor-move" wire:sortable.item="{{ $project->id }}" wire:key="project-{{ $project->id }}">
                {{ $project->title }}
            </x-card>
        @endforeach
    </div>
</div>
