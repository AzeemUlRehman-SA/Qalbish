@extends('frontend.layout.app')
@section('title','Forgot Password')

@push('css')
    <style>
        .input-codes {
            width: 15%;
            height: 37px;
            text-align: center;
            font-weight: 500;
            font-size: 22px;
        }
    </style>
@endpush
@section('content')
    <div class="banner">
        <div class="container">
            <div class="col-md-6"></div>
            <div class="col-md-6 col-sm-6 col-xs-12 bannerFields">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="javascript:void(0)" id="forget-password">
                    @csrf
                    <div class="form-group ">
                        <label for="phone_number">{{ __('Phone Number') }}<span>*</span></label>
                        <input id="phone_number" type="tel"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               name="phone_number" value="{{ old('phone_number') }}" required
                               autocomplete="phone_number" pattern="[03]{2}[0-9]{9}"
                               title="Phone number with 03 and remaing 9 digit with 0-9"
                               autofocus>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit"
                                class="btn buttonMain hvr-bounce-to-right">{{ __('Send') }}</button>
                    </div>
                </form>
                <form method="POST" action="javascript:void(0)" id="otp-send" style="display: none">
                    <input type="hidden" value="0" name="mobile_number" id="mobile_number">
                    @csrf
                    <div class="form-group OTP-Codes">
                        <label for="otp_code" style="display: block">{{ __('Enter 4 Digit OTP Number') }}<span>*</span></label>
                        <input type="text" class="input-codes" id="otp_code1" name="otp_code1"/>
                        <input type="text" class="input-codes" id="otp_code2" name="otp_code2"/>
                        <input type="text" class="input-codes" id="otp_code3" name="otp_code3"/>
                        <input type="text" class="input-codes" id="otp_code4" name="otp_code4"/>
                        <input id="otp_code" type="hidden"
                               class="form-control @error('otp_code') is-invalid @enderror"
                               name="otp_code" value="{{ old('otp_code') }}" required
                               autocomplete="otp_code" autofocus>
                        @error('otp_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit"
                                class="btn buttonMain hvr-bounce-to-right">{{ __('Verify') }}</button>
                    </div>
                </form>
                <form method="POST" action="javascript:void(0)" id="password-reset" style="display: none">
                    @csrf
                    <div class="form-group ">
                        <input type="hidden" value="" name="mobile_number" id="mobile_number_forget">
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
@push('js')
    <script>

        $(function () {
            'use strict';

            var body = $('body');

            function goToNextInput(e) {
                var key = e.which,
                    t = $(e.target),
                    sib = t.next('input');
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((e.which < 48 || e.which > 57)) {
                    e.preventDefault();
                    return false;
                }

                sib.select().focus();
            }


            function onFocus(e) {
                $(e.target).select();
            }

            body.on('keypress keyup blur', 'input[name=otp_code1]', goToNextInput);
            body.on('keypress keyup blur', 'input[name=otp_code2]', goToNextInput);
            body.on('keypress keyup blur', 'input[name=otp_code3]', goToNextInput);
            body.on('keypress keyup blur', 'input[name=otp_code4]', goToNextInput);
            body.on('click', 'input', onFocus);

        });


        $('#forget-password').submit(function (e) {
            $('#mobile_number').val($('#phone_number').val());
            e.preventDefault();
            let form = $(this);
            var request = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('otp.send') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {
                    toastr['success'](response.message);


                    $('#forget-password').css('display', 'none');
                    $('#otp-send').css('display', 'block');

                },
                error: function () {
                    toastr['error']("Something Went Wrong.");
                }
            });

        });

        $('#otp-send').submit(function (e) {
            $('#mobile_number_forget').val($('#mobile_number').val());

            $('#otp_code').val($('#otp_code1').val() + '' + $('#otp_code2').val() + '' + $('#otp_code3').val() + '' + $('#otp_code4').val());

            e.preventDefault();
            let form = $(this);
            var request = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('verify.otp') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#forget-password').css('display', 'none');
                        $('#otp-send').css('display', 'none');
                        $('#password-reset').css('display', 'block');
                    } else {
                        toastr['error'](response.message);
                    }


                },
                error: function (e) {

                    toastr['error'](e.responseJSON.error.otp_code);
                }
            });

        });

        $('#password-reset').submit(function (e) {
            $('#mobile_number_forget').val($('#mobile_number').val());

            $('#otp_code').val($('#otp_code1').val() + '' + $('#otp_code2').val() + '' + $('#otp_code3').val() + '' + $('#otp_code4').val());

            e.preventDefault();
            let form = $(this);
            var request = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('otp.password.reset') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {
                    if (response.status == 'success') {
                        toastr['success'](response.message);
                        setTimeout(function () {
                            window.location.href = '{{ route('login') }}';
                        }, 2000)
                    } else {
                        toastr[response.status](response.message);
                    }


                },
                error: function (e) {
                    $.each(e.responseJSON.error, function (index, object) {
                        toastr['error'](object);
                    });


                }
            });

        });
    </script>
@endpush
