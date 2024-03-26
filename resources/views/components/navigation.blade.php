<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu">
    <!-- Offcanvas header -->
    <div class="offcanvas-header justify-content-between border-bottom px-3">
        <h3 class="mb-0">Je winkelmandje</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Offcanvas body -->

    <div class="offcanvas-body d-flex flex-column px-3">
        @if(auth()->user())
            @foreach(\Cart::session(auth()->user()->id)->getContent() as $item)
                <div class="row g-3">
                    <!-- Image -->
                    <div class="col-3">
                        <img class="rounded-2 bg-light p-2" src="{{$item->attributes->image_url}}" alt="avatar">
                    </div>

                    <div class="col-6">
                        <h6 class="mb-1">{{$item->name}}</h6>
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 text-success">&euro;{{$item->price}}</h6>
                            <h6 class="mb-0">{{$item->attributes?->color}}</h6>
                            <h6 class="mb-0">{{$item->attributes?->size}}</h6>

                            <form action="{{route('products.remove-from-cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{$item->id}}">
                                <input type="hidden" name="product_id" value="{{$item->attributes->product_id}}">
                                <button type="submit" class="btn btn-sm btn-link">Verwijder</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- Button and price -->
            <div class="mt-auto">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="mb-0">Subtotaal</h6>
                    <h5 class="text-success mb-0">&euro;{{\Cart::session(auth()->user()->id)->getTotal()}}</h5>
                </div>
                <!-- Button -->
                <div class="d-grid">
                    <a href="{{route('products.checkout')}}" class="btn btn-lg btn-primary-soft mb-0">Afrekenen</a>
                </div>
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center flex-column">
                <h5 class="mb-3">Je bent niet ingelogd</h5>
                <a href="{{route('login')}}" class="btn btn-primary">Inloggen</a>
            </div>
        @endif

    </div>
</div>
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
                    @if(!auth()->check() || (auth()->check() && !auth()->user()->hasSubscription()))
                        <li class="nav-item">
                            <a @class([
                                'nav-link',
                                'active' => Request::is('membership*')
                            ]) href="{{route('membership')}}">Lid worden?
                            </a>
                        </li>
                    @endif

                    {{-- Activiteiten --}}
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Request::is('post*')
                            ]) href="{{route('post.index')}}">Activiteiten</a>
                    </li>


                    {{--                    --}}{{-- Commissies --}}
                    {{--                    <li class="nav-item dropdown">--}}
                    {{--                        <a class="nav-link dropdown-toggle" href="#" id="commissies-dropdown"--}}
                    {{--                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Commissies</a>--}}
                    {{--                        <ul class="dropdown-menu" aria-labelledby="commissies-dropdown">--}}
                    {{--                            <li><a class="dropdown-item" href="#">TEMP</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Request::is('products*')
                            ]) href="{{route('products.index')}}">Shop</a>
                    </li>


                    {{-- Vacatures --}}
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Request::is('vacatures*')
                            ]) href="{{route('post.vacatures')}}">Vacatures</a>
                    </li>

                    {{-- Over --}}
                    {{--                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">Over</a></li>--}}

                    {{--                    --}}{{-- Partners --}}
                    {{--                    <li class="nav-item"><a class="nav-link" href="dashboard.html">Partners</a></li>--}}

                    {{-- Contact --}}
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Request::is('contact*')
                            ]) href="{{route('contact')}}">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Request::is('partners*')
                            ]) href="{{route('partners')}}">Partners</a>
                    </li>

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
                    <div class="nav-item ms-2 ms-md-3 dropdown" style="margin-right: 16px">
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
                                <a class="dropdown-item" href="{{route('profile.show')}}"><i
                                        class="bi bi-cart-check fa-fw me-2"></i>Mijn bestellingen</a>
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

                <div class="nav-item ms-2 ms-md-3 position-relative">
                    <a class="nav-link btn btn-light btn-round mb-0" data-bs-toggle="offcanvas" href="#offcanvasMenu"
                       role="button" aria-controls="offcanvasMenu">
                        <i class="bi bi-cart3 fa-fw" data-bs-target="#offcanvasMenu"></i>
                    </a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge smaller rounded-circle bg-dark mt-xl-2 ms-n1">
                        @if(auth()->check())
                            {{ count(\Cart::session(auth()->user()->id)->getContent()) }}
                        @else
                            0
                        @endif
                        <span class="visually-hidden">unread messages</span>
					</span>
                </div>

            </div>
        </div>
    </nav>
</header>
