@props(['projects'])

@php
    $headers = [
        ['name' => 'Actions', 'class' => 'text-center w-[10%]'],
        ['name' => '', 'class' => 'w-[2%]'], // status indicator
        ['name' => 'Title', 'class' => 'w-[25%]'],
        ['name' => 'Stacks', 'class' => 'w-[20%]'],
        ['name' => 'Description', 'class' => 'w-[30%]'],
        ['name' => 'Last Updated', 'class' => ''],
    ];
@endphp

<x-table :headers="$headers">
    @forelse ($projects as $project)
        <tr
            class="backdrop-blur transition {{ !$project->is_active ? 'bg-red-100/80 text-red-800 hover:bg-red-100' : 'bg-white/80 hover:bg-gray-100' }}">
            {{-- Actions --}}
            <td class="py-2 px-3">
                <div class="flex flex-row justify-center items-center gap-2">
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
            </td>

            {{-- Status Indicator --}}
            <td class="py-2 px-3 text-center">
                <span class="inline-block rounded-full {{ $project->is_active ? 'bg-green-500' : 'bg-red-500' }}"
                    title="{{ $project->is_active ? 'Active' : 'Inactive' }}" style="width: 12px; height: 12px;">
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
</x-table>

<div class="mt-4">
    {{ $projects->links('vendor.pagination.simple-tailwind') }}
</div>
