@extends('layouts.app')

@section('content')
    <section class="pt-4 pb-0 card-grid">
        <div class="container">
            <div class="row g-4">
                <!-- Left big card -->
                @if($posts->first())
                    <div class="col-lg-6">
                        <div class="card card-overlay-bottom card-grid-lg card-bg-scale"
                             style="background-image:url({{$posts->first()->image_url}}); background-position: center; background-size: cover;">
                            <!-- Card featured -->
                            <span class="card-featured" title="Featured post"><i class="fas fa-star"></i></span>
                            <!-- Card Image overlay -->
                            <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                <div class="w-100 mt-auto">
                                    <!-- Card category -->
                                    <a href="#" class="badge text-bg-{{strtolower($posts->first()->category)}} mb-2"><i
                                            class="fas fa-circle me-2 small fw-bold"></i>{{$posts->first()->category}}
                                    </a>
                                    <!-- Card title -->
                                    <h2 class="text-white h1"><a href="{{route('post.show', $posts->first())}}"
                                                                 class="btn-link stretched-link text-reset">{{$posts->first()->title}}</a>
                                    </h2>
                                    <p class="text-white">{{$posts->first()->subtitle}}</p>
                                    <!-- Card info -->
                                    <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                        <li class="nav-item">
                                            @if($posts->first()->event_held_at)
                                                {{$posts->first()->event_held_at->format('d/m/Y')}}
                                            @else
                                                {{$posts->first()->created_at->format('d/m/Y')}}
                                            @endif
                                        </li>
                                        <li class="nav-item">{{$posts->first()->getReadingTimeAttribute()}} min leestijd
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Right small cards -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Card item START -->
                        @foreach($posts as $post)
                            @if($loop->index > 0)
                                @php
                                    $isFirst = $loop->index == 1
                                @endphp
                                <div @class([
                                        'col-md-12' => $isFirst,
                                        'col-md-6' => ! $isFirst,
                                    ])>
                                    <div class="card card-overlay-bottom card-grid-sm card-bg-scale"
                                         style="background-image:url({{$post->image_url}}); background-position: center; background-size: cover;">
                                        <!-- Card Image -->
                                        <!-- Card Image overlay -->
                                        <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                            <div class="w-100 mt-auto">
                                                <!-- Card category -->
                                                <a href="#"
                                                   class="badge text-bg-{{strtolower($post->category)}} mb-2"><i
                                                        class="fas fa-circle me-2 small fw-bold"></i>{{$post->category}}
                                                </a>
                                                <!-- Card title -->
                                                <h4 class="text-white"><a href="{{route('post.show', $post)}}"
                                                                          class="btn-link stretched-link text-reset">{{$post->title}}</a>
                                                </h4>
                                                <!-- Card info -->
                                                <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                                    <li class="nav-item">
                                                        @if($post->event_held_at)
                                                            {{$post->event_held_at->format('d/m/Y')}}
                                                        @else
                                                            {{$post->created_at->format('d/m/Y')}}
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
    Main hero END -->

    <!-- =======================
    Main content START -->
    <section class="position-relative">
        <div class="container" data-sticky-container>
            <div class="row">
                <!-- Main Post START -->
                <div class="col-lg-9">
                    <!-- Title -->
                    <div class="mb-4">
                        <h2 class="m-0"><i class="bi bi-hourglass-top me-2"></i>Event Highlights</h2>
                        <p>De foto's, video's en andere ongein van de laatste events!</p>
                    </div>
                    <div class="row gy-4">
                        <!-- Card item START -->
                        @foreach($highlights as $highlight)
                            <div class="col-sm-6">
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img" src="{{$highlight->image_url}}" alt="Card image">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <!-- Card overlay bottom -->
                                            <div class="w-100 mt-auto">
                                                <!-- Card category -->
                                                <a href="#"
                                                   class="badge text-bg-{{strtolower($highlight->category)}} mb-2"><i
                                                        class="fas fa-circle me-2 small fw-bold"></i>{{$highlight->category}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="card-title mt-2"><a href=""
                                                                       class="btn-link text-reset fw-bold">{{$highlight->title}}</a>
                                        </h4>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">{{$highlight->event_date->translatedFormat('d F Y')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Main Post END -->
                <!-- Sidebar START -->
                <div class="col-lg-3 mt-5 mt-lg-0">
                    <div data-sticky data-margin-top="80" data-sticky-for="767">

                        <div class="row">
                            <!-- Recent post widget START -->
                            <div class="col-12 col-sm-6 col-lg-12">
                                <h4 class="mt-4 mb-3">Recente posts</h4>
                                <!-- Recent post item -->
                                @foreach($recentPosts as $recentPost)
                                    <div class="card mb-3">
                                        <div class="row g-3">
                                            <div class="col-4">
                                                <img class="rounded" src="{{$recentPost->image_url}}" alt="">
                                            </div>
                                            <div class="col-8">
                                                <h6><a href="{{route('post.show', $recentPost)}}"
                                                       class="btn-link stretched-link text-reset fw-bold">{{$recentPost->title}}</a>
                                                </h6>
                                                <div
                                                    class="small mt-1">{{$recentPost->created_at->translatedFormat('d F Y')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Recent post widget END -->

                            <!-- ADV widget START -->
                            @if($ad)
                                <div class="col-12 col-sm-6 col-lg-12 my-4">
                                    <a href="{{$ad?->company_url}}" class="d-block card-img-flash">
                                        <img src="{{$ad?->image_url}}" alt="">
                                    </a>
                                    <div class="smaller text-end mt-2">ads via <a href="{{$ad?->company_url}}"
                                                                                  class="text-body"><u>{{$ad?->company_name}}</u></a>
                                    </div>
                                </div>
                            @endif
                            <!-- ADV widget END -->
                        </div>
                    </div>
                </div>
                <!-- Sidebar END -->
            </div> <!-- Row end -->
        </div>
    </section>
    <!-- =======================
    Main content END -->
    <script src="../vendor/sticky-js/sticky.min.js"></script>

@endsection
