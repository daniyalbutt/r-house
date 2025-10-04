@extends('layouts.app')
@section('content')
    <section class="AboutSection">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sideraBarMain">

                        <ul class="list-unstyled">
                            <li><a href="{{ route('membership') }}">Membership</a></li>
                            <li><a href="{{ route('faq') }}">Frequently Asked Questions</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms & Condition</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="aboutText">
                        <h3>{{ $page->name }}</h3>
                        {!! $page->findSection('donec-sed-justo-2') !!}

                        {!! $page->findSection('nunc-aliquet-2') !!}
                        {!! $page->findSection('mauris-dignissim-2') !!}
                        {!! $page->findSection('proin-vel-2') !!}
                        {!! $page->findSection('mauris-quis-2') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
