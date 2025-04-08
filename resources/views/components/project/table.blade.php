@props(['projects'])

<table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th class="text-center" style="width: 10%">Actions</th>
            <th style="width: 2%"></th>
            <th style="width: 30%">Title</th>
            <th style="width: 25%">Stacks</th>
            <th>Description</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($projects as $project)
            <tr class="{{ !$project->is_active ? 'table-danger' : '' }}">
                {{-- Actions --}}
                <td class="text-center">
                    {{-- Edit --}}
                    <a href="{{ route('projects.update', $project) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>

                    {{-- Activate / Deactivate --}}
                    <button class="btn btn-sm text-white {{ $project->is_active ? 'btn-danger' : 'bg-success' }}"
                        title="{{ $project->is_active ? 'Deactivate' : 'Activate' }}"
                        wire:click="toggleProjectStatus({{ $project->id }})">
                        <i class="bi bi-toggle-{{ $project->is_active ? 'off' : 'on' }}"></i>
                    </button>

                    {{-- Delete --}}
                    <button class="btn btn-sm btn-danger" title="Delete"
                        wire:click="deleteProject({{ $project->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>

                {{-- Status --}}
                <td class="text-center">
                    <span class="d-inline-block rounded-circle {{ $project->is_active ? 'bg-success' : 'bg-danger' }}"
                        style="width: 12px; height: 12px;"
                        title="{{ $project->is_active ? 'Active' : 'Inactive' }}"></span>
                </td>

                {{-- Title --}}
                <td class="gap-3">
                    {{ $project->title }}

                    {{-- Type badge --}}
                    <span class="badge {{ $project->type === 'personal' ? 'text-bg-light' : 'text-bg-dark' }}">
                        {{ ucwords($project->type) }}
                    </span>
                </td>

                {{-- Stacks --}}
                <td>
                    @foreach ($project->stacksArray as $stack)
                        <span class="badge text-bg-primary">{{ $stack }}</span>
                    @endforeach
                </td>

                {{-- Description --}}
                <td>{{ $project->description }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No projects found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $projects->links('pagination::bootstrap-5') }}
