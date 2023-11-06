@props(['isGuest' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-amber-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
    .swal-modal {
        border: 1px solid black;
        border-radius: 0;
        box-shadow: 4px 4px black;
    }

    .swal-title {
        color: black;
    }

    .swal-button {
        border: 1px solid black;
        border-radius: 0;
        box-shadow: 4px 4px black;
        transition: box-shadow 0.15s ease-in-out;
    }

    .swal-button:hover {
        box-shadow: 6px 6px black;
    }

    .swal-button:focus {
        box-shadow: 6px 6px black !important;
    }

    .swal-button--cancel {
        background-color: transparent;
    }

    .swal-button--cancel:hover {
        background-color: transparent !important;
    }

    .swal-button--confirm {
        background-color: #bef264;
    }

    .swal-button--confirm:hover {
        background-color: #bef264 !important;
    }
</style>

<body class="font-sans antialiased">
    <div>
        @if(!$isGuest)
        @include('layouts.navigation')
        @endif
        <main class="container mx-auto py-8 mt-20 min-h-[80vh]">
            {{ $slot }}
        </main>
        @if(!$isGuest)
        @include('layouts.footer')
        @endif
    </div>
</body>

</html>