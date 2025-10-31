<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.4.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>

    <meta name="msapplication-TileColor" content="#066fd1" />
    <meta name="theme-color" content="#066fd1" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description"
        content="Tabler is packed with beautifully crafted components and powerful features. Jump in and start building a stunning dashboard — all for free!" />
    <meta name="canonical" content="https://preview.tabler.io/" />
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png" />
    <meta name="twitter:site" content="@tabler_ui" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI." />
    <meta name="twitter:description"
        content="Tabler is packed with beautifully crafted components and powerful features. Jump in and start building a stunning dashboard — all for free!" />
    <meta property="og:image" content="https://preview.tabler.io/static/og.png" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="640" />
    <meta property="og:site_name" content="Tabler" />
    <meta property="og:type" content="object" />
    <meta property="og:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI." />
    <meta property="og:url" content="https://preview.tabler.io/static/og.png" />
    <meta property="og:description"
        content="Tabler is packed with beautifully crafted components and powerful features. Jump in and start building a stunning dashboard — all for free!" />

    <!-- END CUSTOM FONT -->
</head>

<body>
    <div class="page">

        @include('mocks.header')
        @include('mocks.navbar');


        <div class="page-wrapper">
            @include('mocks.page-header')

            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl">



                    <div class="row row-deck row-cards">
                        <div class="col col-12">
                            <x-card title="Tabulator Example">
                              @include('mocks.tabulator')
                            </x-card>
                        </div>
                    </div>


                    <div class="row row-deck row-cards">
                        <div class="col col-sm-12 col-lg-6">
                            <x-card title="Echarts Example 1">
                                <div id="echarts-example-00" style="height: 400px"></div>
                            </x-card>
                        </div>

                        <div class="col col-12 col-lg-6">
                            <x-card title="Echarts Example 2">
                                <div id="echarts-example-01" style="height: 400px"></div>
                            </x-card>
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
        <!-- END PAGE BODY -->

        @include('mocks.footer')

    </div>
    </div>
    @include('mocks.modals')
    @include('mocks.settings')
    @vite('resources/js/app.js')

</body>

</html>
