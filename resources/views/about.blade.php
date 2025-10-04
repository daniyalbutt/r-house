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
                        {!! $page->findSection('about-us-content') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="AboutBuddy">
        <div class="container custom-container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-txt">
                        {!! $page->findSection('basket-buddy-ambition') !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="aboutapps">
                        <ol class="list-unstyled">
                            <li><a href="javascript:;"><img src="{{ asset('front/images/appstore.png') }}" class="img-fluid"
                                        alt=""></a>
                            </li>
                            <li><a href="javascript:;"><img src="{{ asset('front/images/playstore.png') }}"
                                        class="img-fluid" alt=""></a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a1.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('best-price-product') !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a2.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('trustworthy') !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="inneraboutbuddy">
                        <img src="{{ asset('front/images/a3.svg') }}" class="img-fluid" alt="">
                        {!! $page->findSection('free') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
