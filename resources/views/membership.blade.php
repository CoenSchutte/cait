@extends('layouts.app')


@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto pt-md-5">
                    <a href="#" class="badge text-bg-{{strtolower("category")}} mb-2"><i
                            class="fas fa-circle me-2 small fw-bold"></i>category</a>
                    <h1 class="display-4">Verrijk je Studentenleven met STIR!</h1>
                    <p class="lead">Leren, Netwerken en Plezier: Ervaar het Allemaal als Lid van STIR!</p>
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
                        {!! "Zoek je naar een manier om jouw studentenleven te verrijken, zowel op educatief als sociaal gebied? **STIR** is het antwoord! En het beste? Onze leden krijgen toegang tot een scala aan exclusieve voordelen!

**Waarom lid worden van STIR? Hier een voorproefje van wat je als lid kunt verwachten:**

1. **Exclusieve Kortingen**: Geniet van 15% korting op alle betaalde evenementen en 10% korting op onze populaire merchandise. Jouw lidmaatschap betaalt zichzelf terug!
2. **Gratis Drankjes**: Niets zegt 'welkom' zoals een gratis drankje. Bij elke borrel krijg je een gratis drankje ter waarde van €3,00. Proost op het studentenleven!
3. **Voorrang bij Evenementen**: Bang dat je je plek mist bij populaire evenementen? Geen zorgen! Onze leden krijgen voorrang bij evenementen met beperkte beschikbare plaatsen.
4. **Stemrecht tijdens de ALV**: Jouw mening telt! Als lid van STIR heb je stemrecht tijdens de Algemene Ledenvergadering. Maak deel uit van de beslissingen die de toekomst van onze vereniging vormgeven.

... en dit komt bovenop onze geweldige kalender vol met lezingen, workshops, borrels, netwerkdiners, LAN parties en spareribsavonden!

#### Educatieve Activiteiten
Of je nu je kennis wilt verdiepen of nieuwe vaardigheden wilt ontdekken, onze maandelijkse lezingen, workshops en andere educatieve evenementen zijn speciaal ontworpen om je verder te helpen. Dat zijn maar liefst 9 boeiende bijeenkomsten per jaar!

#### Sociale Borrels
Niets overtreft de klassieke studentenborrel. Vier keer per jaar organiseren we gezellige borrels waar je kunt relaxen, lachen en onvergetelijke momenten kunt beleven met medestudenten.

#### Netwerkdiner
Maak kennis met alumni, professionals en interessante bedrijven uit jouw vakgebied tijdens ons exclusieve netwerkdiner. Een gouden kans om je netwerk uit te breiden en te leren van de besten!

#### LAN Parties
Voor de gamers onder ons: twee keer per jaar verandert STIR in een gamingwalhalla met onze legendarische LAN parties. Of je nu een casual gamer bent of een doorgewinterde pro, het belooft elke keer weer een epische avond te worden.

#### Spareribsavond
Niets verenigt mensen zoals goed eten. Kom vier keer per jaar langs en geniet van heerlijke spareribs met medestudenten. Smullen gegarandeerd!

<br>

## Overtuigd?
Lid zijn van **STIR** is meer dan alleen het bijwonen van evenementen. Het is een ervaring, een gemeenschap en een kans om te groeien, te leren en onvergetelijke herinneringen te maken.

**Dus, ben je klaar om de volgende stap in jouw studentenleven te zetten?** Sluit je aan bij STIR en ontdek een wereld van mogelijkheden, voordelen en plezier!

Meld je vandaag nog aan en geniet van de voordelen die het **STIR**-lidmaatschap biedt! 🌟
" !!}
                    </x-markdown>
                    <a class="btn btn-link" href="{{route('subscription.create')}}">Word nu lid voor &euro;30
                        per jaar!</a>
                    <!-- Divider -->
                    <div class="text-center h5 mb-4">. . .</div>


                </div>
            </div>
        </div>
    </section>


@endsection
