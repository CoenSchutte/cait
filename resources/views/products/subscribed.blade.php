@extends('layouts.app')

@section('content')

    <section class="pt-4 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">

                    <div class="col-xl-10 mx-auto">

                        <h1>Bedankt! Vanaf nu ben je lid van STIR</h1>
                        <span>Je lidmaatschap is geldig tot {{$user->member_until->translatedFormat('d F Y')}}</span>
                        <p>Je kunt nu gebruik maken van de volgende voordelen:</p>
                        <ul>
                            <li><strong>30%</strong> korting op alle betaalde evenementen</li>
                            <li><strong>10%</strong> korting op onze merchandise</li>
                            <li>Een <strong>gratis</strong> drankje bij elke borrel t.w.v. <strong>&euro;3.00</strong>
                            </li>
                            <li>Voorrang bij evenementen met beperkte beschikbare plaatsen</li>
                            <li>Stemrecht tijdens de ALV</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
