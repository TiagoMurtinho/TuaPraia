<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>

    @include('layouts/head')
</head>
    <body class="custom-body-bg">

    @if(!isset($navbar) || $navbar != false)
        <header id="header" class="header">
            @include('layouts.navbar')
        </header><!-- End Header -->
    @endif

            <!-- Page Content -->
    <main @if(!isset($navbar) || $navbar != false) id="main" @endif class="main">
        <!-- Exibe mensagem de sucesso se existir -->
        @if(session('success'))
            <div class="alert alert-success global-success-messages mx-auto mt-2">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>


    <a href="#" id="back-to-top" class="btn btn-primary">
        <i class="ph ph-arrow-up"></i>
    </a>

    <footer>
        @include('layouts/footer')
    </footer>

    </body>
</html>
