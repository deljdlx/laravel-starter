<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'Laravel') }} - ApexCharts Demo</title>

    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
</head>

<body>
    <div class="page">

        @include('mocks.header')
        @include('mocks.navbar')

        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">Demo</div>
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                </svg>
                                ApexCharts Examples
                            </h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('demo.components') }}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 6l-6 6l6 6" />
                                </svg>
                                Back to Components
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        
                        {{-- Traffic Summary Chart --}}
                        <div class="col-lg-6">
                            <x-card>
                                <h3 class="card-title">Traffic summary</h3>
                                <div id="chart-mentions" class="position-relative chart-lg"></div>
                            </x-card>
                        </div>

                        {{-- Map Visualization --}}
                        <div class="col-lg-6">
                            <x-card>
                                <h3 class="card-title">Locations</h3>
                                <div class="ratio ratio-21x9">
                                    <div>
                                        <div id="map-world" class="w-100 h-100"></div>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        {{-- Mini charts row --}}
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">
                                    <x-card class="card-sm">
                                        @include('mocks.mini-sales')
                                    </x-card>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <x-card class="card-sm">
                                        @include('mocks.mini-orders')
                                    </x-card>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <x-card class="card-sm">
                                        @include('mocks.mini-shares')
                                    </x-card>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <x-card class="card-sm">
                                        @include('mocks.mini-likes')
                                    </x-card>
                                </div>
                            </div>
                        </div>

                        {{-- Development Activity --}}
                        <div class="col-lg-6">
                            <x-card title="Development activity">
                                @include('mocks.development-activity')
                            </x-card>
                        </div>

                        {{-- Storage Chart --}}
                        <div class="col-lg-6">
                            <x-card>
                                @include('mocks.storage')
                            </x-card>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('mocks.footer')
    </div>

    @include('mocks.modals')
    @include('mocks.settings')
    @vite(['resources/js/app.js', 'resources/js/pages/apexcharts.js'])
</body>

</html>
