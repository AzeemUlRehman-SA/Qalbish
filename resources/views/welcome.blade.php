<!DOCTYPE html>
<html lang="en">
<head>

    @php
        $meta_tags =isset($meta_information) ? $meta_information->where('route',Route::currentRouteName())->first() : null ;
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $meta_tags->title }}</title>

    <meta name="description" content="{{ $meta_tags->description }}">
    <meta name="keywords" content="{{ $meta_tags->keywords }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/hover-min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('frontend/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Roboto:300,400,500,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('css')
</head>
<body>

@include('frontend.include.header')
@include('frontend.include.navbar')
@include('frontend.subpages.banner')
@include('frontend.subpages.about')
@include('frontend.subpages.service')
@include('frontend.subpages.blog')
@include('frontend.subpages.testimonials')
@include('frontend.subpages.cta')
@include('frontend.include.footer')
@include('frontend.include.sticky')
@auth
    @if( Session::has('pendingRatingOrder') && !is_null(Session::get('pendingRatingOrder')))
        @include('frontend.modals.rating-modal')
    @endif
@endauth
<div id="bestExperienceModal" class="modal fade in" role="dialog">
    <div class="modal-dialog bestExperienceModal" style="width: 95%;">
        <div class="modal-content" style="background-color: #fbecdb; border-radius: 10px;">
            <div class="modal-header">
                <button type="button" class="close" id="modelClose"><img
                        src="{{ asset('frontend/images/close.png') }}" alt="">
                </button>
            </div>
            <div class="modal-body text-center" style="padding-bottom: 50px;">
                <div class="row">
                    <div class="logoModal" style="margin-bottom: 20px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12">
{{--                        <p style="font-size: 16px; line-height: 26px;">Welcome to Qalbish! Please download our app and get 15% off your first service!</p>--}}
                        <p style="font-size: 16px; line-height: 26px;">App Coming Soon</p>
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-4 col-sm-4 col-xs-6 footerLastArea">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ asset('frontend/images/footerMob.png') }}" alt="FooterMob.png"
                                     style="margin-top: 22px;">
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8 footerLastAreaImages">
{{--                                <h4 style="line-height: 32px; width: 100%;font-size: 18px;">Download App Now</h4>--}}
                                <h4 style="line-height: 32px; width: 100%;font-size: 18px;">App Coming Soon</h4>
                                <a href="#"><img src="{{ asset('frontend/images/appStore.png') }}" alt="AppStore"
                                                 style="width:90%; margin-bottom: 10px; "></a>
                                <a href="#"><img src="{{ asset('frontend/images/googlePlay.png') }}" alt="GooglePlay"
                                                 style="width: 90%;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('frontend/js/jquery-1.11.3.min.js') }}"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('frontend/js/custom.js') }}"></script>
@stack('js')

<script>
        @if(Session::has('flash_message'))
    var type = "{{ Session::get('flash_status') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('flash_message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('flash_message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('flash_message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('flash_message') }}");
            break;
    }
    @endif

</script>

<script>
    $(document).ready(function () {
        $('nav ul li a').click(function () {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });

        var node = $(window).width();

        if (node < 768) {

            var getCount = localStorage.getItem('count');
            if (getCount == '1' && getCount != '' && getCount != null) {
                $('#bestExperienceModal').modal('hide');
            } else {
                $('#bestExperienceModal').modal('hide');
            }
            localStorage.setItem('count', 1);


        } else {
            $('#bestExperienceModal').modal('hide');
        }

        $('#modelClose').click(function () {
            $('#bestExperienceModal').modal('hide');
        });


    });
</script>

@if(Session::has('pendingRatingOrder'))
    @include('frontend.include.rating')
@endif

</body>
</html>
