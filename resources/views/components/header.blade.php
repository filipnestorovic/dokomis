<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Baza klijenata | Dokomis DOO</title>
    <link rel="icon" href="{{asset('/images/favicon.png')}}" type="image/x-icon">
{{--    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('/')}}css/mdb.min.css">
    <link rel="stylesheet" href="{{asset('/')}}css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
{{--    <script type="text/javascript" src="{{asset('/')}}js/jquery.min.js"></script>--}}
{{--    <script type="text/javascript" src="{{asset('/')}}js/popper.min.js"></script>--}}
{{--    <script type="text/javascript" src="{{asset('/')}}js/bootstrap.min.js"></script>--}}
    @vite('resources/js/app.js')
    @livewireStyles
    @stack('styles')
</head>
<body>
<div class="container-for-admin">
    <header>
        <nav class="navbar fixed-top navbar-light white pt-2 pb-2 pl-0">
            <div class="container-fluid">
                <a href="https://dokomis.rs" target="_blank"><img src="{{asset('images/dokomis_logo.png')}}" alt="dokomis_logo"/></a>
                <div class="float-right">
{{--                    <ul class="navbar-nav nav-flex-icons">--}}
{{--                        <li class="nav-item">--}}
{{--                            <div class="text-center">--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </nav>
    </header>
    <main class="pt-5 mx-lg-12 pl-0">
        <div class="mt-5 mb-4 ml-3 mr-3 wow fadeIn">
            <div class="card-body">
                <div class="col-md-12">
