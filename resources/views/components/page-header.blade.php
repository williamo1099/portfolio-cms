@props(['title', 'breadcrumbs' => []])

<div class="flex flex-col">
    {{-- Title --}}
    <h3 class="text-2xl font-bold text-gray-100 drop-shadow-md">
        {{ $title }}
    </h3>

    {{-- Breadcrumbs --}}
    @if (!empty($breadcrumbs))
        <nav class="flex">
            <ol class="inline-flex items-center">
                @foreach ($breadcrumbs as $item)
                    <li class="text-gray-100">
                        @if (!empty($item['url']))
                            <a href="{{ $item['url'] }}"
                                class="transition font-semibold hover:underline">{{ $item['label'] }}</a>
                        @else
                            <span class="text-gray-400">{{ $item['label'] }}</span>
                        @endif

                        @if (!$loop->last)
                            <i class="mx-1 bi bi-caret-right"></i>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    @endif
</div>
