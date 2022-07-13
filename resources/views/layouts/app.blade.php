<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo d-flex align-items-center justify-content-start">
        <a href="{{ route('home') }}" class="pe-2">
            <img style="width: 40px; height: 40px;" src="{{ asset('images/logo/logo.svg') }}" alt="logo"/>
        </a>
        <h5>Xorazm VSSB</h5>
    </div>
    <nav class="sidebar-nav">
        @include('layouts.navigation')
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->

<!-- ======== main-wrapper start =========== -->
<main class="main-wrapper">

    <!-- ========== header start ========== -->
    @include('layouts.header')
    <!-- ========== header end ========== -->

    <!-- ========== section start ========== -->
    <section class="section">
        <div class="container-fluid">
            @include('layouts.messages')
            @yield('content')
        </div>
        <!-- end container -->
    </section>
    <!-- ========== section end ========== -->

    <!-- ========== footer start =========== -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 order-last order-md-first">
                    <div class="copyright text-md-start">
                        <p class="text-sm">
                            Developed by
                            <a
                                    href="https://breezesoft.uz"
                                    rel="nofollow"
                                    target="_blank"
                            >
                                Breezesoft
                            </a>
                        </p>
                    </div>
                </div>
                <!-- end col-->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
</main>
<!-- ======== main-wrapper end =========== -->

<!-- ========= All Javascript files linkup ======== -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')
</body>
</html>
