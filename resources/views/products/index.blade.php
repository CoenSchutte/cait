@extends('layouts.app')

@section('content')

    <section class="pt-3 pt-lg-5">
        <div class="container">
            <div class="row">
                @if(($user && !$user->hasSubscription()))
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Je bent nog geen lid :(</h4>
                        <p>Je loopt nu een aantal voordelen mis. Zo krijg je als lid</p>
                        <ul>
                            <li><strong>15%</strong> korting op alle betaalde evenementen</li>
                            <li><strong>10%</strong> korting op onze merchandise</li>
                            <li>Een <strong>gratis</strong> drankje bij elke borrel t.w.v. <strong>&euro;3.00</strong>
                            </li>
                            <li>Voorrang bij evenementen met beperkte beschikbare plaatsen</li>
                            <li>Stemrecht tijdens de ALV</li>
                        </ul>
                        <hr>
                        <a class="btn btn-link" href="{{route('subscription.create')}}">Word nu lid voor &euro;30
                            per jaar!</a>
                    </div>
                @elseif(!$user)
                    <div class="col-12">
                        <div class="alert alert-info">
                            <h4 style="color: var(--bs-alert-color)">Let op:</h4>
                            <p>Je bent op dit moment niet ingelogd. Log in om gebruik te maken van ledenkorting.</p>
                        </div>
                    </div>

                @endif

                @if(session()->has('success'))

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Succes!</h4>
                    <p>{{session()->get('success')}}</p>
                    <hr>
                </div>
                    @endif

                <div class="mb-4">
                    <h2 class="m-0">STIR Shop</h2>
                </div>

                <!-- Main part START -->
                <div class="col-xl-10 mx-auto">
                    <!-- Product START -->
                    <div class="row">
                        <section class="p-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{$ad?->company_url}}" class="d-block card-img-flash">
                                            <img src="{{$ad?->image_url}}" alt="">
                                        </a>
                                        <small class="text-end d-block mt-1">Advertentie</small>
                                    </div>
                                </div>
                            </div>
                        </section>

                        @foreach($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="card border p-3 h-100">
                                    <div class="position-relative">
                                        <!-- Image -->
                                        <a href="{{route('products.show', $product)}}"
                                           class="position-relative z-index-9"><img
                                                class="card-img" src="{{$product->image_url}}" alt=""></a>
                                        <!-- Overlay -->
                                        @if($product->created_at > now()->addWeeks(2))
                                            <div class="card-img-overlay p-0">
                                                <div><span class="badge text-bg-success">New Arrival</span></div>
                                            </div>
                                        @endif

                                    </div>

                                    <!-- Card body -->
                                    <div class="card-body text-center p-3 px-0">
                                        <!-- Title -->
                                        <h5 class="card-title"><a
                                                href="{{route('products.show', $product)}}">{{$product->name}}</a></h5>
                                        <h6 class="mb-0 text-success">&euro;{{number_format($product->getPrice(),2)}}</h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer text-center p-0">
                                        <!-- Button -->
                                        <a href="{{route('products.show', $product)}}"
                                           class="btn btn-sm btn-primary-soft mb-0"><i
                                                class="bi bi-cart me-2"></i>Meer info</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination START -->
                        <div class="col-12">
                            <div style="display: flex; justify-content: center;">
                                {{ $products->links() }}
                            </div>
                        </div>
                        <!-- Pagination END -->
                    </div>
                    <!-- Product END -->

                </div>
                <!-- Main part END -->
            </div>
        </div>
    </section>
@endsection
