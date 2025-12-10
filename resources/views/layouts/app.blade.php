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

   



    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
    .nav-avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        min-height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        flex-shrink: 0;
        display: block;
    }

    .nav-user {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        background: var(--color-accent);
        border-radius: 8px;
        max-height: 40px;
        white-space: nowrap;
    }

    .nav-username {
        font-size: 15px;
        color: white;
        font-weight: 600;
    }
</style>

</head>

<body class="font-sans antialiased">

    <!-- Entire page background now uses Queen Pink -->
    <div class="min-h-screen bg-[var(--color-bg)]">


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
