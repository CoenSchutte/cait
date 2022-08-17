@extends('layouts.app')


@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto pt-md-5">
                    <a href="#" class="badge text-bg-{{strtolower($post->category)}} mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$post->category}}</a>
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


            </div>
            <!-- Main Content END -->
        </div>
        </div>
    </section>
    <!-- =======================
    Main END -->

@endsection
