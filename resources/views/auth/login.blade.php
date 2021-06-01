@extends('frontend.layout.app')
@section('title','Login')
@section('content')

    <div class="banner">
        <div class="container">
            <div class="col-md-6 col-sm-6"></div>
            <div class="col-md-6 col-sm-6 col-xs-12 bannerFields">
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone No <span>*</span></label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                               name="phone_number" id="phone_number" value="{{ old('phone_number') }}" maxlength="11"
                               autocomplete="phone_number" placeholder="03001234567" pattern="[03]{2}[0-9]{9}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                               title="Phone number with 03 and remaing 9 digit with 0-9"
                               autofocus
                        >
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span>*</span></label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn buttonMain hvr-bounce-to-right">Sign In</button>
                    </div>
                </form>
                <div class="forgotArea">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"> {{ __('Forgot Password?') }}</a>
                    @endif
                    <p>Don't have an account? <a href="{{ route('register') }}"> {{ __('Register') }}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>

        $('#phone_number').focusout(function () {
            if (/^(03)\d{9}$/.test($(this).val())) {
                // value is ok, use it
            } else {

            }


        });
    </script>
@endpush
