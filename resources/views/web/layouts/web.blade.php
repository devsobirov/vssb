<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xorazm viloyat sog'liqni saqlash boshqarmasi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/css/fontisto/fontisto.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">
    <link rel="icon" href="{{ asset('assets/images/logo.svg') }}">
</head>
<body>
<div class="loader">
    <div class="logo">
        <img src="images/logo.svg" alt="">
    </div>
    <h1>Xorazm viloyati sog'liqni saqlash boshqarmasi</h1>
    <div class="line">
        <div class="progress"></div>
    </div>
</div>

@include('web.partials.header')

@include('web.partials.navigation')

@yield('breadcrumb')

<main>
    @yield('content')
</main>
@include('web.partials.footer')

<a href="#" class="up">
    <i class="fi fi-angle-up"></i>
</a>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
