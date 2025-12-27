<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'Laravel') }} - Components Demo</title>

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
            @include('mocks.page-header')

            <!-- BEGIN PAGE BODY -->
            <div class="page-body">

                {{-- Section: Alpine.js Interactive Examples --}}
                <div class="container-xl" id="alpine">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="page-title mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" /></svg>
                                    Alpine.js Interactive Examples
                                </h2>
                                <p class="text-secondary mb-0">Reactive components using Alpine.js</p>
                            </div>
                            <a href="{{ route('demo.components.alpine') }}" class="btn btn-primary btn-sm">
                                View Full Page
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                {{-- Section: Form Components --}}
                <div class="container-xl" id="forms">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="page-title mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                                    Form Components
                                </h2>
                                <p class="text-secondary mb-0">Tabler form elements and input styles showcase</p>
                            </div>
                            <a href="{{ route('demo.components.forms') }}" class="btn btn-primary btn-sm">
                                View Full Page
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                {{-- Section: Mermaid Diagrams --}}
                <div class="container-xl" id="diagrams">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="page-title mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M9 9v6" /><path d="M15 9v6" /><path d="M9 12h6" /></svg>
                                    Mermaid Diagram Examples
                                </h2>
                                <p class="text-secondary mb-0">Interactive diagrams using Mermaid.js</p>
                            </div>
                            <a href="{{ route('demo.components.diagrams') }}" class="btn btn-primary btn-sm">
                                View Full Page
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="my-5">


                {{-- Section: Charts & Data Tables --}}
                <div class="container-xl" id="charts">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="page-title mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>
                                    Charts & Data Tables
                                </h2>
                                <p class="text-secondary mb-0">Interactive charts using Echarts and Tabulator data tables</p>
                            </div>
                            <a href="{{ route('demo.components.charts') }}" class="btn btn-primary btn-sm">
                                View Full Page
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
                    <hr class="my-5">

                    {{-- Section: Tabler UI Components --}}
                    <div id="tabler-components">
                        <div class="mb-3">
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                                Tabler UI Components
                            </h2>
                            <p class="text-secondary">Dashboard widgets, stats cards, and UI elements</p>
                        </div>
                    </div>

                    <div class="row row-deck row-cards">
                        <div class="col-sm-12 col-lg-6">

                            <x-card title="Let's get started!">
                                @include('mocks/welcome-back')
                            </x-card>

                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.total-users')
                        </x-card>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.active-users')
                        </x-card>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.sales')
                        </x-card>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.revenue')
                        </x-card>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.new-clients')
                        </x-card>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <x-card>
                            @include('mocks.active-subscriptions')
                        </x-card>
                    </div>
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
                    <div class="col-lg-6">
                        <x-card>
                            <h3 class="card-title">"Traffic summary"</h3>
                            <div id="chart-mentions" class="position-relative chart-lg"></div>
                        </x-card>
                    </div>
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
                    <div class="col-lg-6">
                        <div class="row row-cards">
                            <div class="col-12">
                                <x-card>
                                    @include('mocks.storage')
                                </x-card>
                            </div>
                            <div class="col-12">


                                <x-card style="height: 28rem">
                                    <x-slot name="body" class="card-body-scrollable card-body-scrollable-shadow">
                                        @include('mocks.events')
                                    </x-slot>
                                </x-card>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <x-card title="Development activity">
                            @include('mocks.development-activity')
                        </x-card>
                    </div>
                    <div class="col-12">
                        @include('mocks.tabler-icons')
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <x-card title="Most visited pages">
                            @include('mocks.most-visited-pages')
                        </x-card>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        @include('mocks.help-tabler')
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <x-card title="Social Media Traffic">
                            @include('mocks.social-media-traffic')
                        </x-card>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <x-card title="Tasks">
                            @include('mocks.tasks')
                        </x-card>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            @include('mocks.invoices')
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('mocks.footer')

    </div>
    @include('mocks.modals')
    @include('mocks.settings')
    @vite(['resources/js/app.js', 'resources/js/home.js'])

</body>

</html>
