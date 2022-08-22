@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="row g-4 g-lg-0 justify-content-between">
                <!-- Image -->
                <div class="col-lg-5">
                    <div class="row g-2">
                        @foreach($product->urls as $img)

                            @if($loop->first)
                                <div class="col-12">
                                    <div class="bg-light rounded-2 glightbox-bg p-4 position-relative">
                                        <a href="{{$img}}" class="stretched-link cursor-zoom" data-glightbox
                                           data-gallery="image-popup">
                                            <img src="{{$img}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-6">
                                    <div class="bg-light rounded-2 glightbox-bg p-4 position-relative">
                                        <a href="{{$img}}" class="stretched-link cursor-zoom" data-glightbox
                                           data-gallery="image-popup">
                                            <img src="{{$img}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>

                <!-- Detail -->
                <div class="col-lg-6">
                    <!-- Title -->
                    <h1>{{$product->name}}</h1>
                    <p class="mb-4">
                        <x-markdown>
                            {!! $product->description !!}
                        </x-markdown>
                    </p>


                    <form method="POST" action="{{route('products.buy')}}">
                        @csrf

                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <!-- Variant START -->
                        @if(isset($product->options['colors']))
                            <div class="mb-4">
                                <span>Kies kleur</span>
                                <ul class="list-inline mt-2">
                                    @foreach($product->options['colors'] as $option)
                                        <li class="list-inline-item">
                                            @if(!isset($product->urls[$loop->index]))
                                                @break
                                            @endif
                                            <input type="radio" class="btn-check" name="color"
                                                   id="option-{{$option}}" value="{{$option}}">
                                            <label class="btn btn-primary-soft-check" for="option-{{$option}}">
                                                <img
                                                    src="{{ isset($product->urls[$loop->index]) ? $product->urls[$loop->index] : ''}}"
                                                    class="w-60" alt="">

                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(isset($product->options['colors']))
                            <div class="mb-4">
                                <span>Kies maat</span>
                                <select class="form-select" name="size">
                                    @foreach($product->options['sizes'] as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Variant END -->

                        <!-- Price and button START -->
                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-4">
                                <h6 class="mb-0">Prijs</h6>
                                <h4 class="text-success">&nbsp;&euro;
                                    @if(Auth::check())
                                        {{$product->member_price}}
                                    @else
                                        {{$product->normal_price}}
                                    @endif

                                </h4>
                            </div>
                            <!-- Select -->
                            <div class="col-md-2 pe-md-0 mb-2">
                                <select class="form-select" name="amount" aria-label="Default select example">
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                </select>
                            </div>
                            <!-- Button -->
                            <div class="col-md-6">
                                @auth()
                                    <input type="submit" value="Koop" class="btn btn-primary mb-0 w-100"></input>
                                @else
                                    <a href="{{route('login')}}" class="btn btn-primary mb-0 w-100">Log in</a>
                                @endauth
                            </div>
                        </div>
                    </form>
                    <!-- Price and button END -->
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
    Main END -->

    <!-- =======================
    Description START -->
    <section class="pt-0 pt-lg-5">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <!-- Description -->
                <div class="col-lg-7">
                    <h5>Omschrijving</h5>
                    <x-markdown>
                        {!! $product->description !!}
                    </x-markdown>
                </div>

                <!-- List START -->
                <div class="col-lg-4">
                    <h5>Bezorg informatie</h5>
                    <ul class="list-group list-group-borderless">
                        <li class="list-group-item pb-0">
                            <span>Bezorgen:</span>
                            <span class="h6 mb-0">Verwacht tussen {{ucwords(now()->addDays(4)->translatedFormat('d F'))  }} en {{ ucwords(now()->addDays(12)->translatedFormat('d F'))   }}</span>
                        </li>
                    </ul>

                </div>
                <!-- List END -->
            </div>
        </div>
    </section>
    <!-- =======================
    Description END -->


    <!-- =======================
    Related Products START -->
    <section class="pt-0 pt-md-5">
        <div class="container">
            <!-- Title -->
            <div class="mb-4">
                <h2 class="mb-0">Gerelateerde producten</h2>
            </div>

            <div class="row g-4">
                <!-- Slider item START -->
                <div class="col-md-12">
                    <div class="tiny-slider arrow-hover arrow-dark arrow-blur arrow-round">
                        <div class="tiny-slider-inner"
                             data-autoplay="false"
                             data-hoverpause="true"
                             data-gutter="24"
                             data-edge="2"
                             data-arrow="true"
                             data-dots="false"
                             data-items-xl="4"
                             data-items-lg="3"
                             data-items-md="2"
                             data-items-xs="1"
                        >

                            <!-- Slider item START -->
                            <div>
                                <div class="card border p-3 h-100">
                                    <div class="position-relative">
                                        <!-- Image -->
                                        <a href="shop-detail.html" class="position-relative z-index-9"><img
                                                class="card-img" src="assets/images/shop/02.png" alt=""></a>
                                        <!-- Overlay -->
                                        <div class="card-img-overlay p-0">
                                            <span class="badge text-bg-success">New Arrival</span>
                                        </div>
                                    </div>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Badge and price -->
                                        <div class="d-flex justify-content-center mb-2">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star-half-alt text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="shop-detail.html">Osprey Packs Backpack</a></h5>
                                        <h6 class="mb-0 text-success">$103.00</h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider item END -->

                            <!-- Slider item START -->
                            <div>
                                <div class="card border p-3 h-100">
                                    <!-- Image -->
                                    <a href="shop-detail.html"><img class="card-img" src="assets/images/shop/04.png"
                                                                    alt=""></a>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Badge and price -->
                                        <div class="d-flex justify-content-center mb-2">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star-half-alt text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="shop-detail.html">Men's Watertight Jacket</a>
                                        </h5>
                                        <h6 class="mb-0 text-success">$98.00</h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider item END -->

                            <!-- Slider item START -->
                            <div>
                                <div class="card border p-3 h-100">
                                    <!-- Image -->
                                    <a href="shop-detail.html"><img class="card-img" src="assets/images/shop/08.png"
                                                                    alt=""></a>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Badge and price -->
                                        <div class="d-flex justify-content-center mb-2">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star-half-alt text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="shop-detail.html">Hiking Pants</a></h5>
                                        <h6 class="mb-0 text-success">$105.00</h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider item END -->

                            <!-- Slider item START -->
                            <div>
                                <div class="card border p-3 h-100">
                                    <!-- Image -->
                                    <a href="shop-detail.html"><img class="card-img" src="assets/images/shop/06.png"
                                                                    alt=""></a>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Badge and price -->
                                        <div class="d-flex justify-content-center mb-2">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star-half-alt text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="shop-detail.html">Classic Boat Shoes</a></h5>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h6 class="text-success mb-0 me-2">$75.00</h6>
                                            <small class="text-decoration-line-through">$95.00</small>
                                        </div>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider item END -->

                            <!-- Slider item START -->
                            <div>
                                <div class="card border p-3 h-100">
                                    <!-- Image -->
                                    <a href="shop-detail.html"><img class="card-img" src="assets/images/shop/07.png"
                                                                    alt=""></a>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Badge and price -->
                                        <div class="d-flex justify-content-center mb-2">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fas fa-star-half-alt text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="shop-detail.html">Backpacking Stove</a></h5>
                                        <h6 class="mb-0 text-success">$81.00</h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider item END -->
                        </div>
                    </div>
                </div>
                <!-- Slider item END -->
            </div>
        </div>
    </section>

    <script type="text/javascript">
        const lightbox = GLightbox({
            selector: 'glightbox1',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            onOpen: () => {
                console.log('Lightbox opened')
            },
            beforeSlideLoad: (slide, data) => {
                // Need to execute a script in the slide?
                // You can do that here...
            }
        });
    </script>
@endsection
