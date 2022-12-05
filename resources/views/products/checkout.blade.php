@extends('layouts.app')

@section('content')
    <section class="pt-3 pt-lg-5">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <!-- Left side START -->
                <div class="col-lg-8">
                    <div class="vstack gap-3">

                        <!-- Your Order START -->
                        <div class="card bg-transparent">
                            <!-- Card header -->
                            <div class="card-header px-0 pb-3">
                                <h4 class="card-title mb-0">Je bestelling</h4>
                            </div>

                            @foreach($cartItems as $cartItem)
                                <!-- Card body -->
                                <div class="card-body p-0">
                                    <!-- Product item START -->
                                    <div class="bg-light px-4 py-2 rounded-2 mb-3">
                                        <div class="row align-items-center">
                                            <!-- Product detail -->
                                            <div class="col-md-9">
                                                <div class="d-sm-flex align-items-center">
                                                    <div class="d-flex align-items-center mb-2 mb-sm-0">
                                                        <!-- Image -->
                                                        <img src="{{$cartItem->attributes->image_url}}" class="w-90"
                                                             alt="">
                                                    </div>
                                                    <!-- Title and list -->
                                                    <div style="margin-left: 1rem">
                                                        <h5 class="mb-1"><a
                                                                href="{{route('products.show', $cartItem->attributes->product_id)}}">{{$cartItem->name}}</a>
                                                        </h5>
                                                        <ul class="nav nav-divider small align-items-center">
                                                            <li class="nav-item">
                                                                &euro;{{$cartItem->price}}</li>
                                                            @if($cartItem->attributes->color)
                                                                <li class="nav-item">
                                                                    Kleur: {{$cartItem->attributes->color}}</li>
                                                            @endif
                                                            @if($cartItem->attributes->size)
                                                                <li class="nav-item">
                                                                    Maat: {{$cartItem->attributes->size}}</li>
                                                            @endif
                                                            @if($cartItem->attributes->voor)
                                                                <li class="nav-item">
                                                                    Voorgerecht: {{$cartItem->attributes->voor}}</li>
                                                                <li class="nav-item">
                                                                    Hoofdgerecht: {{$cartItem->attributes->hoofd}}</li>
                                                                <li class="nav-item">
                                                                    Desert: {{$cartItem->attributes->na}}</li>
                                                                <li class="nav-item">
                                                                    Dieetwensen: {{$cartItem->attributes->dieet}}</li>

                                                            @endif

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="col-md-3 text-end">
                                                <form action="{{route('products.remove-from-cart', $cartItem->id)}}"
                                                      method="POST">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{$cartItem->id}}">
                                                    <input type="hidden" name="product_id"
                                                           value="{{$cartItem->attributes->product_id}}">
                                                    <button type="submit" class="btn btn-link mb-0">
                                                        Verwijder
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Your Order END -->

                            <hr> <!-- Divider -->

                            <!-- Delivery Options START -->
                            <div class="card bg-transparent">
                                <!-- Card header -->
                                <div class="card-header px-0 pb-3">
                                    <h4 class="card-title mb-0">Bezorg opties</h4>
                                </div>

                                <!-- Card body -->
                                <div class="card-body p-0">
                                    <div class="row g-3 g-sm-4">
                                        <!-- Delivery option -->
                                        @if(!$hasMerch)
                                            <div class="col-sm-6">
                                                <div class="bg-light rounded-2 p-3">
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio"
                                                               name="discountOptions"
                                                               id="delivery1" value="option1" checked="">
                                                        <label class="form-check-label h5 mb-0" for="delivery1">Gratis
                                                        </label>
                                                        <p class="mb-1 small">Er wordt een ticket aan je account
                                                            toegevoegd</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Delivery option -->
                                        @if($hasMerch)
                                            <div class="col-sm-6">
                                                <div class="bg-light rounded-2 p-3">
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input" type="radio"
                                                               name="discountOptions"
                                                               id="delivery2" value="option2" checked>
                                                        <label class="form-check-label h5 mb-0" for="delivery2">&euro;6.50
                                                            -
                                                            Ophalen in het TI-lab</label>
                                                        <p class="mb-1 small">Het kan tussen 4 en 12 dagen duren voordat
                                                            je de producten kan ophalen.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Delivery Options END -->

                        </div>
                    </div>
                </div>
                <!-- Left side END -->

                <!-- Right Side START -->
                <div class="col-lg-4">
                    <!-- Coupon code START -->
                    {{--                    <div class="mb-4">--}}
                    {{--                        <h5 class="mb-2">Enter Coupon Code</h5>--}}
                    {{--                        <!-- Input group -->--}}
                    {{--                        <div class="input-group">--}}
                    {{--                            <input class="form-control form-control" placeholder="Coupon code">--}}
                    {{--                            <button type="button" class="btn btn-dark">Apply</button>--}}
                    {{--                        </div>--}}
                    {{--                        <small>20% Off Discount</small>--}}
                    {{--                    </div>--}}
                    <!-- Coupon code END -->

                    <!-- Order summary START -->
                    <div class="card bg-light border border-secondary border-opacity-25 rounded-2 p-4">
                        <!-- card header -->
                        <div class="card-header bg-light p-0 pb-3">
                            <h5 class="card-title mb-0">Bestelling</h5>
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-0 pb-3">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Subtotaal</span>
                                    <span class="h6 mb-0">&euro;{{\Cart::getTotal()}}</span>
                                </li>
                                @if($hasMerch)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Bezorgkosten</span>
                                        <span class="h6 mb-0">&euro;6.50</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer bg-light border-top p-0 pt-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Totaal</span>
                                <span class="h5 mb-0">
                                    @if($hasMerch)
                                        &euro;{{number_format(\Cart::getTotal() + 6.50,2)}}
                                    @else
                                        &euro;{{number_format(\Cart::getTotal(), 2)}}
                                    @endif
                                </span>
                            </div>

                            <!-- Button -->
                            <form class="d-grid" action="{{route("products.buy")}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-0">Plaats bestelling</button>
                            </form>
                        </div>
                    </div>
                    <!-- Order summary END -->
                    {{--                    <p class="small mb-0 text-center mt-2">By completing your purchase, you agree to these <a--}}
                    {{--                            href="#">Terms of Service</a></p>--}}
                </div>
                <!-- Right Side END -->

            </div>
        </div>
    </section>
@endsection
