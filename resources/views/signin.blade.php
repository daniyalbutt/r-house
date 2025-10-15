@extends('layouts.app')
@section('content')
<section class="inner-banner about-banner">
    <div class="breadcrumb">
        <h6>Let’s get you back in</h6>
        <h2>Sign in</h2>
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
                        <p>Please log in to your account</p>
                        <img src="{{ asset('front/images/banner-shape.png') }}" alt="Products">
                    </div>
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword()" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </div>

                        <button type="submit" class="btn btn-theme w-100">Log In</button>
                    </form>
                    <div class="register-text"><p>Don’t have an account? <a href="{{ route('register') }}">Register here</a></p></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const icon = event.currentTarget.querySelector('svg');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.innerHTML = `<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.79 21.79 0 0 1 5.06-6.88M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.8 21.8 0 0 1-2.36 3.38M1 1l22 22" />`;
        } else {
            passwordField.type = 'password';
            icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle>`;
        }
    }
</script>
@endpush