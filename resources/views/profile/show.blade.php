@extends('layouts.app')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <!-- Left sidebar START -->
                <div class="col-lg-7 col-xxl-8">

                    @if(!$user->hasSubscription())
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Je bent nog geen lid :(</h4>
                            <p>Je loopt nu een aantal voordelen mis. Zo krijg je</p>
                            <ul>
                                <li>30% korting op alle activiteiten</li>
                                <li>Een gratis muntje bij elke borrel</li>
                                <li>10% korting op onze merchandise</li>
                            </ul>
                            <hr>
                            <a class="btn btn-link" href="{{route('subscription.create')}}">Word nu lid voor &euro;30
                                per jaar!</a>
                        </div>
                    @endif
                    <!-- Profile START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success  ') }}
                                </div>
                            @endif
                            <h5 class="card-header-title mb-0">Profiel</h5>
                        </div>
                        <form class="card-body" method="POST" action="{{route('user.update')}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Naam</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                           placeholder="First name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Studentnummer</label>
                                <input class="form-control" name="student_number" type="text"
                                       value="{{$user->student_number}}">
                            </div>
                            <!-- Birthday -->
                            <div>
                                <label class="form-label">Geboortedatum</label>
                                <input type="date" name="birthdate" class="form-control flatpickr-input"
                                       value="{{$user->birthdate?->format('Y-m-d')}}">
                            </div>
                            <!-- Save button -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{route('profile.show')}}" class="btn text-secondary border-0 me-2">Discard</a>
                                <input type="submit" class="btn btn-primary"></input>
                            </div>
                        </form>
                    </div>
                    <!-- Profile END -->

                    <!-- Update password START -->
                    <form class="card border">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card-header border-bottom p-3">
                            <h5 class="card-header-title mb-0">Wijzig Wachtwoord</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Huidig wachtwoord</label>
                                <input class="form-control" type="password" placeholder="Huidig wachtwoord">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New password -->
                            <div class="mb-3 mt-2">
                                <label class="form-label">Nieuw wachtwoord</label>

                                <label class="form-label" id="psw-strength-message"></label>
                                <div class="input-group">
                                    <input class="form-control fakepassword" type="password" id="psw-input"
                                           placeholder="Nieuw wachtwoord">
                                    @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                            </div>
                            <!-- New password -->
                            <div>
                                <input class="form-control" type="password" placeholder="Bevestig nieuw wachtwoord">
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="#" class="btn btn-primary">Change password</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 col-xxl-4">
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h5 class="card-header-title mb-0">STIR Lidmaatschap</h5>
                        </div>
                        <div class="card-body">
                            <h6>{{dd($user->subscription('stir-yearly'))}}</h6>
                            <ul>
                                <li>Take backup of your data <a href="#">Here</a> </li>
                                <li>Account deletion is final. There will be no way to restore your account</li>
                            </ul>
                            <div class="form-check form-check-md my-3">
                                <input class="form-check-input" type="checkbox" value="" id="deleteaccountCheck">
                                <label class="form-check-label" for="deleteaccountCheck">Yes, I'd really like to delete my account</label>
                            </div>
                            <a href="#" class="btn btn-success-soft my-1">Keep my account</a>
                            <a href="#" class="btn btn-danger my-1">Delete my account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
