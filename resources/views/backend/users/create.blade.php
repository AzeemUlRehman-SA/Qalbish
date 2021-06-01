@extends('layouts.master')
@section('title','Users')
@push('css')
    <style>
        .show-shifts, .show-services {
            display: none;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('User') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.users.store') }}" id="create"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">

                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="first_name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('First Name') }}
                                                <span class="mandatorySign">*</span></label>
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

                                        <div class="col-md-6">
                                            <label for="last_name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Last Name') }}
                                                <span class="mandatorySign">*</span></label>
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
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}
                                                <span class="mandatorySign">*</span></label>

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
                                        <div class="col-md-6">
                                            <label for="cnic"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('CNIC') }} <span
                                                    class="mandatorySign">*</span></label>

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
                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="phone_number"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Mobile Number') }}
                                                <span class="mandatorySign">*</span></label>
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

                                        <div class="col-md-6">
                                            <label for="emergency_number"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Emergency Number') }}</label>
                                            <input id="emergency_number" type="text"
                                                   class="form-control @error('emergency_number') is-invalid @enderror"
                                                   name="emergency_number" value="{{ old('emergency_number') }}"
                                                   autocomplete="emergency_number" autofocus pattern="[03]{2}[0-9]{9}"
                                                   title="Phone number with 03 and remaing 9 digit with 0-9">

                                            @error('emergency_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Password') }}
                                                <span class="mandatorySign">*</span></label>

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
                                        <div class="col-md-6">

                                            <label for="password-confirm"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" autocomplete="new-password">

                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="address"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Address') }}
                                                <span class="mandatorySign">*</span></label>

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

                                        <div class="col-md-6">
                                            <label for="status"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Status') }} <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="status"
                                                    class="form-control cities @error('status') is-invalid @enderror"
                                                    name="status" autocomplete="status">
                                                <option value="" {{ (old('status') == '') ? 'selected' : '' }}>Select an
                                                    option
                                                </option>
                                                <option
                                                    value="pending" {{ (old('status') == 'pending') ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option
                                                    value="verified" {{ (old('status') == 'verified') ? 'selected' : '' }}>
                                                    Verified
                                                </option>
                                                <option
                                                    value="suspended" {{ (old('status') == 'suspended') ? 'selected' : '' }}>
                                                    Suspended
                                                </option>
                                            </select>

                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="city_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('City') }} <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="city_id"
                                                    class="form-control cities @error('city_id') is-invalid @enderror"
                                                    name="city_id" autocomplete="city_id">
                                                <option value="">Select an option</option>
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

                                        <div class="col-md-6">
                                            <label for="area_id"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Area') }}
                                                <span
                                                    class="mandatorySign">*</span></label>
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
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="dob"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Date of Birth') }}</label>
                                            <input id="dob" type="date"
                                                   class="form-control @error('dob') is-invalid @enderror"
                                                   name="dob" value="{{ old('dob') }}"
                                                   autocomplete="dob" autofocus>

                                            @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Age') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <select id="age" class="form-control @error('age') is-invalid @enderror"
                                                    name="age"
                                                    autocomplete="age">
                                                <option value="" {{ (old('age') == '') ? 'selected' : '' }}>SELECT Age
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
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="category_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Gender') }} <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="category_id"
                                                    class="form-control services @error('category_id') is-invalid @enderror"
                                                    name="category_id" autocomplete="category_id">
                                                @if(!empty($categories))
                                                    <option value="">Select an option</option>
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
                                        <div class="col-md-6">
                                            <label for="role_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Role') }} <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="role_id"
                                                    class="form-control roles @error('role_id') is-invalid @enderror"
                                                    name="role_id" autocomplete="role_id">
                                                <option value="">Select an role</option>
                                                @if(!empty($roles))
                                                    @foreach($roles as $role)
                                                        @if($role->id != '1')
                                                            <option
                                                                value="{{$role->id}}" {{ (old('role_id') == $role->id) ? 'selected' : '' }}>{{ucfirst($role->name)}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row ">
                                        <div id="error_services"
                                             class="col-md-6 @if($errors->has('service_category_id.0'))  @else show-services @endif">
                                            <label for="service_category_id.0"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Service') }}</label>

                                            <select id="service_category_id.0"
                                                    class="form-control service_category @error('service_category_id.0') is-invalid @enderror js-example-basic-multiple"
                                                    name="service_category_id[]" autocomplete="service_category_id.0"
                                                    multiple="multiple">

                                            </select>

                                            @error('service_category_id.0')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 @if($errors->has('shifts'))  @else show-shifts @endif"
                                             id="error-shifts">
                                            <label for="shifts"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Shift') }}</label>

                                            <select id="shifts"
                                                    class="form-control @error('shifts') is-invalid @enderror"
                                                    name="shifts" autocomplete="shifts">
                                                <option value="" {{ (old('shifts') == '') ? 'selected' : '' }}>SELECT an
                                                    option
                                                </option>
                                                <option
                                                    value="morning" {{ (old('shifts') == 'morning') ? 'selected' : '' }}>
                                                    Morning
                                                </option>
                                                <option
                                                    value="evening" {{ (old('shifts') == 'evening') ? 'selected' : '' }}>
                                                    Evening
                                                </option>
                                                <option
                                                    value="night" {{ (old('shifts') == 'night') ? 'selected' : '' }}>
                                                    Night
                                                </option>
                                            </select>

                                            @error('shifts')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="image"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Image') }}</label>
                                            <input value="{{old('image')}}" type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   onchange="readURL(this)" id="image"
                                                   name="image" style="padding: 9px; cursor: pointer">
                                            <img width="300" height="200" class="img-thumbnail" style="display:none;"
                                                 id="img" src="#"
                                                 alt="your image"/>

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit text-md-right">
                                <div class="m-form__actions m-form__actions">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script>


        $(document).ready(function () {
            $('.areas').select2({
                maximumInputLength: 20 // only allow terms up to 20 characters long
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

            $('.cities').trigger('change');
            setTimeout(function () {
                previous_value= '{{ old('area_id') }}';
                $('#area_id option:selected').val('{{ old('area_id') }}');
            }, 2000);
            $('.services').trigger('change');

            var previous_role_id = '{{old('role_id') }}';

            if (previous_role_id == '2') {
                $('.show-shifts').css('display', 'block');
                $('#error-shifts').show();
                $('#error_services').show();
                $('.show-services').css('display', 'block');
            } else if (previous_role_id == '4') {
                $('.show-shifts').css('display', 'block');
                $('.show-services').css('display', 'none');

                $('#error-shifts').show();
                $('#error_services').hide();
            } else {
                $('.show-shifts').hide();
                $('.show-services').hide();
                $('#error-shifts').hide();
                $('#error_services').hide();
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
                                html += '<option value="' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' selected>Select Area</option>");



                            $('.areas').find('option[value="{{ old('area_id') }}"]').attr('selected','selected');
                            $('.areas').trigger('change');
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value='' selected>Select Area</option>");
            }
        });
        $('#role_id').change(function (e) {
            e.preventDefault();

            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.areas';
            var role_id = $(this).val();

            if (role_id === '2') {
                $('.show-shifts').css('display', 'block');
                $('#error-shifts').show();
                $('#error_services').show();
                $('.show-services').css('display', 'block');
            } else if (role_id === '4') {
                $('.show-shifts').css('display', 'block');
                $('.show-services').css('display', 'none');

                $('#error-shifts').show();
                $('#error_services').hide();
            } else {

                $('.show-shifts').hide();
                $('.show-services').hide();
                $('#error-shifts').hide();
                $('#error_services').hide();
            }
        });
        $('.services').change(function () {
            node_to_modify_services = '.service_category';
            var service_id = $(this).val();
            var request = "service_id=" + service_id;

            if (service_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.serviceCategory') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify_services).html(html);
                            $(node_to_modify_services).prepend("<option value='' disabled>Select Service</option>");

                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify_services).html("<option value='' disabled>Select Service</option>");
            }
        });
    </script>
    <script>
        $('.js-example-basic-multiple').select2();
    </script>
@endpush
