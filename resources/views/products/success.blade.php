@extends('layouts.app')

@section('content')

    {{--    <section class="pt-3 pt-lg-5">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    <section class="pt-4 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">

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
                </div>
            </div>
        </div>
    </section>
@endsection
