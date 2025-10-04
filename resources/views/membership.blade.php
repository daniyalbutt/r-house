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
                        <h3>{{ $page->findSection('member') }}</h3>
                        <img src="{{ asset($page->image) }}" class="img-fluid" alt="">
                        {!! $page->findSection('membership-content') !!}

                        <a href="javascript:;" class="registerBtn">Register Your Free Account</a>
                        {!! $page->findSection('unique-membership') !!}
                        {!! $page->findSection('unlimited-access') !!}


                        <ol class="list-unstyled">
                            <li><a href="javascript:;"><img src="img/playstore.png" class="img-fluid" alt=""></a>
                            </li>
                            <li><a href="javascript:;"><img src="img/appstore.png" class="img-fluid" alt=""></a>
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
