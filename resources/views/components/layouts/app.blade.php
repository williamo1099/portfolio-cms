<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title --}}
    <title>Portfolio Management @isset($title)
            | {{ $title }}
        @endisset
    </title>

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body style="background-image: url('{{ asset('images/background.jpg') }}');"
    class="bg-cover bg-center flex flex-col min-h-screen">

    {{-- Navigation bar --}}
    <x-navbar />

    {{-- Content --}}
    <div class="p-4 grow">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    <x-footer />

    {{-- Scripts --}}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
</body>

</html>
