@extends('layouts.app')
@section('content')
        <section class="inner-banner about-banner">
            <div class="breadcrumb" style="background-image:url('{{ asset($page->image) }}');">
                <h6>{{ $page->findSection('banner-sub-heading', '') }}</h6>
                <h2>{{ $page->name }}</h2>
            </div>
        </section>
        
        <section class="login-form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="login-card">
                            <div class="login-header section-title">
                                <h2>Welcome Back</h2>
                                <p>Please log in to your account</p>
                                <img src="{{ asset('front/images/banner-shape.png') }}" alt="Products">
                            </div>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" required="">
                                </div>
                                <button type="submit" class="btn btn-theme w-100">Log In</button>
                            </form>
                            <div class="register-text"><p>Don’t have an account? <a href="register.php">Register here</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
