@extends('layouts.login')
@section('title','Socialink | Reset Password')
@section('content')
<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="{{ asset('img/logo.svg') }}" width="80" alt="">
                            </p>
                            <p class="admin-brand-content">
                                Socialink
                            </p>
                        </div>
                        <h3 class="text-center p-b-20 fw-400">Reset Password</h3>
                        <form class="needs-validation" method="POST" action="{{ route('retailer.resetpassword') }}" id="resetPassword">
                            @csrf   
                            
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>Email</label>
                                    <input type="email" required name="email" class="form-control" placeholder="Email" value="{{ $email ?? old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group floating-label col-md-12">
                                    <label>Passsword</label>
                                    <input type="password" required name="password" class="form-control" placeholder="Password" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group floating-label col-md-12">
                                    <label>Confirm Password</label>
                                    <input type="password" required name="password_confirmation" class="form-control" placeholder="Confirm Password" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('../../img/login.svg');"></div>
        </div>
    </div>
</main>
@endsection
