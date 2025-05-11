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
