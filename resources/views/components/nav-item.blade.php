@props(['active' => false, 'href' => '#'])

@php
    $classes =
        'rounded-md px-3 py-2 text-sm font-medium transition ' .
        ($active ? 'bg-primary text-white' : 'text-white hover:bg-primary');
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>{{ $slot }}</a>
