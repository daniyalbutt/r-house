@extends('layouts.app')
@section('content')
        <section class="inner-banner about-banner">
            <div class="breadcrumb" style="background-image:url('{{ asset($page->image) }}');">
                <h6>{{ $page->findSection('banner-sub-title', '') }}</h6>
                <h2>{{ $page->name }}</h2>
            </div>
        </section>
        
        <section class="story pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="history">
                            <h5>{{ $page->findSection('story-sub-title', '') }}</h5>
                            <h6>{{ $page->findSection('story-heading-2', '') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>{{ $page->findSection('story-sub-heading-2', '') }}</h4>
                        {!! $page->findSection('story-content-2', '') !!}
                    </div>
                </div>
            </div>
        </section>
        
        <section class="deals" style="background-image:url('{{ asset($page->findSection('deals-banner', '')) }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <h6>{{ $page->findSection('deals-sub-heading', '') }}</h6>
                        <h4>{{ $page->findSection('deals-heading', '') }}</h4>
                        <div class="newsletter-wrap">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">{{ $page->findSection('deals-button-text', '') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="about-story" style="background-image:url('{{ asset($page->findSection('about-story-image', '')) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-story-content">
                            <h4>{{ $page->findSection('about-story-back-heading', '') }}</h4>
                            <h6>{{ $page->findSection('about-story-sub-heading', '') }}</h6>
                            <h5>{{ $page->findSection('about-story-heading', '') }}</h5>
                            {!! $page->findSection('about-story-content', '') !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @include('layouts.components.footer-form')
@endsection
