<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts / CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- Entire page background now uses Queen Pink -->
    <div class="min-h-screen" style="background-color: var(--pink-light);">

        {{-- Navigation Bar --}}
        @include('layouts.navigation')

        {{-- Page Header --}}
        @isset($header)
            <header class="shadow"
                style="background: var(--pink-mid); color: var(--white); border-bottom: 4px solid var(--pink-dark);">
                
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="page-title" style="color: var(--white); margin: 0;">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

    </div>
</body>
</html>
