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

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- Top Navigation --}}
        @include('layouts.navigation')

        <div class="flex">
            {{-- Sidebar --}}
            {{-- <aside class="w-64 bg-white shadow h-screen hidden md:block">
                <div class="p-4 font-semibold text-lg border-b">Menu</div>
                <ul class="p-4 space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a></li>
                    <li><a href="{{ route('admin.candidates.index') }}"
                            class="text-gray-700 hover:text-blue-600">Kandidat</a></li>
                    <li><a href="{{ route('voter.voting.index') }}" class="text-gray-700 hover:text-blue-600">Voting</a>
                    </li> --}}
                    {{-- Tambahkan menu lain sesuai kebutuhan --}}
                    {{--
                </ul>
            </aside> --}}

            <div class="flex-1">
                {{-- Page Heading --}}
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                {{-- Page Content --}}
                <main class="p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{--
    <script src="//unpkg.com/alpinejs" defer></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>