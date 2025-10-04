<div class="topbar">
    <div class="container custom-container">
        <div class="row align-items-baseline">
            <div class="col-lg-6">
                <div class="topbuttons">
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected>English</option>
                            <option>French</option>
                            <option>Spanish</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect2">
                            <option selected>USD $</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group addressgroup">
                        <i class="fas fa-map-marker-alt"></i>
                        <select class="form-control" id="exampleFormControlSelect3">

                            <option selected>305 Sun Valley Blvd, Hewitt, TX76652</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <a href="javascript:;" class="loginBtn"> Login / Register</a>
            </div>
        </div>
    </div>
</div>


<div class="logobar">
    <div class="container custom-container">
        <div class="row">
            <div class="col-lg-6">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($logo) }}" class="img-fluid" alt="">

                </a>
            </div>
            <div class="col-lg-6">
                <div class="categoriesMain">
                    <a href="tel:+1800456789" class="phonebtns">
                        <img src="{{ asset('front/images/phone.png') }}" class="img-fluid" alt="">
                        <span>Call us Free <b>(+ 1) 800 456 789</b></span>
                    </a>
                    <form class="searchproduct">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search Products">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="exampleFormControlSelect2">
                                <option selected>All Categories</option>
                                <option>2</option>
                                <option>3</option>
                            </select>

                        </div>
                        <button type="submit" class="searchbtns"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Begin: Header -->
<header>
    <div class="main-navigate">
        <div class="an-navbar">
            <div class="container custom-container">
                <nav class="navbar navbar-expand-lg ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            <li class="nav-item active">
                                <a class="nav-link" href="categories.php"> <img
                                        src="{{ asset('front/images/head-icon1.png') }}" class="img-fluid"
                                        alt=""> Category </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="map.php"> <img
                                        src="{{ asset('front/images/head-icon2.png') }}" class="img-fluid"
                                        alt=""> Maps</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="store.php"> <img
                                        src="{{ asset('front/images/head-icon3.png') }}" class="img-fluid"
                                        alt=""> Stores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="price.php"> <img
                                        src="{{ asset('front/images/head-icon4.png') }}" class="img-fluid"
                                        alt=""> Prices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="deals.php"> <img
                                        src="{{ asset('front/images/head-icon5.png') }}" class="img-fluid"
                                        alt=""> Deals</a>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
