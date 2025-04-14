@props(['projects'])

<div class="rounded border border-gray-200 bg-white backdrop-blur backdrop-saturate-150 overflow-hidden">
    <table class="w-full text-sm text-left text-black">
        <thead class="bg-primary/80 text-white uppercase text-xs">
            <tr>
                <th class="text-center py-2 px-3 w-[10%]">Actions</th>
                <th class="w-[2%]"></th>
                <th class="py-2 px-3 w-[25%]">Title</th>
                <th class="py-2 px-3 w-[20%]">Stacks</th>
                <th class="py-2 px-3 w-[30%]">Description</th>
                <th class="py-2 px-3">Last Updated</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($projects as $project)
                <tr class="{{ !$project->is_active ? 'bg-red-100 text-red-800' : 'hover:bg-gray-100' }}">
                    {{-- Actions --}}
                    <td>
                        <div class="flex flex-row justify-center items-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('projects.update', $project) }}"
                                class="items-center justify-center p-1.5 text-yellow-600 hover:text-yellow-800 rounded transition"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- Activate / Deactivate --}}
                            <button
                                class="justify-center p-1.5 text-white rounded transition {{ $project->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}"
                                title="{{ $project->is_active ? 'Deactivate' : 'Activate' }}"
                                wire:click="toggleProjectStatus({{ $project->id }})">
                                <i class="bi bi-toggle-{{ $project->is_active ? 'off' : 'on' }}"></i>
                            </button>

                            {{-- Delete --}}
                            <button
                                class="justify-center p-1.5 text-white bg-red-700 hover:bg-red-800 rounded transition"
                                title="Delete" wire:click="deleteProject({{ $project->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>

                    {{-- Status Indicator --}}
                    <td class="text-center">
                        <span
                            class="inline-block rounded-full {{ $project->is_active ? 'bg-green-500' : 'bg-red-500' }}"
                            title="{{ $project->is_active ? 'Active' : 'Inactive' }}"
                            style="width: 12px; height: 12px;">
                        </span>
                    </td>

                    {{-- Title + Type Badge --}}
                    <td class="py-2 px-3 space-y-1">
                        <div>{{ $project->title }}</div>
                        <span
                            class="inline-block px-2 py-0.5 rounded text-xs {{ $project->type === 'personal' ? 'bg-gray-200 text-gray-800' : 'bg-gray-800 text-white' }}">
                            {{ ucwords($project->type) }}
                        </span>
                    </td>

                    {{-- Stacks --}}
                    <td class="py-2 px-3 space-x-1">
                        @foreach ($project->stacksArray as $stack)
                            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-0.5 rounded">
                                {{ $stack }}
                            </span>
                        @endforeach
                    </td>

                    {{-- Description --}}
                    <td class="py-2 px-3">{{ $project->description }}</td>

                    {{-- Last Updated --}}
                    <td class="py-2 px-3 text-sm">
                        {{ $project->updated_at->diffForHumans() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No projects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $projects->links('pagination::bootstrap-5') }}
</div>
