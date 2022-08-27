@extends('layouts.app')


@section('content')

    <!-- =======================
Inner intro START -->
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <h1 class="m-0">Check hier de laatste posts</h1>
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
                                        <img class="card-img lazy" data-src="{{$post->image_url}}" src="{{$post->low_res}} alt="Card image">
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
                                            <li class="nav-item">{{$post->created_at}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Card item END -->


                            <!-- Load more START -->
                        <div style="display: flex; justify-content: center;">

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
                        <!-- ADV widget START -->
                        <div class="col-12 col-sm-6 col-lg-12 my-4">
                            <a href="#" class="d-block card-img-flash">
                                <img class="lazy" data-src="{{$ad?->image_url}}" alt="">
                            </a>
                            <div class="smaller text-end mt-2">ads via
                                <a href="{{$ad?->company_url}}"
                                   class="text-muted"><u>{{$ad?->company_name}}</u>
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
