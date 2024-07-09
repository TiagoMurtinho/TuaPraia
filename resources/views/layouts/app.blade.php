<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts/head')
</head>
    <body>

    @if(!isset($navbar) || $navbar != false)
        <header id="header" class="header">
            @include('layouts.navbar')
        </header><!-- End Header -->
    @endif

            <!-- Page Content -->
    <main @if(!isset($navbar) || $navbar != false) id="main" @endif class="main">
        @yield('content')
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <footer>
        @include('layouts/footer')
    </footer>

    </body>
</html>
