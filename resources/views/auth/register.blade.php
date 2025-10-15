@extends('layouts.app')
@section('content')
<section class="inner-banner about-banner">
    <div class="breadcrumb">
        <h6>Let’s get you set up!</h6>
        <h2>Register</h2>
    </div>
</section>

<section class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <div class="login-header section-title">
                        <h2>Welcome Back</h2>
                        <p>Please Register in to your account</p>
                        <img src="{{ asset('front/images/banner-shape.png') }}" alt="Products">
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" placeholder="Password"
                                class="form-control pl-15 bg-transparent @error('password') is-invalid @enderror"
                                type="password" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" placeholder="Confirm Password"
                                class="form-control pl-15 bg-transparent @error('password') is-invalid @enderror"
                                type="password" name="password_confirmation" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-theme w-100">Register Now</button>
                    </form>
                    <div class="register-text">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection