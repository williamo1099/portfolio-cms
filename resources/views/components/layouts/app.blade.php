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

    {{-- Bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</body>

</html>
