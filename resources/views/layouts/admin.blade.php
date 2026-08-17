<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') — Islamic Site Control Center</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-900 text-slate-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        
        <!-- Admin Sidebar Partial (STEP 10) -->
        @include('admin.partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Admin Topbar Partial (STEP 11) -->
            @include('admin.partials.topbar')

            <!-- Page Body -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-900">
                <!-- Success Alert -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 text-sm flex items-center justify-between shadow-lg">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">✅</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" @click="$el.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200">
                            &times;
                        </button>
                    </div>
                @endif

                <!-- Error Alert -->
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-950/80 border border-red-600/50 text-red-200 text-sm shadow-lg">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <span>⚠️</span> অনুগ্রহ করে নিচের ভুলগুলো সংশোধন করুন:
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
