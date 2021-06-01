@php
    $settings =\App\Models\Setting::all();

    // Current Time Zone
    //$mytime = Carbon\Carbon::now()->timezone('Asia/Karachi');
    // dd($mytime->toDateTimeString());

@endphp
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="responsiveLogo">
                <a href="{{ route('index') }}"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-7 topbarLeft">
                <ul class="list-unstyled list-inline">
                    <li><a href="mailto:{{$settings[1]->value}}"><i class="fa fa-envelope"></i> {{$settings[1]->value}}
                        </a></li>
                    <li><a href="tel:{{$settings[0]->value}}"><i class="fa fa-phone"></i> {{$settings[0]->value}}</a>
                    </li>
                    <li><a href="{{$settings[8]->value}}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                    <li><a href="{{$settings[9]->value}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="{{$settings[10]->value}}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                </ul>
            </div>
            @guest
                <div class="col-md-6 col-sm-6 col-xs-5 topbarRight  hidden-xs">
                    <a href="{{ route('login') }}" class="btn buttonMain hvr-bounce-to-right">Login</a>
                    <a href="{{ route('register') }}" class="btn buttonMain hvr-bounce-to-right">Register</a>
                </div>
            @endguest

            @auth
                <div class="col-md-6 col-sm-6 col-xs-5 topbarRight  hidden-xs">

                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn buttonMain hvr-bounce-to-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome {{ auth()->user()->first_name }}    <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            @if(auth()->user()->hasRole('admin'))
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                            @elseif(auth()->user()->hasRole('customer'))
                                <li><a class="dropdown-item" href="{{ route('customer.order.history') }}">Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.profile.index') }}">Profile</a></li>
                            @endif
                            <div class="dropdown-divider"></div>
                                <li><a href="{{ route('logout') }}" class="dropdown-item"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>

                    {{--                    <a href="#" class="profileImage"><img--}}
                    {{--                            src="{{ asset('uploads/user_profiles/'.auth()->user()->profile_pic) }}" alt=""></a>--}}
{{--                    @if(auth()->user()->hasRole('admin'))--}}
{{--                        <a href="{{ route('admin.dashboard.index') }}" class="profileImage"--}}
{{--                           title="{{ auth()->user()->fullName() }}"><img--}}
{{--                                src="{{ asset('uploads/user_profiles/'.auth()->user()->profile_pic) }}" alt=""></a>--}}
{{--                    @elseif(auth()->user()->hasRole('customer'))--}}
{{--                        <a href="{{ route('customer.dashboard.index') }}" class="profileImage"--}}
{{--                           title="{{ auth()->user()->fullName() }}"><img--}}
{{--                                src="{{ asset('uploads/user_profiles/'.auth()->user()->profile_pic) }}" alt=""></a>--}}
{{--                    @endif--}}

                </div>
            @endauth
        </div>
    </div>
</div>
