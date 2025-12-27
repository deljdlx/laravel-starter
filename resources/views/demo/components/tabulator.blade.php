<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tabulator Examples - {{ config('app.name') }}</title>
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
                    
                    <h2 class="page-title mb-3">Tabulator Examples</h2>
                    
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <x-card title="Tabulator Example">
                                @include('mocks.tabulator')
                            </x-card>
                        </div>
                    </div>
                </div>
            </div>
            @include('mocks.footer')
        </div>
    </div>
    @include('mocks.modals')
    @include('mocks.settings')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
</body>
</html>
