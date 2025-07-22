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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- @if (Auth::check() && !Auth::user()->is_admin) --}}
                @include('components.navbar')
            {{-- @endif --}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            @yield('content')
            
            
            {{-- @if (Auth::check() && !Auth::user()->is_admin) --}}
            @include('components.footer')
            {{-- @endif --}}

<div x-data="{ openChat: false }" class="fixed bottom-5 right-5 z-50">

    <!-- Chat Button -->
    <button 
        @click="openChat = !openChat" 
        class="bg-blue-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-blue-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.84L3 20l1.38-3.28A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
    </button>

    <!-- Chat Box -->
<a href="/chat/1" 
   class="fixed bottom-5 right-5 z-50 bg-blue-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-blue-700 focus:outline-none"
   title="Open Chat">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.84L3 20l1.38-3.28A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
</a>
        
          <!-- Toast Notifications (success and error) -->
    @if (session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded shadow-lg z-50 animate-bounce">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-3 rounded shadow-lg z-50 animate-bounce">
            {{ session('error') }}
        </div>
    @endif



    <!-- Remove Toast Notifications after a brief delay -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.fixed.top-4.right-4').forEach(el => el.remove());
    }, 3000);
</script>

    </body>
</html>
