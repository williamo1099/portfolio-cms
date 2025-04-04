<div class="d-flex flex-column gap-2">
    {{--  --}}
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Projects</h3>

        <a wire:navigate href="{{ route('projects.create') }}" role="button" class="btn btn-primary">+ Create New
            Project</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>Stacks</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ ucfirst($project->type) }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ implode(', ', json_decode($project->stacks, true)) }}</td>
                    <td>{{ $project->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
