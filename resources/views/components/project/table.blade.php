@props(['projects'])

<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th class="text-center" style="width: 10%">Actions</th>
            <th style="width: 2%"></th>
            <th style="width: 25%">Title</th>
            <th style="width: 35%">Stacks</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr>
                {{-- Actions --}}
                <td class="text-center">
                    {{-- Edit --}}
                    <a href="{{ route('projects.update', $project) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>

                    {{-- Activate / Deactivate --}}
                    <a href="{{ route('projects.update', $project) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-toggle-on"></i>
                    </a>

                    {{-- Delete --}}
                    <a href="#" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>

                {{-- Status --}}
                <td class="text-center">
                    <span class="d-inline-block rounded-circle {{ true ? 'bg-success' : 'bg-danger' }}"
                        style="width: 10px; height: 10px;"></span>
                </td>

                {{-- Title --}}
                <td class="gap-3">
                    {{ $project->title }}

                    {{-- Type badge --}}
                    @if ($project->type === 'personal')
                        <span class="badge text-bg-primary">Personal</span>
                    @else
                        <span class="badge text-bg-primary">Professional</span>
                    @endif
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
