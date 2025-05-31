@props(['mails'])

<x-list>
    @forelse ($mails as $mail)
        <li class="flex flex-row justify-between p-3 bg-white/80 backdrop-blur backdrop-saturate-150 rounded">
            {{-- Actions --}}
            <div class="flex flex-row justify-center items-center gap-1 w-2/10">
                {{-- Activate --}}
                @if (!$mail->is_active)
                    <button class="justify-center p-2 text-white bg-green-500 rounded transition cursor-pointer"
                        wire:click="activatemail({{ $mail->id }})">
                        <i class="bi bi-check-lg"></i>
                    </button>
                @endif

                {{-- Delete --}}
                <button wire:click="deletemail({{ $mail->id }})"
                    class="justify-center p-2 text-white bg-red-500 rounded cursor-pointer transition hover:bg-red-600 disabled:bg-red-500/50 disabled:cursor-not-allowed"
                    title="Delete" @if ($mail->is_active) disabled @endif>
                    <i class="bi bi-trash"></i>
                </button>
            </div>

            {{-- Information --}}
            <div class="flex flex-col items-start justify-center gap-1 w-8/10">
                <span class="truncate text-ellipsis">{{ $mail->name }} ({{ $mail->email }})</span>
                <span class="truncate text-ellipsis">{{ $mail->message }}</span>
            </div>
        </li>
    @empty
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100">
            <td colspan="4" class="text-center py-4">No mails found.</td>
        </tr>
    @endforelse
</x-list>
