<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>Qalbish | @yield('title')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{asset('vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{asset('demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    {{--   Custom CSS --}}
    <link href="{{asset('demo/default/base/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('demo/default/base/components.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->

    <link href="{{asset('redactor/redactor.min.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->

    <!--begin::Page Vendors Styles -->
    <link href="{{asset('vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>

    <!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Page Vendors Styles -->
{{--    <link rel="shortcut icon" href="{{asset('demo/default/media/img/logo/favicon.ico')}}"/>--}}
    @stack('css')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">


    <!-- BEGIN: Header -->
@include('customer.includes.header')
<!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
    @include('customer.includes.sidebar')
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- begin::Footer -->
@include('customer.includes.footer')
<!-- end::Footer -->
</div>
@stack('models')
<script src="{{asset('vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<script src="{{asset('vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--begin::Page Vendors -->
<script src="{{asset('vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->
<script src="{{asset('redactor/redactor.min.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<!--end::Page Scripts -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                $('#img').attr('src', e.target.result);

                $('#img').css("display", "block");
                $('#hidden-field').val('');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function confirmDelete() {
        var r = confirm("Are you sure you want to perform this action");
        if (r === true) {
            return true;
        } else {
            return false;
        }
    }
</script>
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
@stack('js')

</body>
</html>
