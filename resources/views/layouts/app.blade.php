<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- STEP 14 — Title, Description & Canonical -->
        <title>@yield('title', config('app.name', 'Islamic Site'))</title>
        <meta name="description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        @hasSection('meta_keywords')
            <meta name="keywords" content="@yield('meta_keywords')">
        @endif

        @hasSection('canonical')
            <link rel="canonical" href="@yield('canonical')">
        @else
            <link rel="canonical" href="{{ url()->current() }}">
        @endif

        <!-- STEP 15 — Open Graph SEO -->
        <meta property="og:title" content="@yield('title', config('app.name', 'Islamic Site'))">
        <meta property="og:description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ config('app.name', 'Islamic Site') }}">
        @hasSection('og_image')
            <meta property="og:image" content="@yield('og_image')">
        @endif

        <!-- STEP 16 — Twitter/X Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', config('app.name', 'Islamic Site'))">
        <meta name="twitter:description" content="@yield('meta_description', 'Islamic knowledge, Quran, Hadith, Dua, Prayer Times and Islamic Calendar.')">
        @hasSection('og_image')
            <meta name="twitter:image" content="@yield('og_image')">
        @endif

        <!-- Extra Page-Specific Meta / Schema -->
        @yield('meta')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col">
        <!-- Navigation Menu -->
        @include('layouts.navigation')

        <!-- Page Heading (Optional) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </body>
</html>
