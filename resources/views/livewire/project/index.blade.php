<div class="flex flex-col gap-4">
    <div class="flex flex-col lg:flex-row gap-3 items-start lg:items-center justify-between">
        <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

        <div class="flex flex-row gap-3">
            {{-- Reorder projects --}}
            <a wire:navigate href="{{ route('projects.reorder') }}" role="button"
                class="flex items-center gap-2 px-4 py-2 rounded text-white bg-yellow-500/80 backdrop-blur cursor-pointer hover:bg-yellow-500 transition h-fit"><i
                    class="bi bi-arrow-left-right"></i> Reorder Project</a>

            {{-- Create new project --}}
            <a wire:navigate href="{{ route('projects.create') }}" role="button"
                class="flex items-center gap-2 px-4 py-2 rounded text-white bg-accent/80 backdrop-blur cursor-pointer hover:bg-accent transition h-fit"><i
                    class="bi bi-plus"></i> Create New Project</a>
        </div>
    </div>

    {{-- Summary --}}
    <div class="hidden lg:flex flex-row justify-start gap-3">
        {{-- Professional --}}
        <x-summary-card title="Professional Projects" :text="$professionalCount" click="setTypeFilter('professional')"
            :active="$this->isActive('professional')" />

        {{-- Personal Project --}}
        <x-summary-card title="Personal Projects" :text="$personalCount" click="setTypeFilter('personal')"
            :active="$this->isActive('personal')" />
    </div>

    {{-- Flash alert --}}
    @foreach (['success', 'error'] as $type)
        @if (session($type))
            <x-flash-alert :type="$type">{{ session($type) }}</x-flash-alert>
        @endif
    @endforeach

    {{-- Table --}}
    <x-project.table :projects="$projects" />
</div>
