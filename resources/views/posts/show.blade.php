@extends('layouts.app')


@section('content')
    <meta property="og:url" content="' . $request_url . '">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<Title>">
    <meta property="og:description" content="<Description>">
    <meta property="og:image" content="{{$post->getUrlPreviewAttribute}}">

    <meta name="twitter:card" content="summary">
    <meta property="twitter:domain" content="' . $request_url . '">
    <meta property="twitter:url" content="' . $request_url . '">
    <meta name="twitter:title" content="<Title>">
    <meta name="twitter:description" content="<Description>">
    <meta name="twitter:image" content="{{$post->getUrlPreviewAttribute}}">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto pt-md-5">
                    <a href="#" class="badge text-bg-{{strtolower($post->category)}} mb-2"><i
                            class="fas fa-circle me-2 small fw-bold"></i>{{$post->category}}</a>
                    <h1 class="display-4">{{$post->title}}</h1>
                    <p class="lead">{{$post->subtitle}} </p>
                    <!-- Info -->
                    <ul class="nav nav-divider align-items-center">
                        <li class="nav-item">
                            <div class="nav-link">
                                door <a href="#" class="text-reset btn-link">STIR</a>
                            </div>
                        </li>
                        <li class="nav-item">{{$post->created_at->format('d/m/Y')}}</li>
                        <li class="nav-item">{{$post->getReadingTimeAttribute()}} min leestijd</li>
                    </ul>
                    <img class="rounded mt-5" src="{{$post->image_url}}" alt="Image">
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
                        {!! $post->body !!}
                    </x-markdown>

                    <!-- Divider -->
                    <div class="text-center h5 mb-4">. . .</div>

                    @if($registration)
                        <h4 class="mb-2 display-6">
                            Aanmelden
                        </h4>
                        <p>
                            @guest
                                Om deel te nemen aan een activiteit moet je eerst <a href="{{route('login')}}"
                                                                                     class="btn-link fw-bold">inloggen</a>
                                of <a href="{{route('register')}}" class="btn-link fw-bold">registreren</a>.
                            @endguest
                            @auth
                                @if($registration->registration_start <= now() && $registration->registration_end >= now())
                                    @if($registration->attendees->contains('user_id', Auth::user()->id))
                                        Je bent al aangemeld voor deze activiteit.

                                        <form action="{{route('events.unregister', $registration)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                Afmelden
                                            </button>
                                        </form>
                                    @elseif($registration->availableSeats() > 0)
                                        Meld je aan om deel te nemen aan deze activiteit.

                                        <form action="{{ route('events.register', ['event' => $registration]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Meld direct aan
                                                @if($registration->max_attendees > 0)
                                                    (nog {{$registration->availableSeats()}} plaatsen)
                                                @endif
                                            </button>
                                        </form>
                                    @else
                                        De activiteit is helaas vol.
                                    @endif
                                @elseif($registration->registration_start >= now())
                                    De registratie begint
                                    op {{$registration->registration_start->translatedFormat('d F Y')}},
                                    om {{$registration->registration_start->format('H:i')}}. Zorg dat je op tijd bent!
                                @elseif($registration->registration_end <= now())
                                    De registratie is helaas afgelopen
                                    op {{$registration->registration_end->translatedFormat('d F Y')}},
                                    om {{$registration->registration_end->format('H:i')}}.
                                @endif
                            @endauth
                        </p>
                    @endif
                </div>
                <!-- Main Content END -->
            </div>
        </div>
    </section>
    <!-- =======================
    Main END -->

@endsection
