<nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="mx-auto d-lg-flex">
            <img class="logotipo" src="{{asset('assets/img/logotipo.png')}}" alt="Logotipo"></a>
        </div>

        @auth
            <div class="dropdown d-flex align-items-center">
                <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="user-name pe-2">{{ Auth::user()->name }}</span>
                        <img class="user pe-2" src="{{ asset('assets/img/user.png') }}" alt="User">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Configurações</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                Sair
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <div class="dropdown d-flex align-items-center">
                <a class="dropdown-toggle" href="#" role="button" id="guestDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="user pe-2" src="{{ asset('assets/img/user.png') }}" alt="User">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                    <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>
                </ul>
            </div>
        @endauth
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
            <div class="offcanvas-header">
                <img class="offcanvas-title logotipo-sidebar" id="offcanvasNavbarLightLabel" src="{{asset('assets/img/logotipo.png')}}">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
