@php
    $settings =\App\Models\Setting::all();
@endphp

<footer>
    <div class="container">
        <div class="col-md-4 col-sm-4 col-xs-6">
            <img src="{{ asset('frontend/images/footerLogo.png') }}" alt="">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li><a href="mailto:{{$settings[1]->value}}"><i
                                    class="fa fa-envelope"></i> {{$settings[1]->value}}</a></li>
                        <li><a href="tel:{{$settings[0]->value}}"><i class="fa fa-phone"></i> {{$settings[0]->value}}
                            </a></li>
                    </ul>
                    <ul class="list-unstyled list-inline">
                        <li><a href="{{$settings[8]->value}}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a href="{{$settings[9]->value}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{$settings[10]->value}}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 quickLinks">
            <h3>Quick Links</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('aboutus.detail') }}">About</a></li>
                <li><a href="{{ route('service') }}">Services</a></li>
                <li><a href="{{ route('blog') }}">Special Offers</a></li>
                <li><a href="{{ route('contacts.create') }}">Contact</a></li>

                @if(auth()->check() && auth()->user()->user_type  == 'customer')
                    <li><a href="{{ route('service') }}">Packages</a></li>
                @else
                    <li><a href="{{ route('packages') }}">Packages</a></li>
                @endif
                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>

            </ul>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 footerLastArea">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <img src="{{ asset('frontend/images/footerMob.png') }}" alt="">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8 footerLastAreaImages">
                <h3>Qalbish</h3>
{{--                <h4>Download App Now</h4>--}}
                <h4>App Coming Soon</h4>
                <a href="#"><img src="{{ asset('frontend/images/appStore.png') }}" alt="AppStore"></a>
                <a href="#"><img src="{{ asset('frontend/images/googlePlay.png') }}" alt="GooglePlay"></a>
            </div>
        </div>
    </div>
</footer>
