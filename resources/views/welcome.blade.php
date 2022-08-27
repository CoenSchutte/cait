@extends('layouts.app')

@section('content')
    <section class="p-0">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-xxl-10 mx-auto rounded-3 overflow-hidden">
                    <div class="tiny-slider arrow-hover arrow-blur arrow-round position-relative">
                        <div class="tiny-slider-inner" data-autoplay="false" data-hoverpause="true" data-gutter="2"
                             data-arrow="false" data-dots="true" data-items="1">
                            <!-- Slide item -->
                            @foreach ($posts as $post)
                                <div
                                    class="card bg-dark-overlay-3 rounded-0 h-400 h-lg-500 h-xl-700 position-relative overflow-hidden lazy"
                                    data-bg="{{$post->image_url}}"
                                    style="background-position: center left; background-size: cover;">
                                    <!-- Card Image overlay -->
                                    <div class="card-img-overlay rounded-0 d-flex align-items-center">
                                        <div class="container px-3 my-auto">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <!-- Card category -->
                                                    <a href="#"
                                                       class="badge text-bg-{{strtolower($post->category)}} mb-2"><i
                                                            class="fas fa-circle me-2 small fw-bold"></i>{{$post->category}}
                                                    </a>
                                                    <!-- Card title -->
                                                    <h2 class="text-white display-5">
                                                        <a href="{{route('posts.show',$post)}}"
                                                           class="btn-link text-reset fw-normal">{{$post->title}}</a>
                                                    </h2>
                                                    <p class="text-white">{{ $post->subtitle }}</p>
                                                    <!-- Card info -->
                                                    <ul
                                                        class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                                        <li class="nav-item">
                                                            <div class="nav-link">
                                                                <div
                                                                    class="d-flex align-items-center text-white position-relative">
                                                                    <div class="avatar avatar-sm">
                                                                        <img class="avatar-img rounded-circle"
                                                                             src="images/avatar/11.jpg" alt="avatar">
                                                                    </div>
                                                                    <span class="ms-3">by <a href="#"
                                                                                             class="stretched-link text-reset btn-link">STIR</a></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item">{{ $post->created_at->format('d/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div
                            class="col-xl-4 custom-thumb pe-5 position-absolute top-50 end-0 translate-middle-y d-none d-xxl-block"
                            id="custom-thumb">
                            @foreach ($posts as $post)
                                <div class="row align-items-center g-3 mb-4">
                                    <div class="col-auto">
                                        <div class="avatar avatar-lg">
                                            <img class="avatar-img rounded-circle" src="{{$post->preview_url}}"
                                                 alt="avatar">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h4 class="fw-normal text-truncate mb-1">{{ $post->title }}</h4>
                                        <p class="text-truncate d-block col-11 small mb-0">{{$post->subtitle}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Custom thumb END -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
        Main hero END -->

    <!-- =======================
        Highlights START -->
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Title -->
                    <div class="mb-4">
                        <h2 class="m-0"><i class="bi bi-megaphone"></i> Event hightlights!</h2>
                        <p class="m-0">De foto's, video's en andere ongein van de laatste events!</p>
                    </div>
                    <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round mt-3">
                        <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="24"
                             data-arrow="true" data-dots="false" data-items-xl="4" data-items-lg="3" data-items-md="3"
                             data-items-sm="2" data-items-xs="1">

                            <!-- Card item START -->
                            @foreach($highlights as $highlight)
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img" src="{{$highlight->image_url}}" alt="Card image">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <!-- Card overlay Top -->
                                            <div class="w-100 mb-auto d-flex justify-content-end">
                                                <div class="text-end ms-auto">
                                                </div>
                                            </div>
                                            <!-- Card overlay bottom -->
                                            <div class="w-100 mt-auto">
                                                <a href="#" class="badge text-bg-{{strtolower($highlight->category)}} mb-2"><i
                                                        class="fas fa-circle me-2 small fw-bold"></i>{{$highlight->category}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h5 class="card-title"><a href="post-single-6.html"
                                                                  class="btn-link text-reset fw-bold">{{$highlight->title}}</a></h5>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider align-items-center">
                                            <li class="nav-item">{{$highlight->event_date->format('d/m/Y')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
        Highlights END -->

    <!-- =======================
        Adv START -->
    <section class="p-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{$ad?->company_url}}" class="d-block card-img-flash">
                        <img src="{{$ad?->image_url}}" alt="">
                    </a>
                    <small class="text-end d-block mt-1">Advertentie</small>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
        Adv END -->


    <!-- =======================
        Sponsored news START -->
{{--    <section class="pt-4">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <!-- Title -->--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="mb-4 d-md-flex justify-content-between align-items-center">--}}
{{--                        <h2 class="m-0"><i class="bi bi-megaphone me-2"></i> Sponsored news</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <!-- Card item START -->--}}
{{--                    <div class="card mb-3 mb-sm-4">--}}
{{--                        <div class="row g-3">--}}
{{--                            <div class="col-4">--}}
{{--                                <img class="rounded-3" src="images/blog/4by3/01.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="col-8">--}}
{{--                                <a href="#" class="badge bg-danger bg-opacity-10 text-danger mb-2"><i--}}
{{--                                        class="fas fa-circle me-2 small fw-bold"></i>Lifestyle</a>--}}
{{--                                <h4><a href="post-single-5.html" class="btn-link stretched-link text-reset fw-bold">The--}}
{{--                                        pros and cons of business agency</a></h4>--}}
{{--                                <!-- Card info -->--}}
{{--                                <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <div class="nav-link">--}}
{{--                                            <div class="d-flex align-items-center position-relative">--}}
{{--                                                <div class="avatar avatar-xs">--}}
{{--                                                    <img class="avatar-img rounded-circle" src="images/avatar/01.jpg"--}}
{{--                                                         alt="avatar">--}}
{{--                                                </div>--}}
{{--                                                <span class="ms-3">by <a href="#"--}}
{{--                                                                         class="stretched-link text-reset btn-link">Samuel</a></span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">Jan 22, 2022</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Card item END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- =======================
        Sponsored news END -->
@endsection
