@props(['title', 'text', 'click' => null, 'active' => false])

@php
    $classes = 'card rounded ' . ($active ? 'bg-primary text-white' : '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} style="width: 18rem;" role="button"
    @if ($click) wire:click="{{ $click }}" @endif>
    <div class="card-body p-2">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $text }}</p>
    </div>
</div>
