<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Workshop Management') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #01205C;
            --blue: #3273BA;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col ml-0 lg:ml-64 transition-all duration-300">
            @include('layouts.topbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if (session('success'))
                    <div class="mb-6">
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-r shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">{{ session('success') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6">
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">{{ session('error') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>