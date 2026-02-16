<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /** @var array<int, RoutingRoute> $allRoutes */
    $allRoutes = Route::getRoutes()->getRoutes();

    $routes = collect($allRoutes)
        ->filter(function (RoutingRoute $route): bool {
            return in_array('GET', $route->methods(), true)
                && ! str_starts_with($route->uri(), 'api/')
                && ! str_starts_with($route->uri(), 'livewire/')
                && ! str_starts_with($route->uri(), 'storage/')
                && ! in_array($route->uri(), ['up', 'sanctum/csrf-cookie', '/'], true);
        })
        ->map(function (RoutingRoute $route): array {
            return [
                'uri' => '/'.$route->uri(),
                'name' => $route->getName(),
                'method' => implode('|', $route->methods()),
            ];
        })
        ->groupBy(function (array $route): string {
            $uri = $route['uri'];
            if (str_starts_with($uri, '/dev/')) {
                return 'Developer Tools';
            }
            if (str_starts_with($uri, '/demo/')) {
                return 'Demo';
            }
            if (str_starts_with($uri, '/permissions')) {
                return 'Permissions';
            }
            if (str_starts_with($uri, '/users')) {
                return 'Users';
            }

            return 'Other';
        })
        ->sortKeys();

    return view('welcome', compact('routes'));
});

Route::get('/form', function () {
    return view('form');
});
