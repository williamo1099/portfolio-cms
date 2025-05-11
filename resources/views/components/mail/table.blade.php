@props(['mails'])

@php
    $headers = [
        ['name' => 'Actions', 'class' => 'text-center w-[10%]'],
        ['name' => 'Date', 'class' => 'w-[10%]'],
        ['name' => 'Name', 'class' => 'w-[15%]'],
        ['name' => 'E-mail', 'class' => 'w-[15%]'],
        ['name' => 'Message', 'class' => 'w-[30%]'],
        ['name' => 'Last Updated', 'class' => ''],
    ];
@endphp

<x-table :headers="$headers">
    @forelse ($mails as $mail)
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100 }}">
            {{-- Actions --}}
            <td class="py-2 px-3">
                <div class="flex flex-row justify-center items-center gap-2">
                    @if ($mail->status == 'unread')
                        {{-- Notify --}}
                        <button
                            class="justify-center p-2 text-white rounded transition cursor-pointer bg-green-500 hover:bg-green-600"
                            title="Notify" wire:click="notifyMail({{ $mail->id }})">
                            <i class="bi bi-envelope"></i>
                        </button>

                        {{-- Dismiss --}}
                        <button
                            class="justify-center p-2 text-white rounded transition cursor-pointer bg-red-500 hover:bg-red-600"
                            title="Dismiss" wire:click="dismissMail({{ $mail->id }})">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    @endif

                    {{-- Delete --}}
                    <button
                        class="justify-center p-2 text-white bg-red-500 rounded cursor-pointer transition hover:bg-red-600"
                        title="Delete" wire:click="deleteMail({{ $mail->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>

            {{-- Date --}}
            <td class="py-2 px-3">{{ $mail->date }}</td>

            {{-- Name --}}
            <td class="py-2 px-3">{{ $mail->name }}</td>

            {{-- E-mail --}}
            <td class="py-2 px-3">{{ $mail->email }}</td>

            {{-- Message --}}
            <td class="py-2 px-3">{{ $mail->message }}</td>

            {{-- Last Updated --}}
            <td class="py-2 px-3 text-sm">
                {{ $mail->updated_at->diffForHumans() }}
            </td>
        </tr>
    @empty
        <tr class="backdrop-blur transition bg-white/80 hover:bg-gray-100">
            <td colspan="7" class="text-center py-4">No mails found.</td>
        </tr>
    @endforelse
</x-table>

<div class="mt-4">
    {{ $mails->links('vendor.pagination.simple-tailwind') }}
</div>
