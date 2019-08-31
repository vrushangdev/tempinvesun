@extends('layouts.error')
@section('title','500 | Something went wrong ')
@section('content')
<main class="admin-main  bg-pattern">
    <div class="container">
        <div class="row m-h-100 ">
            <div class="col-md-8 col-lg-4 m-auto">
                <div class="card shadow-lg p-t-20 p-b-20">
                    <div class="card-body text-center">
                        <img width="200" alt="image" src="{{ asset('img/404.svg') }}">
                        <h1 class="display-1 fw-600 font-secondary">500</h1>
                        <h5>Something went wrong </h5>
                        <p class="opacity-75">
                            You may want to head back to the homepage.
                            If you think something is broken, report a problem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection