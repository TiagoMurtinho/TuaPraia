<nav class="navbar bg-body-tertiary custom-navbar" aria-label="Light offcanvas navbar">
    <div class="container-fluid position-relative">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="logotipo-container">
            <img class="logotipo" src="{{ asset('assets/img/logotipo.png') }}" alt="Logotipo">
        </div>

        <div class="d-flex align-items-center">
            @auth
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            @php
                                $mediaUrl = Auth::user()->getFirstMediaUrl('users');
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle navbar-user-image">
                            @else
                                <img src="{{ $user->avatar_url }}" alt="Avatar de {{ $user->name }}" class="img-fluid rounded-circle navbar-user-image">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.index', ['id' => $authUser->id]) }}">
                                {{ __('nav.profile') }}
                            </a></li>
                        <li><a class="dropdown-item" href="#">{{__('nav.config')}}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{__('nav.exit')}}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="guestDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ph ph-user-circle user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">{{__('nav.sign_in')}}</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">{{__('nav.sign_up')}}</a></li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
    <div class="offcanvas offcanvas-start offcanvas-body-bg" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
        <div class="offcanvas-header">
            <img class="offcanvas-title logotipo-sidebar" id="offcanvasNavbarLightLabel" src="{{ asset('assets/img/logotipo.png') }}">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">{{__('nav.home')}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('nav.locals') }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($regions as $region)
                            <li class="dropdown-submenu position-relative">
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('regions.show', $region->id) }}" role="button" aria-expanded="false">
                                    {{ $region->name }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                        <path d="M8 10.793l-5.531-5.531a.75.75 0 0 1 1.061-1.06L8 8.707l4.47-4.47a.75.75 0 0 1 1.06 1.06L8.707 10.5a.75.75 0 0 1-1.414 0L2.47 5.293a.75.75 0 0 1 0-1.06L8 10.793z"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($region->districts as $district)
                                        <li><a class="dropdown-item" href="{{ route('districts.show', ['district' => $district->id]) }}">{{ $district->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    @if(auth()->check() && auth()->user()->hasRole('admin'))
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('nav.actions')}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('attributes.index')}}">{{__('nav.attributes')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('regions.index')}}">{{__('nav.regions')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('districts.index')}}">{{__('nav.districts')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('locals.index')}}">{{__('nav.locals')}}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    @endif
                </li>
            </ul>
            <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="{{__('nav.search')}}" aria-label="Search">
                <button class="btn btn-outline-success custom-btn-sucess" type="submit">
                    <i class="ph ph-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    @include('auth.login')
    @include('auth.register')
</nav>
