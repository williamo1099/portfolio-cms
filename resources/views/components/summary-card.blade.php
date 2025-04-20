@props(['title', 'text', 'click' => null, 'active' => false])

@php
    $classes =
        'w-xs ' . ($active ? ' !bg-primary !text-white ' : ' hover:bg-white ') . ($click ? ' cursor-pointer ' : '');
@endphp

<div @if ($click) wire:click="{{ $click }}" @endif>
    <x-card {{ $attributes->merge(['class' => $classes]) }}>
        <h5 class="text-lg font-semibold mb-1">{{ $title }}</h5>
        <p class="text-sm">{{ $text }}</p>
    </x-card>
</div>
