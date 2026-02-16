@extends('layouts.app')

@section('title', config('app.name', 'Laravel'))

@section('content')
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
@endsection
