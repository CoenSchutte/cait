@extends('layouts.app')

@section('content')

    {{--    <section class="pt-3 pt-lg-5">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    <section class="pt-4 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    @if($invoice->status == "Betaald")
                        <div class="col-xl-10 mx-auto">
                            <h1>Bedankt! Je bestelling is geplaatst!</h1>
                            <p>We hebben je bestelling ontvangen en zullen zo spoedig mogelijk contact met je
                                opnemen.
                                @if($invoice->category == 'merch')
                                    <br>
                                    Zodra je bestelling verwerkt is kun je deze komen ophalen in het TI-Lab op de eerste
                                    verdieping.
                                @endif</p>
                            <p>
                                Je bestelling bestaat uit:

                            <p>
                                &euro;{{$invoice->price . ' | ' . $invoice->product}}
                            </p>
                        </div>
                        @else
                            <div class="col-xl-10 mx-auto">
                                <h1>Je bestelling is (nog) niet geplaatst :(</h1>
                                <p>Er is iets misgegaan met het verwerken van je bestelling. Het kan zijn dat de betaling nog niet is doorgekomen of dat je de transactie vroegtijdig afgebroken hebt.</p>
                                <p>Probeer het nog eens of neem contact met ons op :)</p>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
