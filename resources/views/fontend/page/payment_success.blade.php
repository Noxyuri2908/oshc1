@extends('fontend.layouts.master')
@section('title')
    Thank you
@endsection
@section('content')
    <div class="container my-3" style="padding:15% 0">
        <h1>Thank you for your payment.</h1>
        <p class="text-payment-success">We will issue the certificate as requested once receiving your payment.</p>
        <div class="d-flex justify-content-center align-items-center">
            <a class="btn btn-default" style="margin-right:3%" href="{{route('get-a-quote.get')}}">Get a quote</a>
            <a class="btn btn-default" href="{{route('homepage')}}">Back to Homepage</a>
        </div>
    </div>
@endsection
