<div class="flex flex-col gap-3">
    <div class="flex flex-row items-center justify-between">
        <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

        <a wire:navigate href="{{ route('projects.create') }}" role="button"
            class="flex items-center gap-2 px-4 py-2 rounded text-white bg-accent/80 backdrop-blur cursor-pointer hover:bg-accent transition h-fit"><i
                class="bi bi-plus"></i> Create New Project</a>
    </div>

    {{-- Summary --}}
    <div class="flex flex-row justify-start gap-3 mb-5">
        {{-- Professional --}}
        <x-summary-card title="Professional Projects" :text="$professionalCount" click="setTypeFilter('professional')"
            :active="$this->isActive('professional')" />

        {{-- Personal Project --}}
        <x-summary-card title="Personal Projects" :text="$personalCount" click="setTypeFilter('personal')"
            :active="$this->isActive('personal')" />
    </div>

    @session('success')
        <x-flash-alert type="success" />
    @endsession

    {{-- Table --}}
    <x-project.table :projects="$projects" />
</div>
