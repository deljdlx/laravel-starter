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
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .admin-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 25%;
            background-color: #1f2937;
            color: white;
            padding: 1.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }
        .admin-content {
            width: 75%;
            padding: 2rem;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Left Menu -->
        <aside class="admin-sidebar">
            <h2 class="text-lg font-bold mb-4">Menu Administratif</h2>
            <nav class="space-y-2">
                <a href="{{ route('admin.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700 transition">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700 transition">Utilisateurs</a>
                <a href="{{ route('admin.permissions.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700 transition">Permissions</a>
            </nav>
        </aside>

        <!-- Right Content -->
        <main class="admin-content">
            @yield('content')
        </main>
    </div>
    
    @vite('resources/js/app.js')
    @stack('scripts')
    @livewireScripts
</body>
</html>