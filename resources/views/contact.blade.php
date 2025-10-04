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
                        {!! $page->findSection('contact-us-content') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
