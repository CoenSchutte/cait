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
                                                        <!-- Check box -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                   id="productCheck" checked>
                                                        </div>
                                                        <!-- Image -->
                                                        <img src="{{$cartItem->attributes->image_url}}" class="w-90"
                                                             alt="">
                                                    </div>
                                                    <!-- Title and list -->
                                                    <div style="margin-left: 1rem">
                                                        <h5 class="mb-1"><a href="#">{{$cartItem->name}}</a></h5>
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

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="col-md-3 text-end">
                                                <a href="{{route('products.show', $cartItem->attributes->product_id)}}"
                                                   class="btn btn-link mb-0">Bekijk product</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Your Order END -->

                            <hr> <!-- Divider -->

                            <!-- Billing address START -->
                            <div class="card bg-transparent">
                                <!-- Card header -->
                                <div class="card-header px-0 pb-3">
                                    <h4 class="card-title mb-0">Billing Address</h4>
                                </div>

                                <!-- Card body -->
                                <div class="card-body p-0">
                                    <!-- Alert -->
                                    <div
                                        class="alert alert-warning alert-dismissible d-flex justify-content-between align-items-center fade show py-3 pe-2"
                                        role="alert">
                                        <div>
                                            <i class="bi bi-exclamation-octagon-fill me-2"></i>
                                            Already have an account? <a href="#"
                                                                        class="text-reset btn-link mb-0 fw-bold">Log
                                                in</a></div>
                                        <button type="button" class="btn text-end border-0 p-0 mb-0"
                                                data-bs-dismiss="alert" aria-label="Close"><i
                                                class="bi bi-x-lg text-dark"></i></button>
                                    </div>

                                    <form class="row g-3">
                                        <!-- First name -->
                                        <div class="col-md-6">
                                            <label class="form-label">First name *</label>
                                            <input type="text" class="form-control" aria-label="First name">
                                        </div>

                                        <!-- Last name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Last name *</label>
                                            <input type="text" class="form-control" aria-label="Last name">
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label">Email *</label>
                                            <input type="email" class="form-control">
                                        </div>

                                        <!-- Mobile number -->
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile number *</label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <!-- Address -->
                                        <div class="col-12">
                                            <label class="form-label">Address *</label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <!-- Address 2 -->
                                        <div class="col-12">
                                            <label class="form-label">Address 2 (Optional)</label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-4">
                                            <label class="form-label">Country *</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">UK</option>
                                                <option value="2">USA</option>
                                                <option value="3">India</option>
                                            </select>
                                        </div>

                                        <!-- State -->
                                        <div class="col-md-4">
                                            <label class="form-label">State *</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">New York</option>
                                                <option value="2">California</option>
                                                <option value="3">Mumbai</option>
                                                <option value="3">Peru</option>
                                            </select>
                                        </div>

                                        <!-- Zip -->
                                        <div class="col-md-4">
                                            <label class="form-label">Zip *</label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <!-- custom checkbox -->
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">The shipping
                                                    address is the same as my billing address </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault2">
                                                <label class="form-check-label" for="flexCheckDefault2">Save this
                                                    information for next time </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label me-2">Your saved cards *</label>
                                            <a href="#"><img src="../images/icon/visa.svg" class="w-40 me-2" alt=""></a>
                                            <a href="#"><img src="../images/icon/mastercard.svg" class="w-40 me-2"
                                                             alt=""></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Billing address END -->

                            <hr> <!-- Divider -->

                            <!-- Delivery Options START -->
                            <div class="card bg-transparent">
                                <!-- Card header -->
                                <div class="card-header px-0 pb-3">
                                    <h4 class="card-title mb-0">Delivery Options</h4>
                                </div>

                                <!-- Card body -->
                                <div class="card-body p-0">
                                    <div class="row g-3 g-sm-4">
                                        <!-- Delivery option -->
                                        <div class="col-sm-6">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="radio" name="discountOptions"
                                                           id="delivery1" value="option1" checked="">
                                                    <label class="form-check-label h5 mb-0" for="delivery1">Free -
                                                        Standard Delivery</label>
                                                    <p class="mb-1 small">Shipment may take 5-6 business days</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delivery option -->
                                        <div class="col-sm-6">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="radio" name="discountOptions"
                                                           id="delivery2" value="option2">
                                                    <label class="form-check-label h5 mb-0" for="delivery2">$5.20 -
                                                        Express delivery</label>
                                                    <p class="mb-1 small">Shipment may take 2-3 business days</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delivery Options END -->

                            <hr> <!-- Divider -->

                            <!-- Payment Options START -->
                            <div class="card bg-transparent">
                                <!-- Card header -->
                                <div class="card-header px-0 pb-3">
                                    <h4 class="card-title mb-0">Payment Options</h4>
                                </div>

                                <!-- Card body -->
                                <div class="card-body bg-light rounded-2 p-4">
                                    <!-- Form START -->
                                    <form class="row g-3">
                                        <!-- Payment option -->
                                        <div class="col-12">
                                            <label class="form-label">Select payment options *</label>
                                            <div class="hstack gap-2 gap-sm-4 flex-wrap">
                                                <div class="form-check radio-bg-light">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault1" checked="">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Credit card
                                                    </label>
                                                </div>
                                                <div class="form-check radio-bg-light">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Debit card
                                                    </label>
                                                </div>
                                                <div class="form-check radio-bg-light">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault3">
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        PayPal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card number -->
                                        <div class="col-12">
                                            <label class="form-label">Card Number <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                       placeholder="xxxx xxxx xxxx xxxx">
                                                <img src="assets/images/icon/visa.svg"
                                                     class="w-30 position-absolute top-50 end-0 translate-middle-y me-2 d-none d-sm-block"
                                                     alt="">
                                            </div>
                                        </div>
                                        <!-- Expiration Date -->
                                        <div class="col-md-6">
                                            <label class="form-label">Expiration date <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" maxlength="2"
                                                       placeholder="Month">
                                                <input type="text" class="form-control" maxlength="4"
                                                       placeholder="Year">
                                            </div>
                                        </div>
                                        <!--Cvv code  -->
                                        <div class="col-md-6">
                                            <label class="form-label">CVV / CVC <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="3" placeholder="xxx">
                                        </div>
                                        <!-- Card name -->
                                        <div class="col-12">
                                            <label class="form-label">Name on Card <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" aria-label="name of card holder"
                                                   placeholder="Enter card holder name">
                                        </div>
                                    </form>
                                    <!-- Form END -->
                                </div>
                            </div>
                            <!-- Payment Options END -->

                        </div>
                    </div>
                </div>
                <!-- Left side END -->

                <!-- Right Side START -->
                <div class="col-lg-4">
                    <!-- Coupon code START -->
                    <div class="mb-4">
                        <h5 class="mb-2">Enter Coupon Code</h5>
                        <!-- Input group -->
                        <div class="input-group">
                            <input class="form-control form-control" placeholder="Coupon code">
                            <button type="button" class="btn btn-dark">Apply</button>
                        </div>
                        <small>20% Off Discount</small>
                    </div>
                    <!-- Coupon code END -->

                    <!-- Order summary START -->
                    <div class="card bg-light border border-secondary border-opacity-25 rounded-2 p-4">
                        <!-- card header -->
                        <div class="card-header bg-light p-0 pb-3">
                            <h5 class="card-title mb-0">Order Summary</h5>
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-0 pb-3">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Subtotal</span>
                                    <span class="h6 mb-0">$260.54</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Service Charge</span>
                                    <span class="h6 mb-0">-$50</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tax</span>
                                    <span class="h6 mb-0">$10</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer bg-light border-top p-0 pt-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Payable Now</span>
                                <span class="h5 mb-0">$210.54</span>
                            </div>

                            <!-- Button -->
                            <div class="d-grid"><a href="#" class="btn btn-primary mb-0">Place Order</a></div>
                        </div>
                    </div>
                    <!-- Order summary END -->
                    <p class="small mb-0 text-center mt-2">By completing your purchase, you agree to these <a
                            href="#">Terms of Service</a></p>
                </div>
                <!-- Right Side END -->

            </div>
        </div>
    </section>
@endsection
