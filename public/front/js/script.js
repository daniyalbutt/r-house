function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var swiper = new Swiper(".mySwiper", {
    loop: true,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
    effect: "slide",
    speed: 1000,
    slidesPerView: 1,
    spaceBetween: 0,
    autoplay: false,
    navigation: {
        nextEl: ".home-swiper-button-next",
        prevEl: ".home-swiper-button-prev",
    },
});

const swiperEl = document.querySelector('.mySwiper');

if(swiperEl != null){
    swiperEl.addEventListener('mousemove', (e) => {
        const rect = swiperEl.getBoundingClientRect();
        const middle = rect.left + rect.width / 2;

        if (e.clientX < middle) {
            swiperEl.classList.add('left-cursor');
            swiperEl.classList.remove('right-cursor');
        } else {
            swiperEl.classList.add('right-cursor');
            swiperEl.classList.remove('left-cursor');
        }
    });

    swiperEl.addEventListener('click', (e) => {
        const rect = swiperEl.getBoundingClientRect();
        const middle = rect.left + rect.width / 2;

        if (e.clientX < middle) {
            swiper.slidePrev(); // Go to previous slide
        } else {
            swiper.slideNext(); // Go to next slide
        }
    });
}

var globalSliderSettings = {
    nextArrow: "<a href=\"#\" class=\"slick-next\"><i class=\"fa fa-chevron-right\"></i></a>",
    prevArrow: "<a href=\"#\" class=\"slick-prev\"><i class=\"fa fa-chevron-left\"></i></a>",
    customPaging: function customPaging(slider, i) {
        return '<div class="slider-dot"></div>';
    }
};

$(".product-slider .product-slide__wrapper").slick({
    dots: false,
    arrows: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: $(".product-slider .prev-btn"),
    nextArrow: $(".product-slider .next-btn"),
    responsive: [
        {
            breakpoint: 1170,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2
            }
        }
    ]
});


var partnerSwiper = new Swiper('.partnersLogoSlider', {
    slidesPerView: 5,
    spaceBetween: 30,
    loop: true,
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.brandArea .swiper-next',
        prevEl: '.brandArea .swiper-prev',
    },
    breakpoints: {
        1200: {
            slidesPerView: 5
        },
        992: {
            slidesPerView: 4
        },
        768: {
            slidesPerView: 3
        },
        576: {
            slidesPerView: 2
        },
        0: {
            slidesPerView: 1
        }
    }
});

$(".product-detail__slide-two__big").slick({
    arrows: false,
    swipe: false,
    asNavFor: ".product-detail__slide-two__small"
});

$(".product-detail__slide-two__small").slick(_objectSpread(_objectSpread({
    arrows: true,
    dots: false,
    focusOnSelect: true,
    slidesToShow: 3,
    centerMode: true,
    centerPadding: "80px",
    asNavFor: ".product-detail__slide-two__big"
}, globalSliderSettings), {}, {
    responsive: [{
        breakpoint: 992,
        settings: {
            slidesToShow: 1
        }
    }, {
        breakpoint: 768,
        settings: {
            centerPadding: "50px"
        }
    }, {
        breakpoint: 576,
        settings: {
            slidesToShow: 2,
            centerPadding: "50px"
        }
    }]
}));

var onHoverChangeVideoSrc = function onHoverChangeVideoSrc() {
    $(".introduction-two-content__item").on("mouseover", function (e) {
        e.preventDefault();
        var cover = $(this).attr("data-cover");
        var src = $(this).attr("data-src");
        $(".introduction-two-content__item").removeClass("active");
        $(this).addClass("active");
        $(".introduction-two .video-frame__poster img").attr("src", cover.toString());
    });
};

$(document).ready(function () {
    onHoverChangeVideoSrc();
});