@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Online betalen is op dit moment niet mogelijk</h4>
                <p>Mocht je lid willen worden of iets uit de webshop aan willen schaffen, neem dan contact op met een STIR bestuurslid.</p>
                <hr>
            </div>
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

                                            @if($loop->first)
                                                <input type="radio" class="btn-check" name="color"
                                                       id="option-{{$option}}" value="{{$option}}" required>
                                            @else
                                                <input type="radio" class="btn-check" name="color"
                                                       id="option-{{$option}}" value="{{$option}}">
                                            @endif
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
                                    {{number_format($product->getPrice(), 2, '.', '.')}}</h4>

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
                                    <input type="submit" value="Koop" class="btn btn-primary mb-0 w-100" disabled></input>
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
