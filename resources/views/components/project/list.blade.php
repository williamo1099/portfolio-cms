@props(['projects'])

<x-list>
    @forelse ($projects as $project)
        <li class="flex flex-row justify-between p-3 bg-white/80 backdrop-blur backdrop-saturate-150 rounded">
            {{-- Actions --}}
            <div class="flex flex-row justify-center items-center gap-1 w-3/10">
                {{-- Edit --}}
                <a href="{{ route('projects.update', $project) }}"
                    class="justify-center p-2 text-white bg-yellow-500 rounded transition hover:bg-yellow-600"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>

                {{-- Activate / Deactivate --}}
                <button
                    class="justify-center p-2 text-white rounded transition cursor-pointer {{ $project->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}"
                    title="{{ $project->is_active ? 'Deactivate' : 'Activate' }}"
                    wire:click="toggleProjectStatus({{ $project->id }})">
                    <i class="bi bi-toggle-{{ $project->is_active ? 'off' : 'on' }}"></i>
                </button>

                {{-- Delete --}}
                <button
                    class="justify-center p-2 text-white bg-red-500 rounded cursor-pointer transition hover:bg-red-600"
                    title="Delete" wire:click="deleteProject({{ $project->id }})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

            {{-- Information --}}
            <div class="flex flex-col items-center justify-center gap-1 w-7/10">
                <span>{{ $project->title }}</span>

                <span
                    class="inline-block px-2 py-0.5 rounded text-xs {{ $project->type === 'personal' ? 'bg-gray-200 text-gray-800' : 'bg-gray-800 text-white' }}">
                    {{ ucwords($project->type) }}
                </span>
            </div>

            {{-- Status --}}
            <div class="flex justify-center items-center w-1/10">
                <span class="inline-block rounded-full {{ $project->is_active ? 'bg-green-500' : 'bg-red-500' }}"
                    title="{{ $project->is_active ? 'Active' : 'Inactive' }}" style="width: 12px; height: 12px;">
                </span>
            </div>
        </li>
    @empty
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100">
            <td colspan="4" class="text-center py-4">No projects found.</td>
        </tr>
    @endforelse
</x-list>
