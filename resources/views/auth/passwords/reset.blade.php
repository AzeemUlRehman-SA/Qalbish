@extends('frontend.layout.app')
@section('title','Reset Password')
@section('content')

    <div class="banner">
        <div class="container">
            <div class="col-md-6"></div>
            <div class="col-md-6 col-sm-6 col-xs-12 bannerFields">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group ">
                        <label for="email">{{ __('E-Mail Address') }}<span>*</span></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                               autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="password">{{ __('Password') }}<span>*</span></label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="password-confirm">{{ __('Confirm Password') }}<span>*</span></label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button type="submit"
                                class="btn buttonMain hvr-bounce-to-right">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
