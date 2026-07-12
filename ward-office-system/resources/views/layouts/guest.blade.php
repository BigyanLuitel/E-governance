<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ward Office Portal') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col items-center pt-10 pb-10">

        {{-- Branding header --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-2">
            <div
                class="w-11 h-11 rounded-full bg-white ring-2 ring-govblue-700/20 shadow-sm flex items-center justify-center overflow-hidden shrink-0">
                <img src="{{ asset('images/emblem.png') }}" alt="Emblem" class="w-full h-full object-contain p-1"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="w-full h-full items-center justify-center hidden text-govblue-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12l1.75 1.75L14.5 10" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="font-bold text-navy-900 leading-tight">Ward Office</p>
                <p class="text-ink-600 text-xs leading-tight">Document Request &amp; Management System</p>
            </div>
        </a>

        <div class="w-full sm:max-w-md mt-6">
            {{ $slot }}
        </div>
    </div>
</body>

</html>