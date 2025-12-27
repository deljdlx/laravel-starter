<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
</head>

<body>
    <div class="page">
        <div class="page-wrapper">
            <!-- Header Section -->
            <div class="ds-header">
                <div class="container-xl">
                    <h1 class="ds-header-title">{{ config('app.name', 'Laravel') }}</h1>
                    <p class="ds-header-subtitle">Available routes</p>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    @foreach($routes as $category => $categoryRoutes)
                    <div class="ds-category-section">
                        <div class="ds-category-header">
                            <h2 class="ds-category-title">{{ $category }}</h2>
                            <span class="ds-badge-count">{{ count($categoryRoutes) }}</span>
                        </div>

                        <div class="ds-grid ds-grid-auto">
                            @foreach($categoryRoutes as $route)
                            <a href="{{ $route['uri'] }}" class="ds-route-link">
                                <div class="ds-card ds-route-card">
                                    <div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="ds-route-method">GET</span>
                                            @if($route['name'])
                                            <span class="ds-route-name">{{ Str::limit($route['name'], 25) }}</span>
                                            @endif
                                        </div>
                                        <div class="ds-route-uri">{{ $route['uri'] }}</div>
                                    </div>
                                    <div class="ds-route-action">
                                        <span>Visit route</span>
                                        <svg class="ds-route-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"/>
                                            <path d="m12 5 7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer -->
            <footer class="ds-footer">
                <div class="container-xl">
                    <div class="text-center">
                        <p class="mb-0">
                            Built with <a href="https://laravel.com" target="_blank">Laravel {{ app()->version() }}</a> 
                            × <a href="https://tabler.io" target="_blank">Tabler</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
