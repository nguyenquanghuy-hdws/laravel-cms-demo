
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Nguyen Quang Huy">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontastic.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/tata.css') }}" id="theme-stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.default.css') }}" id="theme-stylesheet">
        <link rel="shortcut icon" href="{{ asset('assets/frontend/favicon.ico') }}">
        @yield('css')
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    </head>
  <body>
    <header class="header">
        @include('partials.frontend.header.top_navbar')
    </header>
    @yield('content')
    @include('partials.frontend.footer.main_footer')
    <script src="{{ asset('assets/frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('assets/frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/tata.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/front.js') }}"></script>
    @yield('js')
    <script src="{{ asset('assets/frontend/js/custom.js') }}"></script>
  </body>
</html>
