<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/orange.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">


    <title>{{ $title ?? 'Requisition App' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body class="font-sans antialiased">


    <div class="loader" id="loader" >
    <img src="{{ asset('img/rings.svg') }}" class="w-40 border-1" alt="profile">
    </div>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 pb-8">
        <div
            class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 py-3 px-6">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @isset($header)
                <header>
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
        </div>

        <div class="pt-52">
            <!-- Page Content -->
            <main class="sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>

    </div>

    <script src="{{ asset('js/loader.js') }}" ></script>

</body>

</html>
