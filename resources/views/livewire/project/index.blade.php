<div class="d-flex flex-column gap-2">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Projects</h3>

        <a wire:navigate href="{{ route('projects.create') }}" role="button" class="btn btn-primary text-white"><i
                class="bi bi-plus"></i> Create
            New
            Project</a>
    </div>

    {{-- Summary --}}
    <div class="d-flex justify-content-start gap-3">
        {{-- Professional --}}
        <x-summary-card title="Professional Projects" :text="$professionalCount" click="setTypeFilter('professional')"
            :active="$this->isActive('professional')" />

        {{-- Personal Project --}}
        <x-summary-card title="Personal Projects" :text="$personalCount" click="setTypeFilter('personal')"
            :active="$this->isActive('personal')" />
    </div>

    {{-- Table --}}
    <x-project.table :projects="$projects" />
</div>
