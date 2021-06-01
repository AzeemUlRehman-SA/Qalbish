<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@include('frontend.include.meta-tags')

<!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<!-- Bootstrap -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/hover-min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('frontend/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Roboto:300,400,500,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    {{--Date Time Picker--}}

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}"/>


    @stack('css')
</head>
<body onload="checkCookie()">

@include('frontend.include.header')
@include('frontend.include.navbar')
@yield('content')
<div id="thankYouModal" class="modal fade in" role="dialog">
    <div class="modal-dialog thankYouModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="modelClose"><img
                        src="{{ asset('frontend/images/close.png') }}" alt="">
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Thank you for registering with Qalbish</h3>
{{--                        <h5>A complementary 15% off will automatically be applied to your first order</h5>--}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="modalImagesHold">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a href="{{ route('login') }}" class="btn buttonMain hvr-bounce-to-right">Continue Booking</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modalImagesHold">
{{--                        <h5>Download our app and get 15% off your first order</h5>--}}
                        <h5>App Coming Soon</h5>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="{{ asset('frontend/images/appStore.png') }}" alt="">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="{{ asset('frontend/images/googlePlay.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@auth
    @if( Session::has('pendingRatingOrder') && !is_null(Session::get('pendingRatingOrder')))
        @include('frontend.modals.rating-modal')
    @endif
@endauth
@include('frontend.include.footer')
@include('frontend.include.sticky')
{{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#orderRating">Open Modal</button>--}}


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('frontend/js/jquery-1.11.3.min.js') }}"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('frontend/js/custom.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquerysession.js') }}"></script>

<script type="text/javascript" src="{{ asset('frontend/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script type="text/javascript" src="{{asset('frontend/js/select2.min.js')}}"></script>


@stack('models')
@stack('js')

<script>


    function checkCookie() {

        var check_cookie = "{{\Illuminate\Support\Facades\Cookie::has('referral_code')}}";
        if (check_cookie) {
            var get_cookie = "{{\Illuminate\Support\Facades\Cookie::get('referral_code')}}"
            $('#referred_by').val(get_cookie);
            $('#referral-code-style').css('display', '');
        }
    }

    setTimeout(function () {
        checkCookie();
    }, 2000);

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
@if(Session::has('pendingRatingOrder'))
    @include('frontend.include.rating')
@endif
<script>
    $(document).ready(function () {
        $('nav ul li a').click(function () {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });

        if ($('.cnic-mask').length) {
            $('.cnic-mask').mask('00000-0000000-0');
        }
        if ($('.phone_number').length) {
            $('.phone_number').mask('00000000000');
        }

    });
</script>


<script>
        @if(Session::has('user'))

    var type = "{{ Session::get('user') }}";
    if (type == 'register') {
        $('#thankYouModal').modal('show');
        $('.modal').css('display', 'block');
    }
    @endif

    $('#modelClose').click(function () {
        $('#thankYouModal').modal('hide');
        $('.modal').css('display', 'none');
        var forgetSession = "{{   session()->forget('user') }}";
    });

</script>

</body>
</html>
