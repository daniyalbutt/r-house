@extends('layouts.app')
@section('content')
    <section class="inner-banner contact-banner">
            <div class="breadcrumb mb-0" style="background-image:url('{{ asset($page->image) }}');">
                <div class="container">
                    
                </div>
            </div>
        </section>
        
        <section class="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li>
                                <input type="text" class="form-control" placeholder="First Name">
                            </li>
                            <li>
                                <input type="email" class="form-control" placeholder="E-mail">
                            </li>
                            <li>
                                <input type="text" class="form-control" placeholder="Company">
                            </li>
                            <li>
                                <button class="btn btn-white">SEND</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="contact-form">
                            <form>
                                <div class="input-validator">
                                    <input type="text" name="name" placeholder="Name"/>
                                </div>
                                <div class="input-validator">
                                    <input type="text" name="email" placeholder="Email"/>
                                </div>
                                <div class="input-validator">
                                    <textarea name="message" id="" cols="30" rows="3" placeholder="Message"></textarea>
                                </div>
                                <a class="btn btn-theme" href="">Send Message</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <h3 class="contact-title">{{ $page->findSection('contact-heading', '') }}</h3>
                        {!! $page->findSection('contact-content', '') !!}
                        <div class="contact-info__item">
                            <div class="contact-info__item__icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-info__item__detail">
                                <p>{!! $helper->companyAddress() !!}</p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <div class="contact-info__item__icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="contact-info__item__detail">
                                <p>{!! $helper->companyNumber() !!}</p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <div class="contact-info__item__icon"><i class="far fa-envelope"></i></div>
                            <div class="contact-info__item__detail">
                                <p>{!! $helper->companyEmail() !!}</p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <div class="contact-info__item__icon"><i class="far fa-clock"></i></div>
                            <div class="contact-info__item__detail">
                                <p>Sun-Sat: 8.00am - 9.00.pm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
