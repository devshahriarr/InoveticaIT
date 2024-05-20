<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "vertical" }}'>

<head>
    @include('inc.headerCssLink')
</head>

<body>
    <div id="root">
        @include('layouts.nav')

        <main>
            <div class="container">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-12 col-md-7">
                            <h1 class="mb-0 pb-0 display-4" id="title">Vertical Hidden Menu</h1>
                            <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                                <ul class="breadcrumb pt-0">
                                    <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="Interface.html">Interface</a></li>
                                    <li class="breadcrumb-item"><a href="Interface.Content.html">Content</a></li>
                                    <li class="breadcrumb-item"><a href="Interface.Content.Menu.html">Menu</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Title End -->
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <!-- Content Start -->
                <div class="card mb-2">
                    <div class="card-body h-100">A vertical menu that newer shows larger pinned version and switches
                        between mobile view and semi-hidden view.</div>
                </div>
                <!-- Content End -->
            </div>
        </main>
        <!-- Layout Footer Start -->
        <footer>
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="mb-0 text-muted text-medium">Colored Strategies 2021</p>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://1.envato.market/BX5oGy" target="_blank"
                                        class="btn-link">Review</a>
                                </li>
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://1.envato.market/BX5oGy" target="_blank"
                                        class="btn-link">Purchase</a>
                                </li>
                                <li class="breadcrumb-item mb-0 text-medium">
                                    <a href="https://acorn-html-docs.coloredstrategies.com/" target="_blank"
                                        class="btn-link">Docs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Layout Footer End -->
    </div>
    <!-- Theme Settings Modal Start -->
    @include('inc.themeSettings&NichesModal')
    <!-- Theme Settings Modal End -->

    <!-- Niches Modal Start -->

    @include('inc.nichesModal')
    <!-- Niches Modal End -->

    <!-- Theme Settings & Niches Buttons Start -->
    @include('inc.theme_settings_and_niches_button')
    <!-- Theme Settings & Niches Buttons End -->

    <!-- Search Modal Start -->
    @include('inc.search_modal')
    <!-- Search Modal End -->
    @include('inc.footerScripts')
</body>

</html>
