        <section class="contactSection">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Get in touch</h2>
                    <img src="{{ asset('front/images/banner-shape.png') }}" alt="Products">
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-7 col-xl-8">
                        <div class="contactForm">
                            <div id="alert"></div>
                            <!--Response Holder-->
                            <form id="angelContactForm" method="post">
                                <div class="form-group">
                                    <input type="text" name="contact-form-name" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="contact-form-email" class="form-control" placeholder="Your Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="contact-form-mobile" class="form-control" placeholder="Your Mobile" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="contact-form-message" placeholder="Your Message" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="contact-submit-btn" class="btn btn-theme">send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-4">
                        <div class="holdingInfo patternbg">
                            {!! $helper->contactContent() !!}
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>{!! $helper->companyAddress() !!}</li>
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="tel:{!! $helper->companyNumber() !!}">{!! $helper->companyNumber() !!}</a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:{!! $helper->companyEmail() !!}">{!! $helper->companyEmail() !!}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="brandArea">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="swiper partnersLogoSlider">
                            <div class="swiper-wrapper">
                                @foreach($partners as $key => $value)
                                <div class="swiper-slide">
                                    <div class="partnersLogo clearfix">
                                        <img class="lazyestload" data-src="{{ asset($value->logo) }}" src="{{ asset($value->logo) }}" alt="{{ $value->name }}">
                                    </div>
                                </div>
                                @endforeach
                                @foreach($partners as $key => $value)
                                <div class="swiper-slide">
                                    <div class="partnersLogo clearfix">
                                        <img class="lazyestload" data-src="{{ asset($value->logo) }}" src="{{ asset($value->logo) }}" alt="{{ $value->name }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-next swiper-btn">
                            <img src="{{ asset('front/images/arrow-right.png') }}" alt="Next">
                        </div>
                        <div class="swiper-prev swiper-btn">
                            <img src="{{ asset('front/images/arrow-left.png') }}" alt="Prev">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer>
            <a href="#pageTop" class="backToTop"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-content">
                            <h5><img src="{{ asset($logo) }}"></h5>
                            {!! $helper->footerContent() !!}
                            <div class="social-icons">
                                @if($helper->facebook())
                                <a href="{{ $helper->facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($helper->twitter())
                                <a href="{{ $helper->twitter() }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
                                @endif
                                @if($helper->instagram())
                                <a href="{{ $helper->instagram() }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($helper->linkedin())
                                <a href="{{ $helper->linkedin() }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>CONTACT</h5>
                        <p>{!! $helper->companyAddress() !!}</p>
                        <p>{!! $helper->companyEmail() !!}</p>
                        <p>{!! $helper->companyNumber() !!}</p>
                    </div>
                    <div class="col-md-3">
                        <h5>INFO</h5>
                        <p>Working Days <span>9AM - 9PM</span></p>
                        <p>Saturday <span>10AM - 8PM</span></p>
                        <p>Sunday <span>Closed</span></p>
                    </div>
                    <div class="col-md-2 map">
                        <h5>MAPS</h5>
                        <img src="{{ asset('front/images/footer-img-2.png') }}" alt="Map">
                    </div>
                </div>
            </div>
            <div class="bottom-bar">
                {{ $helper->copyright() }}
            </div>
        </footer>
