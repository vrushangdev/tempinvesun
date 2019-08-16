@extends('layouts.login')
@section('title','Consumer Login | Invesun')
@section('content')
<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="{{ asset('img/front/logo.png') }}" width="200" alt="">
                            </p>
                           <!--  <p class="admin-brand-content">
                                Consumer
                            </p> -->
                        </div>
                        <h3 class="text-center p-b-20 fw-400">Login</h3>
                        <form class="needs-validation" method="POST" action="{{ route('postLogin') }}" id="loginForm">
                            @csrf   
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>Mobile Number</label>
                                    <input type="text" required name="email" class="form-control number" maxLength="10" placeholder="Mobile Number">
                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label>Password</label>
                                    <input type="password" required name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
                        </form>
                        @if (count($errors) > 0) 
                            <br>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                These credentials do not match our records or your account is temporarily disabled. please contact to system administrator.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true">×</span> 
                                </button> 
                            </div>
                        @endif    
                        <p class="text-right p-t-10">
                            <a href="{{ route('password.request') }}" class="text-underline">Forgot Password?</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('../img/login.svg');"></div>
        </div>
    </div>
</main>
@endsection