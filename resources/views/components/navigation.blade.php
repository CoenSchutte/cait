<header class="navbar-light navbar-sticky header-static">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img class="navbar-brand-item light-mode-item" src="../images/logo-stir-zwart.png" alt="logo">
                <img class="navbar-brand-item dark-mode-item" src="../images/logo-stir-kleur.png" alt="logo">
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="text-body h6 d-none d-sm-inline-block">Menu</span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll ms-auto">
                    {{-- Activiteiten --}}
                    <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}">Activiteiten</a></li>


                    {{--                    --}}{{-- Commissies --}}
                    {{--                    <li class="nav-item dropdown">--}}
                    {{--                        <a class="nav-link dropdown-toggle" href="#" id="commissies-dropdown"--}}
                    {{--                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Commissies</a>--}}
                    {{--                        <ul class="dropdown-menu" aria-labelledby="commissies-dropdown">--}}
                    {{--                            <li><a class="dropdown-item" href="#">TEMP</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                    <li class="nav-item"><a class="nav-link" href="{{route('products.index')}}">Shop</a></li>


                    {{-- Vacatures --}}
                    <li class="nav-item"><a class="nav-link" href="{{route('posts.vacatures')}}">Vacatures</a></li>

                    {{-- Over --}}
                    {{--                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">Over</a></li>--}}

                    {{--                    --}}{{-- Partners --}}
                    {{--                    <li class="nav-item"><a class="nav-link" href="dashboard.html">Partners</a></li>--}}

                    {{-- Contact --}}
                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>

                    @auth
                        <li class="nav-item d-lg-none">
                            <a href="{{ route('profile.show') }}" class="nav-link">Instellingen</a>
                        </li>
                    @else
                        <li class="nav-item d-lg-none">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a href="{{ route('register') }}" class="nav-link">Word lid</a>
                        </li>
                    @endauth
                </ul>
            </div>

            {{-- Dark/Light switch --}}
            <div class="nav ms-sm-3 flex-nowrap align-items-center">
                <div class="nav-item">
                    <div class="modeswitch" id="darkModeSwitch">
                        <div class="switch"></div>
                    </div>
                </div>

                @auth
                    <div class="nav-item ms-2 ms-md-3 dropdown">
                        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
                           data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <img class="avatar-img rounded-circle" src="{{ asset('images/avatar/default.png') }}"
                                 alt="avatar"/>
                        </a>

                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                            aria-labelledby="profileDropdown">
                            <li class="px-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <img class="avatar-img rounded-circle shadow"
                                             src="{{ asset('images/avatar/default.png') }}" alt="avatar"/>
                                    </div>
                                    <div>
                                        <a class="h6 mt-2 mt-sm-0" href="#">{{ auth()->user()->name }}</a>
                                        <p class="small m-0"></p>
                                    </div>
                                </div>
                                <hr class="my-3"/>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('profile.show')}}"><i
                                        class="bi bi-person fa-fw me-2"></i>Profiel</a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Settings</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li>--}}
                            {{--                                <a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a>--}}
                            {{--                            </li>--}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <button type="submit" class="dropdown-item"><i class="bi bi-power fa-fw me-2"></i>Uitloggen
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="nav-item d-none d-lg-block">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary mb-0 mx-2">Log in</a>
                    </div>
                    <div class="nav-item d-none d-lg-block">
                        <a href="{{ route('register') }}" class="btn btn-sm btn-success mb-0 mx-2">Meld je aan</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
