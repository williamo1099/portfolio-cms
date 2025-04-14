@props(['title', 'text', 'click' => null, 'active' => false])

@php
    $classes =
        'w-xs rounded-lg shadow-md p-4 cursor-pointer transition ' .
        ($active ? 'bg-primary text-white' : 'bg-white text-gray-800 hover:bg-gray-100');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="button"
    @if ($click) wire:click="{{ $click }}" @endif>
    <h5 class="text-lg font-semibold mb-1">{{ $title }}</h5>
    <p class="text-sm">{{ $text }}</p>
</div>
