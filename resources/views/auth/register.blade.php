@extends('frontend.layout.app')
@section('title','Register')

@push('css')
    <style>
        .pb-14 {
            padding-bottom: 14px;
        }

        .width-100 {
            width: 100%;
        }

        .select2-container--default .select2-selection--single {

            width: 100% !important;
            height: 36px !important;
            border: #ff6c2b solid 2px !important;
            background: transparent !important;
        }
    </style>
@endpush
@section('content')
    <div class="banner bannerRegister">
        <div class="container">
            <div class="col-md-6">

            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 bannerFields">
                <form action="{{ route('register') }}" method="POST" id="register_user">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 pb-14">
                            @if ($errors->any())
                                <p class="btn btn-danger width-100">Please fill all required fields</p>
                                {{--                    <ul>--}}
                                {{--                        @foreach ($errors->all() as $error)--}}
                                {{--                            <li>{{ $error }}</li>--}}
                                {{--                        @endforeach--}}
                                {{--                    </ul>--}}
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                                <label for="first_name">First Name<span>*</span></label>
                                <input id="first_name" type="text"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name" value="{{ old('first_name') }}"
                                       autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="last_name">Last Name<span>*</span></label>
                                <input id="last_name" type="text"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       name="last_name" value="{{ old('last_name') }}"
                                       autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email<span>*</span></label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="category_id">Gender<span>*</span></label>
                                <select id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" autocomplete="category_id">
                                    @if(!empty($categories))
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{ (old('category_id') == $category->id) ? 'selected' : ''}}>{{($category->id == 1) ? "Female" : "Male"}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="age">Age<span>*</span></label>
                                <select id="age" class="form-control @error('age') is-invalid @enderror"
                                        name="age"
                                        autocomplete="age">
                                    <option value="" {{ (old('age') == '') ? 'selected' : '' }}>Select
                                    </option>
                                    <option
                                        value="Below 18" {{ (old('age') == 'Below 18') ? 'selected' : '' }}>
                                        Below 18
                                    </option>
                                    <option
                                        value="18 - 24" {{ (old('age') == '18 - 24') ? 'selected' : '' }}>18
                                        - 24
                                    </option>
                                    <option
                                        value="25 - 34" {{ (old('age') == '25 - 34') ? 'selected' : '' }}>25
                                        - 34
                                    </option>
                                    <option
                                        value="35 - 44" {{ (old('age') == '35 - 44') ? 'selected' : '' }}>35
                                        - 44
                                    </option>
                                    <option
                                        value="45 - 60" {{ (old('age') == '45 - 60') ? 'selected' : '' }}>45
                                        - 60
                                    </option>
                                    <option value="60+" {{ (old('age') == '60+') ? 'selected' : '' }}>60+
                                    </option>
                                </select>

                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="phone_number">Mobile Number<span>*</span></label>
                                <input id="phone_number" type="text"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') }}"
                                       autocomplete="phone_number" autofocus placeholder="03001234567"
                                       pattern="[03]{2}[0-9]{9}"
                                       maxlength="11"
                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                       title="Phone number with 03 and remaing 9 digit with 0-9">

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="cnic">CNIC <span>*</span></label>
                                <input id="cnic" type="text"
                                       class="form-control cnic-mask @error('cnic') is-invalid @enderror"
                                       name="cnic"
                                       placeholder="_____-_______-_"
                                       value="{{ old('cnic') }}" autocomplete="email">
                                @error('cnic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="password">Create Password<span>*</span></label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password <span>*</span></label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="address">Address<span>*</span></label>
                                <input id="address" type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       name="address"
                                       value="{{ old('address') }}" autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="city_id">City <span>*</span> </label>
                                <select id="city_id" class="form-control cities @error('city_id') is-invalid @enderror"
                                        name="city_id" autocomplete="city_id">
                                    <option value="">Select</option>
                                    @if(!empty($cities))
                                        @foreach($cities as $city)
                                            <option
                                                value="{{$city->id}}" {{ (old('city_id') == $city->id) ? 'selected' : ''}}>{{$city->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="area_id">Area <span>*</span></label>
                                <select id="area_id"
                                        class="form-control areas @error('area_id') is-invalid @enderror"
                                        name="area_id"
                                        autocomplete="area_id">
                                </select>

                                @error('area_id')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{--                    @if(\Illuminate\Support\Facades\Cookie::has('referral_code'))--}}
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="referral-code-style"
                             style="display: @if(!is_null($referral_code)) block @else none @endif">
                            <div class="form-group">
                                <label for="referred_by">Referred By</label>
                                <input type="text" id="referred_by" name="referred_by" class="form-control"
                                       {{--                                           value="{{ (\Illuminate\Support\Facades\Cookie::get('referral_code')) ? \Illuminate\Support\Facades\Cookie::get('referral_code') :''}}"--}}
                                       value="{{ (!is_null($referral_code) ? $referral_code : '') }}"
                                       disabled>
                            </div>
                        </div>
                    </div>
                    {{--                    @endif--}}
                    <div class="form-group">
                        <button type="submit" class="btn buttonMain hvr-bounce-to-right">{{ __('Register') }}</button>
                    </div>
                </form>
                <div class="forgotArea">
                    <p>Already have an account? <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>


    </script>
    <script>

        var previous_value;

        $(document).ready(function () {

            $('.areas').select2({
                maximumInputLength: 20 // only allow terms up to 20 characters long
            });
            $('.cities').trigger('change');
            setTimeout(function () {
                previous_value = '{{ old('area_id') }}';
                $('#area_id option:selected').val('{{ old('area_id') }}');
            }, 1000);
        });
        $('#cnic').focusout(function () {
            cnic_no_regex = /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/;

            if (cnic_no_regex.test($(this).val())) {
            } else {

                $(this).val('');
            }
        });

        $('#phone_number').focusout(function () {
            if (/^(03)\d{9}$/.test($(this).val())) {
                // value is ok, use it
            }else {

            }
        });

        $('.cities').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.areas';
            var city_id = $(this).val();
            var request = "city_id=" + city_id;

            if (city_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.cityAreas') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.area, function (i, obj) {
                                html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            // $(node_to_modify).prepend("<option value='' selected>Select</option>");


                            $('.areas').find('option[value="{{ old('area_id') }}"]').attr('selected', 'selected');
                            $('.areas').trigger('change');

                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value='' selected>Select</option>");
            }
        });

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }


    </script>

@endpush
