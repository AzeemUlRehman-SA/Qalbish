<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8"/>
    <title>SPA AT HOME | Dashboard</title>
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

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}"/>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth()->user()->fullName() }}<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="{{asset('vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<script src="{{asset('vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--begin::Page Vendors -->
<script src="{{asset('vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->
<script src="{{asset('redactor/redactor.min.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script>


<script type="text/javascript" src="{{ asset('frontend/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>

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
