@props(['active' => false, 'href' => '#'])

@php
    $classes = 'nav-link ' . ($active ? 'active' : '');
@endphp

<li class="nav-item">
    <a wire:navigate {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}
        href="#">{{ $slot }}</a>
</li>
