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
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            console.group('%cwelcome.blade.php :: 769 =============================',
                'color: #273118; font-size: 1rem');
            console.log(jsVectorMap);
            console.groupEnd();

            const map = new jsVectorMap({
                selector: "#map-world",
                map: "world",
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: "var(--tblr-bg-surface-secondary)",
                        stroke: "var(--tblr-border-color)",
                        strokeWidth: 2,
                    },
                },
                zoomOnScroll: false,
                zoomButtons: false,
                series: {
                    regions: [{
                        attribute: "fill",
                        scale: {
                            scale1: "color-mix(in srgb, transparent, var(--tblr-primary) 10%)",
                            scale2: "color-mix(in srgb, transparent, var(--tblr-primary) 20%)",
                            scale3: "color-mix(in srgb, transparent, var(--tblr-primary) 30%)",
                            scale4: "color-mix(in srgb, transparent, var(--tblr-primary) 40%)",
                            scale5: "color-mix(in srgb, transparent, var(--tblr-primary) 50%)",
                            scale6: "color-mix(in srgb, transparent, var(--tblr-primary) 60%)",
                            scale7: "color-mix(in srgb, transparent, var(--tblr-primary) 70%)",
                            scale8: "color-mix(in srgb, transparent, var(--tblr-primary) 80%)",
                            scale9: "color-mix(in srgb, transparent, var(--tblr-primary) 90%)",
                            scale10: "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                        },
                        values: {
                            AF: "scale2",
                            AL: "scale2",
                            DZ: "scale4",
                            AO: "scale3",
                            AG: "scale1",
                            AR: "scale5",
                            AM: "scale1",
                            AU: "scale7",
                            AT: "scale5",
                            AZ: "scale3",
                            BS: "scale1",
                            BH: "scale2",
                            BD: "scale4",
                            BB: "scale1",
                            BY: "scale3",
                            BE: "scale5",
                            BZ: "scale1",
                            BJ: "scale1",
                            BT: "scale1",
                            BO: "scale2",
                            BA: "scale2",
                            BW: "scale2",
                            BR: "scale8",
                            BN: "scale2",
                            BG: "scale2",
                            BF: "scale1",
                            BI: "scale1",
                            KH: "scale2",
                            CM: "scale2",
                            CA: "scale7",
                            CV: "scale1",
                            CF: "scale1",
                            TD: "scale1",
                            CL: "scale4",
                            CN: "scale9",
                            CO: "scale5",
                            KM: "scale1",
                            CD: "scale2",
                            CG: "scale2",
                            CR: "scale2",
                            CI: "scale2",
                            HR: "scale3",
                            CY: "scale2",
                            CZ: "scale4",
                            DK: "scale5",
                            DJ: "scale1",
                            DM: "scale1",
                            DO: "scale3",
                            EC: "scale3",
                            EG: "scale5",
                            SV: "scale2",
                            GQ: "scale2",
                            ER: "scale1",
                            EE: "scale2",
                            ET: "scale2",
                            FJ: "scale1",
                            FI: "scale5",
                            FR: "scale8",
                            GA: "scale2",
                            GM: "scale1",
                            GE: "scale2",
                            DE: "scale8",
                            GH: "scale2",
                            GR: "scale5",
                            GD: "scale1",
                            GT: "scale2",
                            GN: "scale1",
                            GW: "scale1",
                            GY: "scale1",
                            HT: "scale1",
                            HN: "scale2",
                            HK: "scale5",
                            HU: "scale4",
                            IS: "scale2",
                            IN: "scale7",
                            ID: "scale6",
                            IR: "scale5",
                            IQ: "scale3",
                            IE: "scale5",
                            IL: "scale5",
                            IT: "scale8",
                            JM: "scale2",
                            JP: "scale9",
                            JO: "scale2",
                            KZ: "scale4",
                            KE: "scale2",
                            KI: "scale1",
                            KR: "scale6",
                            KW: "scale4",
                            KG: "scale1",
                            LA: "scale1",
                            LV: "scale2",
                            LB: "scale2",
                            LS: "scale1",
                            LR: "scale1",
                            LY: "scale3",
                            LT: "scale2",
                            LU: "scale3",
                            MK: "scale1",
                            MG: "scale1",
                            MW: "scale1",
                            MY: "scale5",
                            MV: "scale1",
                            ML: "scale1",
                            MT: "scale1",
                            MR: "scale1",
                            MU: "scale1",
                            MX: "scale7",
                            MD: "scale1",
                            MN: "scale1",
                            ME: "scale1",
                            MA: "scale3",
                            MZ: "scale2",
                            MM: "scale2",
                            NA: "scale2",
                            NP: "scale2",
                            NL: "scale6",
                            NZ: "scale4",
                            NI: "scale1",
                            NE: "scale1",
                            NG: "scale5",
                            NO: "scale5",
                            OM: "scale3",
                            PK: "scale4",
                            PA: "scale2",
                            PG: "scale1",
                            PY: "scale2",
                            PE: "scale4",
                            PH: "scale4",
                            PL: "scale10",
                            PT: "scale5",
                            QA: "scale4",
                            RO: "scale4",
                            RU: "scale7",
                            RW: "scale1",
                            WS: "scale1",
                            ST: "scale1",
                            SA: "scale5",
                            SN: "scale2",
                            RS: "scale2",
                            SC: "scale1",
                            SL: "scale1",
                            SG: "scale5",
                            SK: "scale3",
                            SI: "scale2",
                            SB: "scale1",
                            ZA: "scale5",
                            ES: "scale7",
                            LK: "scale2",
                            KN: "scale1",
                            LC: "scale1",
                            VC: "scale1",
                            SD: "scale3",
                            SR: "scale1",
                            SZ: "scale1",
                            SE: "scale5",
                            CH: "scale6",
                            SY: "scale3",
                            TW: "scale5",
                            TJ: "scale1",
                            TZ: "scale2",
                            TH: "scale5",
                            TL: "scale1",
                            TG: "scale1",
                            TO: "scale1",
                            TT: "scale2",
                            TN: "scale2",
                            TR: "scale6",
                            TM: "scale1",
                            UG: "scale2",
                            UA: "scale4",
                            AE: "scale5",
                            GB: "scale8",
                            US: "scale10",
                            UY: "scale2",
                            UZ: "scale2",
                            VU: "scale1",
                            VE: "scale5",
                            VN: "scale4",
                            YE: "scale2",
                            ZM: "scale2",
                            ZW: "scale1",
                        },
                    }, ],
                },
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script>
    <script>

    </script>
    <script>

    </script>
    <script>

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-2"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [13, 11, 19, 22, 12, 7, 14, 3, 21],
                    }, ],
                }).render();
        });
    </script>
    <script>

    </script>
    <script>

    </script>
    <script>

    </script>
    <script>

    </script>
    <script>

    </script>



    @vite('resources/js/app.js')

</body>

</html>
