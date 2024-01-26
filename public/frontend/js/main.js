$('.carousel').slick({
  dots: false,
  autoplay: true,
  autoplaySpeed: 7000,
  prevArrow:
    '<button type="button" class="slick-next">' + '  next' + '</button>',
  // nextArrow:
  //   '<button class="next-button is-control">' +
  //   '  <span class="fas fa-angle-right" aria-hidden="true"></span>' +
  //   '  <span class="sr-only">Next slide</span>' +
  //   "</button>",
});

$(document).ready(function(){
  $('.carousel-news').slick({
    slidesToShow: 3,
      autoplay: true,
    // dots:true,
    // centerMode: true,
      slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ],
  });
});
$(document).ready(function(){
    $('.carousel-feedback').slick({
        slidesToShow: 3,
        autoplay: true,
        slidesToScroll: 3,
        // dots:true,
        // centerMode: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });
});
$('.slider').slick({
  infinite: true,
  autoplaySpeed: 3000,
  autoplay: false,
  lazyLoad: 'progressive',
  arrows: true,
  dots: false,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
});

$('.slick-nav').on('click touch', function(e) {
  e.preventDefault();

  const arrow = $(this);

  if (!arrow.hasClass('animate')) {
    arrow.addClass('animate');
    setTimeout(() => {
      arrow.removeClass('animate');
    }, 1600);
  }
});

// function btn croll top
const mybutton = document.getElementById('myBtn');
window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = 'block';
  } else {
    mybutton.style.display = 'none';
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
$(document).ready(function ($) {
    $('.popup-youtube').magnificPopup({
        disableOn: 320,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: true
    });
});
// nav
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.nav-links li');

hamburger.addEventListener('click', () => {
  // Animate Links
  navLinks.classList.toggle('open');
  links.forEach(link => {
    link.classList.toggle('fade');
  });

  // Hamburger Animation
  hamburger.classList.toggle('toggle');
});

$(document).ready(function() {
  var slider = $('#slider');
  var thumb = $('#thumb');
  var slidesPerPage = 4; //global y define number of elements per page
  var syncedSecondary = true;
  slider
    .owlCarousel({
      items: 1,
      slideSpeed: 2000,
      nav: false,
      autoplay: false,
      dots: false,
      loop: true,
      responsiveRefreshRate: 200,
    })
    .on('changed.owl.carousel', syncPosition);
  thumb
    .on('initialized.owl.carousel', function() {
      thumb.find('.owl-item').eq(0).addClass('current');
    })
    .owlCarousel({
      items: slidesPerPage,
      dots: false,
      nav: true,
      item: 4,
      smartSpeed: 200,
      slideSpeed: 500,
      slideBy: slidesPerPage,
      navText: [
        '<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
        '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>',
      ],
      responsiveRefreshRate: 100,
    })
    .on('changed.owl.carousel', syncPosition2);
  function syncPosition(el) {
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    thumb
      .find('.owl-item')
      .removeClass('current')
      .eq(current)
      .addClass('current');
    var onscreen = thumb.find('.owl-item.active').length - 1;
    var start = thumb.find('.owl-item.active').first().index();
    var end = thumb.find('.owl-item.active').last().index();
    if (current > end) {
      thumb.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      thumb.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      slider.data('owl.carousel').to(number, 100, true);
    }
  }
  thumb.on('click', '.owl-item', function(e) {
    e.preventDefault();
    var number = $(this).index();
    slider.data('owl.carousel').to(number, 300, true);
  });

  $('.qtyminus').on('click', function() {
    var now = $('.qty').val();
    if ($.isNumeric(now)) {
      if (parseInt(now) - 1 > 0) {
        now--;
      }
      $('.qty').val(now);
    }
  });
  $('.qtyplus').on('click', function() {
    var now = $('.qty').val();
    if ($.isNumeric(now)) {
      $('.qty').val(parseInt(now) + 1);
    }
  });
});
var slider = tns({
  arrowKeys: true,
  container: ".js-sliderImageViewer",
  controls: false,
  loop: false,
  mouseDrag: true,
  navContainer: ".js-imageViewerNav",
});

//Scrolling Effect for nav
$(window).on("scroll", function() {
    if($(window).scrollTop()) {
        $('nav').addClass('black');
    } else {
        $('nav').removeClass('black');
    }
});


