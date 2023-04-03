@extends('layouts.app')

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="container mx-auto py-10">
                <h1 class="text-4xl font-bold mb-8">Onze Partners</h1>
                <div class="flex justify-between flex-wrap">
                    <div class="shadow-md flex flex-start">
                        <img style="padding-right: 1rem; width: 300px" class="mt-4" src="{{asset('images/netcompany.png')}}" alt="Partner 1">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
