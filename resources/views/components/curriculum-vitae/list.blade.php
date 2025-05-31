@props(['curriculumVitaes'])

<x-list>
    @forelse ($curriculumVitaes as $curriculumVitae)
        <li class="flex flex-row justify-between p-3 bg-white/80 backdrop-blur backdrop-saturate-150 rounded">
            {{-- Actions --}}
            <div class="flex flex-row justify-center items-center gap-1 w-2/10">
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

            {{-- Information --}}
            <div class="flex flex-row items-center justify-center gap-1 w-8/10">
                <span class="truncate text-ellipsis">{{ $curriculumVitae->path }}</span>

                <a href="{{ asset($curriculumVitae->path) }}" target="_blank" rel="noopener noreferrer" title="Preview">
                    <i class="bi bi-file-earmark-pdf-fill text-red-500 text-xl hover:text-red-600"></i>
                </a>
            </div>

            {{-- Status --}}
            <div class="flex justify-center items-center w-1/10">
                <span
                    class="inline-block rounded-full {{ $curriculumVitae->is_active ? 'bg-green-500' : 'bg-red-500' }}"
                    title="{{ $curriculumVitae->is_active ? 'Active' : 'Inactive' }}"
                    style="width: 12px; height: 12px;">
                </span>
            </div>
        </li>
    @empty
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100">
            <td colspan="4" class="text-center py-4">No CVs found.</td>
        </tr>
    @endforelse
</x-list>
