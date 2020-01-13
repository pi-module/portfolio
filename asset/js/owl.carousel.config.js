$(document).ready(function($) {
    $('.owl-carousel').owlCarousel({
        //loop:true,
        //lazyLoad:true,
        margin: 10,
        nav:true,
        rtl:true,
        autoplay:true,
        dots:false,
        autoplayTimeout:12000,
        autoplayHoverPause:true,
        navText: ['<i class="owl-prev fa fa-angle-right"></i>', '<i class="owl-next fa fa-angle-left"></i>'],
        responsive:{
            0:{items:1},
            600:{items:5},
            1000:{items:6}
        }
    })
});