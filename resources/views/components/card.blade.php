@props(['class' => ''])

<div
    {{ $attributes->merge(['class' => 'p-4 rounded shadow-md backdrop-blur bg-white/80 text-gray-800 transition ' . $class]) }}>
    {{ $slot }}
</div>
