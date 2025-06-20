@extends('layouts.app')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <!-- Left sidebar START -->
                <div class="col-lg-7 col-xxl-8">
                    {{--                    @if(!$user->hasSubscription())--}}
                    {{--                        <div class="alert alert-warning" role="alert">--}}
                    {{--                            <h4 class="alert-heading">Je bent nog geen lid :(</h4>--}}
                    {{--                            <p>Je loopt nu een aantal voordelen mis. Zo krijg je als lid</p>--}}
                    {{--                            <ul>--}}
                    {{--                                <li><strong>15%</strong> korting op alle betaalde evenementen</li>--}}
                    {{--                                <li><strong>10%</strong> korting op onze merchandise</li>--}}
                    {{--                                <li>Een <strong>gratis</strong> drankje bij elke borrel t.w.v.--}}
                    {{--                                    <strong>&euro;3.00</strong>--}}
                    {{--                                </li>--}}
                    {{--                                <li>Voorrang bij evenementen met beperkte beschikbare plaatsen</li>--}}
                    {{--                                <li>Stemrecht tijdens de ALV</li>--}}
                    {{--                            </ul>--}}
                    {{--                            <hr>--}}
                    {{--                            <a class="btn btn-link" href="{{route('subscription.create')}}">Word nu lid voor &euro;30--}}
                    {{--                                per jaar!</a>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
                    <!-- Profile START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
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

                            <div class="mb-3">
                                <label class="form-label">Opleiding</label>
                                <select class="form-select" name="opleiding">
                                    @foreach(\App\Enums\Opleiding::cases() as $opleiding)
                                        <option value="{{ $opleiding->value }}"
                                            {{ $user->opleiding == $opleiding->value ? 'selected' : '' }}>
                                            {{ $opleiding->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Birthday -->
                            <div>
                                <label class="form-label">Geboortedatum</label>
                                <input type="date" name="birthdate" class="form-control flatpickr-input"
                                       value="{{$user->birthdate?->format('Y-m-d')}}">
                            </div>
                            <!-- Save button -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{route('profile.show')}}"
                                   class="btn text-secondary border-0 me-2">Annuleren</a>
                                <input type="submit" class="btn btn-primary" value="Opslaan"></input>
                            </div>
                        </form>
                    </div>
                    <!-- Profile END -->

                    <!-- Update password START -->
                    <form class="card border mb-4" method="POST" action="{{route('user.change-password')}}">
                        @csrf
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
                                <input class="form-control" type="password" name="old_password"
                                       placeholder="Huidig wachtwoord">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New password -->
                            <div class="mb-3 mt-2">
                                <label class="form-label">Nieuw wachtwoord</label>

                                <label class="form-label" id="psw-strength-message"></label>
                                @error('new_password')
                                <br>
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <input class="form-control fakepassword" type="password" name="new_password"
                                           id="psw-input"
                                           placeholder="Nieuw wachtwoord">
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                            </div>
                            <!-- New password -->
                            <div>
                                <input class="form-control" name="new_password_confirmation" type="password"
                                       placeholder="Bevestig nieuw wachtwoord">
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <input type="submit" href="#" class="btn btn-primary" value="Opslaan"></input>
                            </div>
                        </div>
                    </form>
                    <div class="card border">
                        <div class="card-header border-bottom p-3">
                            <h5 class="card-header-title mb-0">Mijn bestellingen</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center row">
                                <div class="col-md-10">
                                    <div class="rounded">
                                        <div class="table-responsive table-borderless">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <div class="toggle-btn">
                                                            <div class="inner-circle"></div>
                                                        </div>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Product</th>
                                                    <th>Beschrijving</th>
                                                    <th>Status</th>
                                                    <th>Totaal</th>
                                                    <th>Besteld op</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-body">
                                                @foreach($invoices as $invoice)
                                                    <tr class="cell-1">
                                                        <td class="text-center">
                                                            <div class="toggle-btn">
                                                                <div class="inner-circle"></div>
                                                            </div>
                                                        </td>
                                                        <td>#{{$invoice->id}}</td>
                                                        <td>{{$invoice->product}}</td>
                                                        <td>{{$invoice->description}}</td>
                                                        <td>{{ucfirst($invoice->status)}}</td>
                                                        <td>&euro;{{number_format($invoice->price,2)}}</td>
                                                        <td>{{$invoice->created_at->format('d/m/Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="col-12">
                                                <div style="display: flex; justify-content: center;">
                                                    {{ $invoices->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if($user->hasSubscription())
                    <div class="col-lg-5 col-xxl-4">
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h5 class="card-header-title mb-0">STIR Lidmaatschap</h5>
                            </div>
                            <div class="card-body">
                                <p>Je lidmaatschap loopt door
                                    tot: <b>{{$user->member_until->format(('d/m/Y'))}}</b></p>
                                <p>Dat betekent dat je nog <b>{{$user->member_until->diffInDays(now())}} dagen</b> van
                                    je lidmaatschap kan genieten</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
