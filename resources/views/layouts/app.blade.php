<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TempEvent')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-indigo-700">TempEvent</a>
            <nav class="flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="{{ route('events.index') }}" class="hover:text-indigo-700">Browse events</a>
                <a href="{{ route('events.manage') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white shadow-sm hover:bg-indigo-700">Organizer view</a>
            </nav>
        </div>
    </header>
    <main class="mx-auto max-w-7xl px-6 py-10 lg:px-8">
        @yield('content')
    </main>
</body>
</html>
