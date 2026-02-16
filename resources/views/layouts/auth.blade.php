<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
    @stack('styles')
</head>
<body>
    <div class="page">
        <x-header />
        <div class="page-wrapper" style="min-height: calc(100vh - 56px); display: flex; align-items: center; justify-content: center;">
            <div style="width: 100%; max-width: 400px; padding: var(--ds-spacing-lg);">
                @yield('content')
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
