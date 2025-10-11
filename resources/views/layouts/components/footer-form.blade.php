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