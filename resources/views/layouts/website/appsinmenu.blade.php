<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Custom fonts for this template-->
	<link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" type="text/css">
	
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
	<noscript><link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" /></noscript>
     
	@yield('css')

</head>
<body class="is-preload">
    <!-- Page Wrapper -->
	<div id="page-wrapper">
        <!-- Header -->
        <header id="header" class="alt">
            <!-- <h1><a href="/">INSTITUTO ESTATAL DEL AGUA</a></h1> -->
            <!-- <nav>
                <a href="#menu">Menu</a>
            </nav> -->
        </header>

        <!-- Menu -->
        <nav id="menu">
            <div class="inner">
                <h2>Menu</h2>
                    @yield('menu')
                <a href="#" class="close">Close</a>
            </div>
        </nav>
            
            @yield('content')

        @include('layouts.website.footer')

    </div>
    
    <!--JavaScript-->
    <!-- <script src="assets/js/jquery.min.js"></script> v3.4.1 -->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/js/main/jquery.scrollex.min.js') }}"></script>
	<script src="{{ asset('assets/js/main/breakpoints.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
	<script src="{{ asset('assets/js/main/main.js') }}"></script>

	@yield('scripts')
</body>
</html>
