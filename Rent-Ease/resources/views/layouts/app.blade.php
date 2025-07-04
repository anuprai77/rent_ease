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
        </div>
        
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
