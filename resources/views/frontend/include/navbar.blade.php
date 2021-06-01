<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header customLogo">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('frontend/images/logo.png') }}"
                                                                     alt=""></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">

                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ route('index') }}">Home
                    </a>
                </li>
                @guest
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{ route('login') }}"
                                                       class=" {{ (request()->is('login')) ? 'active' : '' }}">Login</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{ route('register') }}"
                                                       class="{{ (request()->is('register')) ? 'active' : '' }}">Register</a>
                    </li>
                @endguest
                @if(auth()->check() && auth()->user()->user_type  == 'customer')
                    <li class="{{ (request()->is('services')) ? 'active' : '' }} hidden-xs"><a href="{{ route('service') }}">Services
                            & Packages</a></li>
                    <li class="{{ (request()->is('services')) ? 'active' : '' }} hidden-lg hidden-md hidden-sm"><a href="{{ route('service') }}" >Packages</a>
                    </li>
                    <li class="{{ (request()->is('services')) ? 'active' : '' }} hidden-lg hidden-md hidden-sm"><a href="{{ route('service') }}">Services</a></li>



                @else
                    <li class="{{ (request()->is('services')) ? 'active' : '' }}"><a href="{{ route('service') }}">Services</a>
                    </li>
                @endif






                @if(auth()->check() && auth()->user()->user_type  == 'customer')
                    <li class="{{ (request()->is('customer/referrals')) ? 'active' : '' }}"><a
                            href="{{ route('customer.user.referral') }}">Refer a Friend</a></li>
                @else
                    <li class="{{ (request()->is('packages')  || request()->is('packages/*')) ? 'active' : '' }}"><a href="{{ route('packages') }}">Packages</a>
                    </li>
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="{{ (request()->is('about-us')) ? 'active' : '' }}"><a href="{{ route('aboutus.detail') }}">About
                        Us</a>
                </li>
                @auth

                @if(auth()->user()->hasRole('admin'))
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a href="{{ route('admin.dashboard.index') }}"
                           class="profileImage {{ (request()->is('about-us')) ? 'active' : '' }}"
                           title="{{ auth()->user()->fullName() }}">Dashboard
                        </a>
                    </li>
                @elseif(auth()->user()->hasRole('customer'))
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a href="{{ route('customer.order.history') }}"
                           class="profileImage {{ (request()->is('customer/order-history')) ? 'active' : '' }}"
                           title="Orders">Orders
                        </a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a href="{{ route('customer.profile.index') }}"
                           class="profileImage {{ (request()->is('customer/profile/*')) ? 'active' : '' }}"
                           title="Profile">Profile
                        </a>
                    </li>


                @endif
                @endauth

                {{--                <li class="{{ (request()->is('blogs')) ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a></li>--}}
                <li class="{{ (request()->is('memberships')) ? 'active' : '' }}"><a href="{{ route('memberships') }}">Membership</a>
                </li>
                <li class="{{ (request()->is('contacts')) ? 'active' : '' }} hidden-xs"><a href="{{ route('contacts.create') }}">Contact</a>
                </li>
                @auth
                <li class="hidden-lg hidden-md hidden-sm">
                    <a href="{{ route('logout') }}" class="btn buttonMain hvr-bounce-to-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endauth

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
