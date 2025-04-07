<div class="d-flex flex-column gap-2">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Projects</h3>

        <a wire:navigate href="{{ route('projects.create') }}" role="button" class="btn btn-primary text-white">+ Create
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>Stacks</th>
                <th>Description</th>
                <th>Actions</th> <!-- New Column for Actions -->
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ ucfirst($project->type) }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ implode(', ', json_decode($project->stacks, true)) }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('projects.update', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
