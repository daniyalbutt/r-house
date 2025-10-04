@extends('layouts.app')
@section('content')
    <section class="AboutSection">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sideraBarMain">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('blogs') }}">Blogs</a></li>
                            <li><a href="{{ route('ourApp') }}">Our App</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="aboutText">
                        {!! $page->findSection('shop-smarter') !!}
                        {!! $page->findSection('great-deal') !!}

                        <img src="{{ asset($page->findSection('app-screen')) }}" class="img-fluid pb-5" alt="">
                        {!! $page->findSection('download-basket') !!}
                        <ol class="list-unstyled">
                            <li><a href="javascript:;"><img src="{{ asset('front/images/playstore.png') }}"
                                        class="img-fluid" alt=""></a>
                            </li>
                            <li><a href="javascript:;"><img src="{{ asset('front/images/appstore.png') }}" class="img-fluid"
                                        alt=""></a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
