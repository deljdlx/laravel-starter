<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="msapplication-TileColor" content="#066fd1" />
    <meta name="theme-color" content="#066fd1" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    @vite('resources/css/app.css')
    <style>
        .route-card {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .route-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            border-left-color: var(--tblr-primary);
        }
        .route-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .route-uri {
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.95rem;
            font-weight: 600;
        }
        .route-name {
            font-size: 0.75rem;
            color: var(--tblr-muted);
        }
        .category-badge {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="page-wrapper">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="container-xl">
                    <div class="text-center">
                        <h1 class="display-5 fw-bold mb-3">{{ config('app.name', 'Laravel') }}</h1>
                        <p class="lead mb-0">Available Routes</p>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    @foreach($routes as $category => $categoryRoutes)
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <h2 class="mb-0">{{ $category }}</h2>
                            <span class="badge bg-secondary ms-2">{{ count($categoryRoutes) }}</span>
                        </div>

                        <div class="row row-cards">
                            @foreach($categoryRoutes as $route)
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <a href="{{ $route['uri'] }}" class="route-link">
                                    <div class="card route-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-blue me-2">GET</span>
                                                @if($route['name'])
                                                <span class="category-badge text-muted">{{ Str::limit($route['name'], 20) }}</span>
                                                @endif
                                            </div>
                                            <div class="route-uri text-primary mb-1">
                                                {{ $route['uri'] }}
                                            </div>
                                            <div class="text-muted small">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M5 12l14 0" />
                                                    <path d="M13 18l6 -6" />
                                                    <path d="M13 6l6 6" />
                                                </svg>
                                                Click to visit
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Built with <a href="https://laravel.com" class="link-secondary" target="_blank">Laravel {{ app()->version() }}</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://tabler.io" class="link-secondary" target="_blank">Tabler UI</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
