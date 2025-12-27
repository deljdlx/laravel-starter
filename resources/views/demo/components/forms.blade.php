<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Form Components - {{ config('app.name') }}</title>
    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
</head>
<body>
    <div class="page">
        @include('mocks.header')
        @include('mocks.navbar')
        <div class="page-wrapper">
            @include('mocks.page-header')
            <div class="page-body">
                <div class="container-xl">
                    <div class="mb-4">
                        <a href="{{ route('demo.components') }}" class="btn btn-outline-secondary btn-sm">
                            ← Back to Components
                        </a>
                    </div>
                    
                    <h2 class="page-title mb-3">Form Components</h2>
                    @include('form')
                </div>
            </div>
            @include('mocks.footer')
        </div>
    </div>
    @include('mocks.modals')
    @include('mocks.settings')
    @vite('resources/js/app.js')
</body>
</html>
