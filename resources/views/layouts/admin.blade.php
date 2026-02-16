<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />
    
    <title>Administration</title>
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
    @stack('styles')
    @livewireStyles
</head>
<body>
    <div class="page flex">
        <!-- Left Menu -->
        <aside class="w-1/4 bg-gray-800 text-white p-4 min-h-screen">
            <h2 class="text-lg font-bold mb-4">Menu Administratif</h2>
            <nav class="space-y-2">
                <a href="{{ route('admin.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Utilisateurs</a>
                <a href="{{ route('permissions.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Permissions</a>
            </nav>
        </aside>

        <!-- Right Content -->
        <main class="w-3/4 p-4">
            @yield('content')
        </main>
    </div>
    
    @vite('resources/js/app.js')
    @stack('scripts')
    @livewireScripts
</body>
</html>