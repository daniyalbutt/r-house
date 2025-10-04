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
                        {!! $page->findSection('blog-content') !!}
                        <div class="row">
                            @foreach ($blogs as $items)
                                <div class="col-lg-4">
                                    <div class="innerblogs">
                                        <figure>
                                            <span>Jul 5</span>
                                            <img src="{{ asset($items->image) }}" class="img-fluid" alt="">

                                        </figure>
                                        <div class="blog-txt">
                                            <h5>{{ $items->name }}</h5>
                                            <strong>By {{ $items->author }}</strong>
                                            {!! $items->short_desc !!}
                                            <a href="javascript:;" class="readbtns">Read More <i
                                                    class="far fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
