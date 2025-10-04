<footer>
    <div class="container custom-container subscribeContainer">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="subscribe-letter">
                    <h2>Subscribe to our newsletter</h2>
                    <p>We handpick the very best deals, trends and product news - making sure you never miss a thing.
                    </p>
                    <form class="subscribeform">
                        <div class="form-group">
                            <input type="email" class="form-control" id="newsletter_email"
                                placeholder="Your email address">
                            <button type="button" id="newsletter-btn" class="subscribeBtn"><i
                                    class="far fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container custom-container foolinksCOntain">
        <div class="row">
            <div class="col-lg-5">
                <div class="foot-leftOne">
                    {!! $helper->footerContent() !!}
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footlinks">
                    <h4>Company</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><a href="{{ route('ourApp') }}">Our App</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footlinks">
                    <h4>Learn more</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('membership') }}">Membership</a></li>
                        <li><a href="{{ route('faq') }}">Frequently Asked Questions</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms & Condition</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footlinks">
                    <h4>Partners & Advertisers</h4>
                    <ul class="list-unstyled">
                        <li><a href="javascript::">Why Basket Buddy?</a></li>
                        <li><a href="javascript::">Register Your Shop</a></li>
                        <li><a href="javascript::">Register Your Brand</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container custom-container">
        <div class="row">
            <div class="col-lg-6">
                <p>{{ $helper->copyright() }}</p>
            </div>
            <div class="col-lg-6">
                <ol class="list-unstyled sociallinks">
                    <li><a href="{{ $helper->facebook() }}"><img src="{{ asset('front/images/icon1.svg') }}"
                                class="img-fluid" alt=""></a></li>
                    <li><a href="{{ $helper->twitter() }}"><img src="{{ asset('front/images/icon2.svg') }}"
                                class="img-fluid" alt=""></a></li>
                    <li><a href="{{ $helper->instagram() }}"><img src="{{ asset('front/images/icon3.svg') }}"
                                class="img-fluid" alt=""></a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- END: Footer -->

<div class="toggle-bottom">

    <ul class="bottomList">
        <li><a href="javascript"> lore ispum</a></li>
        <li>
            <p>No Product Found</p>
        </li>

    </ul>

    <div class="toggle">
        <span><img src="{{ asset('front/images/list.svg') }}" class="img-fluid" alt=""> My List <i
                class="fas fa-chevron-down"></i></span>
    </div>

</div>
