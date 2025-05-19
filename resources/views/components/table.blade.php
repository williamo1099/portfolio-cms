@props(['headers'])

<div class="rounded border border-gray-200 overflow-hidden hidden lg:block">
    <table class="w-full text-sm text-left text-black">
        <thead class="bg-primary/80 backdrop-blur backdrop-saturate-150 text-white uppercase text-xs">
            <tr>
                @foreach ($headers as $col)
                    <th class="py-2 px-3 {{ $col['class'] ?? '' }}">{{ $col['name'] }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
