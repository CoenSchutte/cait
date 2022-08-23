@extends('layouts.app')

@section('content')

    <h3> Super bedankt!</h3>

    <p>
        Je bestelling van {{ $product->name . ' ' . $details}} is succesvol aangemaakt.
    </p>
@endsection
