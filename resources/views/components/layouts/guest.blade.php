<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title --}}
    <title>Portfolio Management</title>

    {{-- Bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cover bg-no-repeat bg-center flex flex-col min-h-screen text-base"
    style="background-image: url('{{ asset('images/background.jpg') }}');">

    {{-- Content --}}
    <main class="flex grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />
</body>

</html>
