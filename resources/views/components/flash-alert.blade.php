@props(['type'])

@php
    $classes = 'w-full ';

    switch ($type) {
        case 'error':
            $classes .= '!bg-red-200/80 !text-red-800';
            break;
        case 'success':
            $classes .= '!bg-green-200/80 !text-green-800';
            break;
    }
@endphp

<x-card {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot->isNotEmpty() ? $slot : session($type) }}
</x-card>
