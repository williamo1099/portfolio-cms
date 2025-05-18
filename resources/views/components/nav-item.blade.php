@props(['active' => false, 'href' => '#'])

@php
    $classes =
        'flex rounded-md px-3 py-2 gap-2 text-sm font-medium transition ' .
        ($active ? 'bg-white text-primary lg:bg-primary lg:text-white' : 'text-white hover:bg-primary');
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>{{ $slot }}</a>
