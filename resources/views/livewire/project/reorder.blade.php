<div class="flex flex-col gap-3">
    <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

    {{-- Summary --}}
    <div class="flex flex-row justify-start gap-3 mb-5">
        {{-- Professional --}}
        <x-summary-card title="Professional Projects" text="" click="setTypeFilter('professional')"
            :active="$this->isActive('professional')" />

        {{-- Personal Project --}}
        <x-summary-card title="Personal Projects" text="" click="setTypeFilter('personal')" :active="$this->isActive('personal')" />
    </div>

    {{-- Flash alert --}}
    @foreach (['success', 'error'] as $type)
        @if (session($type))
            <x-flash-alert :type="$type">{{ session($type) }}</x-flash-alert>
        @endif
    @endforeach

    <div class="grid grid-cols-4 gap-4" wire:sortable="updateProjectsOrder">
        @foreach ($projects as $project)
            <civ class="cursor-move" wire:sortable.item="{{ $project->id }}" wire:key="project-{{ $project->id }}">
                <x-project.reorder-card :project="$project"></x-project.reorder-card>
            </civ>
        @endforeach
    </div>
</div>
