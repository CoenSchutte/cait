@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto pt-md-5">
                    <h1 class="display-4">Wat kun je van CAIT verwachten?</h1>
                    <p class="lead">Een Vereniging van en door Studenten: Ontdek het Zelf!</p>
                    <!-- Info -->
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container position-relative">
            <div class="row">
                <!-- Main Content START -->
                <div class="col-lg-9 mx-auto">
                    <x-markdown>
                        {!! "Om te beginnen: **CAIT** is geen studentenvereniging. Dus geen ontgroening en andere fratsen.
Maar wat is het dan wel? Het is een vereniging van en door studenten,
met als doel het studieleven nog leuker te maken door studenten van verschillende CMI-opleidingen met elkaar in contact te brengen.
Dit gebeurt door het organiseren van allerlei activiteiten en borrels.
Maar je kunt ook lekker chillen, kletsen of een spelletje spelen in de eigen ruimte op de Wijnhaven.

**CAIT is een studievereniging in oprichting.** Dat betekent dat als er voldoende studenten interesse tonen en zich aanmelden, de studievereniging wordt opgericht. Een aantal studenten heeft zich al aangemeld als bestuurslid en zij staan te popelen om aan de slag te gaan. Ze hebben alleen nog jouw interesse nodig om lid te worden.

**Interesse?** Bij voldoende belangstelling wordt de vereniging in september of oktober opgericht en kun je echt lid worden. Dan wordt ook de contributie bepaald. Naar verwachting ongeveer €7,50 per jaar, inclusief een aantal consumptiemuntjes die je bij de borrels kunt gebruiken. Op de website kun je terecht voor meer vragen of opmerkingen.

Vind je **CAIT** niet alleen leuk, maar wil je ook organisatorisch een bijdrage leveren? Stuur dan een Teams berichtje naar Açelya Arslan of een mailtje naar <a href='mailto:acelya.arslan@caitrotterdam.nl'>acelya.arslan@caitrotterdam.nl</a>
" !!}
                    </x-markdown>

{{--                    <a class="btn btn-link" href="{{route('subscription.create')}}">Word nu lid voor &euro;7,50--}}
{{--                        per jaar!</a>--}}
                    <!-- Divider -->
                    <div class="text-center h5 mb-4">. . .</div>

                </div>
            </div>
        </div>
    </section>

@endsection
