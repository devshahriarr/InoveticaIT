<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "vertical" }}'>

<head>
    @include('backend.inc.headerCssLink')
</head>

<body>
    <div id="root">
        @include('backend.layout.nav')

        <main>
            @yield('admin')
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
    @include('backend.inc.themeSettings&NichesModal')
    <!-- Theme Settings Modal End -->

    <!-- Niches Modal Start -->

    @include('backend.inc.nichesModal')
    <!-- Niches Modal End -->

    <!-- Theme Settings & Niches Buttons Start -->
    @include('backend.inc.theme_settings_and_niches_button')
    <!-- Theme Settings & Niches Buttons End -->

    <!-- Search Modal Start -->
    @include('backend.inc.search_modal')
    <!-- Search Modal End -->
    @include('backend.inc.footerScripts')
</body>

</html>
