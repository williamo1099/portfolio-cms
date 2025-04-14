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
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    {{-- Navigation bar --}}
    <x-navbar />

    {{-- Content --}}
    <div class="p-4">
        {{ $slot }}
    </div>
</body>

</html>
