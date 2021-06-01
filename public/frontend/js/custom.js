$(document).ready(function () {
    "use strict";
    $('#testimonails').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 4000,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true,
                autoplay: true
            },
            1000: {
                items: 1
            }
        }
    });
    $('#membersCarousel').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 4000,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3
            }
        }
    });
    $('#serviceCarousel').owlCarousel({
        loop: false,
        margin: 0,
        responsiveClass: true,
        autoplay: false,
        mouseDrag: false,
        nav: true,
        navText: ['<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 4,
                nav: true
            },
            1000: {
                items: 6
            }
        }
    });
    $('.panel-collapse').on('show.bs.collapse', function () {
        $(this).siblings('.panel-heading').addClass('active');
    });

    $('.panel-collapse').on('hide.bs.collapse', function () {
        $(this).siblings('.panel-heading').removeClass('active');
    });
    var activeTab = $('.serviceCarousel a').click(function () {
        activeTab.removeClass('activeServiceTab');
        $(this).addClass('activeServiceTab');
    });
    $('#packagesBtn').click(function () {
        $('.serviceCarousel a').removeClass('activeServiceTab');
    });

});
//'<div class="col-md-4 col-sm-4 col-xs-12 selectedServicesRight">\n' +
//            '<h4>Your Selected Services</h4>\n' +
//            '<div class="selectedServices">\n' +
//            '<div class="row">\n' +
//            '<div class="col-md-10 col-sm-10 col-xs-10">\n' +
//            '<h4>Classic Manicure x 1</h4>\n' +
//            '<span>Rs. 2,000</span>\n' +
//            '<h4><strong>Addon</strong></h4>\n' +
//            '<h4>Classic Manicure x 1</h4>\n' +
//            '<span>Rs. 2,000</span>\n' +
//            '</div>\n' +
//            '<div class="col-md-2 col-sm-2 col-xs-2 text-right">\n' +
//            '<a href="javascript:void(0)" class="removeItem"><i class="fa fa-times-circle"></i></a>\n' +
//            '</div>\n' +
//            '<div class="clearfix"></div>\n' +
//            '</div>\n' +
//            '<hr style="margin: 10px 0; border: #ff6c2b dotted 1px;">\n' +
//            '<div class="row">\n' +
//            '<div class="col-md-6 col-sm-6 col-xs-6 text-left">\n' +
//            '<h5><strong>Sub Total</strong></h5>\n' +
//            '</div>\n' +
//            '<div class="col-md-6 col-sm-6 col-xs-6 text-right">\n' +
//            '<h5><strong>4,000</strong></h5>\n' +
//            '</div>\n' +
//            '<div class="clearfix"></div>\n' +
//            '</div>\n' +
//            '<div class="row">\n' +
//            '<div class="coupon">\n' +
//            '<div class="col-md-12">\n' +
//            '<h5>Have a code?</h5>\n' +
//            '</div>\n' +
//            '<div class="col-md-7 col-sm-7 col-xs-12">\n' +
//            '<div class="form-group">\n' +
//            '<input type="text" class="form-control" required="">\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '<div class="col-md-5 col-sm-5 col-xs-12">\n' +
//            '<div class="form-group">\n' +
//            '<button type="submit" class="btn buttonMain hvr-bounce-to-right">Apply</button>\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '<div class="serviceBoxHeader">\n' +
//            '<div class="row">\n' +
//            '<div class="col-md-6 col-sm-6 col-xs-6 text-left">\n' +
//            '<h5>Total</h5>\n' +
//            '</div>\n' +
//            '<div class="col-md-6 col-sm-6 col-xs-6 text-right">\n' +
//            '<h5>4,000</h5>\n' +
//            '</div>\n' +
//            '<div class="clearfix"></div>\n' +
//            '</div>\n' +
//            '</div>\n' +
//            '</div>';
