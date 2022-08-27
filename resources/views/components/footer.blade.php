<footer class="pb-0">
    <div class="container">
        <hr>
        <!-- Widgets START -->
        <div class="row pt-5">
            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-4 mb-4">
                <img class="light-mode-item" src="{{ asset('images/logo-stir-zwart.png') }}" alt="logo">
                <img class="dark-mode-item" src="{{ asset('images/logo-stir-kleur.png') }}" alt="logo">
            </div>

            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4">Navigatie</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link pt-0" href="{{route('posts.index')}}">Activiteiten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('posts.vacatures')}}">Vacatures</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link pt-0" href="{{route('products.index')}}">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contact')}}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-2 mb-4">
                <h5 class="mb-4">Blijf op de hoogte</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link pt-0" href="https://discord.gg/Np6WEv46Bc">
                            <i class="fab fa-discord fa-fw me-2 text-facebook"></i>
                            Discord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://linkedin.com/company/stirotterdam">
                            <i class="fab fa-linkedin fa-fw me-2 text-linkedin"></i>
                            LinkedIn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://instagram.com/stirotterdam">
                            <i class="fab fa-instagram-square fa-fw me-2 text-instagram"></i>
                            Instagram
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://facebook.com/stirotterdam">
                            <i class="fab fa-facebook-square fa-fw me-2 text-facebook"></i>
                            Facebook
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
