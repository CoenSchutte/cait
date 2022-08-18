@extends('layouts.app')


@section('content')

    <!-- =======================
Inner intro START -->
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-danger bg-opacity-10 p-4 text-center rounded-3">
                        <h1 class="text-danger m-0">Post grid style</h1>
                        <p class="lead m-0">Checkout our latest post</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative pt-0">
        <div class="container" data-sticky-container>
            <div class="row">
                <!-- Main Post START -->
                <div class="col-lg-9">
                    <div class="row gy-4">
                        @foreach($posts as $post)
                            <div class="col-sm-6">
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img" src="{{$post->image_url}}" alt="Card image">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <!-- Card overlay bottom -->
                                            <div class="w-100 mt-auto">
                                                <!-- Card category -->
                                                <a href="#"
                                                   class="badge text-bg-{{strtolower($post->category)}} mb-2"><i
                                                        class="fas fa-circle me-2 small fw-bold"></i>{{$post->category}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="card-title"><a href="{{route('posts.show', $post)}}"
                                                                  class="btn-link text-reset fw-bold">{{$post->title}}</a>
                                        </h4>
                                        <p class="card-text">{{$post->subtitle}}</p>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">Jan 22, 2022</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Card item END -->


                            <!-- Load more START -->
                        <div class="flex justify-center">

                                {{ $posts->links() }}
                        </div>
                        <!-- Load more END -->
                    </div>
                </div>
                <!-- Main Post END -->

                <!-- Sidebar START -->
                <div class="col-lg-3 mt-5 mt-lg-0">
                    <div data-margin-top="80" data-sticky-for="767">
                        <!-- Trending topics widget START -->

                        <div>
                            <h2 class="mb-3">Trending topics</h2>
                            <!-- Category item -->
                            <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded" style="background-image:url(../images/blog/4by3/01.jpg); background-position: center left; background-size: cover;">
                                <div class="bg-dark-overlay-4 p-3">
                                    <a href="#" class="stretched-link btn-link fw-bold text-white h5">Workshop</a>
                                </div>
                            </div>
                            <!-- Category item -->
                            <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded" style="background-image:url(../images/blog/4by3/02.jpg); background-position: center left; background-size: cover;">
                                <div class="bg-dark-overlay-4 p-3">
                                    <a href="#" class="stretched-link btn-link fw-bold text-white h5">Borrel</a>
                                </div>
                            </div>
                            <!-- Category item -->
                            <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded" style="background-image:url(../images/blog/4by3/03.jpg); background-position: center left; background-size: cover;">
                                <div class="bg-dark-overlay-4 p-3">
                                    <a href="#" class="stretched-link btn-link fw-bold text-white h5">Promo</a>
                                </div>
                            </div>
                            <!-- Category item -->
                            <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded" style="background-image:url(../images/blog/4by3/04.jpg); background-position: center left; background-size: cover;">
                                <div class="bg-dark-overlay-4 p-3">
                                    <a href="#" class="stretched-link btn-link fw-bold text-white h5">Activiteiten</a>
                                </div>
                            </div>
                            <!-- View All Category button -->
                            <div class="text-center mt-3">
                                <a href="#" class="fw-bold text-muted text-primary-hover"><u>Bekijk alle categoriën</u></a>
                            </div>
                        </div>
                        <!-- ADV widget START -->
                        <div class="col-12 col-sm-6 col-lg-12 my-4">
                            <a href="#" class="d-block card-img-flash">
                                <img src="{{$ad->image_url}}" alt="">
                            </a>
                            <div class="smaller text-end mt-2">ads via
                                <a href="{{$ad->company_url}}"
                                   class="text-muted"><u>{{$ad->company_name}}</u>
                                </a>
                            </div>
                        </div>
                        <!-- ADV widget END -->
                    </div>
                </div>
            </div>
            <!-- Sidebar END -->
        </div> <!-- Row end -->
        </div>
    </section>

@endsection
