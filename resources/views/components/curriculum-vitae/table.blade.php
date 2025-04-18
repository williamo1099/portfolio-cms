@props(['curriculumVitaes'])

@php
    $headers = [
        ['name' => 'Actions', 'class' => 'text-center w-[10%]'],
        ['name' => '', 'class' => 'w-[2%]'],
        ['name' => 'Title', 'class' => 'w-[50%]'],
        ['name' => 'Uploaded', 'class' => ''],
    ];
@endphp

<x-table :headers="$headers">
    @foreach ($curriculumVitaes as $curriculumVitae)
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100">
            {{-- Actions --}}
            <td class="py-2 px-3">
                <div class="flex flex-row justify-center items-center gap-2">
                    {{-- Activate --}}
                    @if (!$curriculumVitae->is_active)
                        <button class="justify-center p-2 text-white bg-green-500 rounded transition cursor-pointer"
                            wire:click="activateCurriculumVitae({{ $curriculumVitae->id }})">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    @endif

                    {{-- Delete --}}
                    <button wire:click="deleteCurriculumVitae({{ $curriculumVitae->id }})"
                        class="justify-center p-2 text-white bg-red-500 rounded cursor-pointer transition hover:bg-red-600 disabled:bg-red-500/50 disabled:cursor-not-allowed"
                        title="Delete" @if ($curriculumVitae->is_active) disabled @endif>
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>

            {{-- Status --}}
            <td class="py-2 px-3 text-center">
                <span
                    class="inline-block rounded-full {{ $curriculumVitae->is_active ? 'bg-green-500' : 'bg-red-500' }}"
                    title="{{ $curriculumVitae->is_active ? 'Active' : 'Inactive' }}"
                    style="width: 12px; height: 12px;">
                </span>
            </td>

            {{-- Title --}}
            <td class="py-2 px-3">
                <div class="flex flex-row items-center justify-between">
                    <span>{{ $curriculumVitae->path }}</span>

                    <a href="{{ asset($curriculumVitae->path) }}" target="_blank" rel="noopener noreferrer"
                        title="Preview">
                        <i class="bi bi-file-earmark-pdf-fill text-red-500 text-xl hover:text-red-600"></i>
                    </a>
                </div>
            </td>

            {{-- Uploaded --}}
            <td class="py-2 px-3">{{ $curriculumVitae->created_at->diffForHumans() }}</td>
        </tr>
    @endforeach
</x-table>
