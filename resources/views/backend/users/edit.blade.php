@extends('layouts.master')
@section('title','Users')
@push('css')
    <style>
        .modal .modal-content .modal-header {

            background: #f1743b !important;
        }

        .modal .modal-content .modal-header .modal-title {
            color: #fff !important;
        }


        .button-right {
            float: right;
            margin-top: 12px;
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
                            Edit {{ __('User') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">

                            <button type="button"
                                    class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                    data-toggle="modal" data-target="#addLocation{{$user->id}}">Add Location
                            </button>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.users.update',$user->id) }}"
                              id="create"
                              enctype="multipart/form-data" role="form">
                            @method('patch')
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
                                                   name="first_name" value="{{ $user->first_name }}"
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
                                                   name="last_name" value="{{ $user->last_name }}"
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
                                                   value="{{ $user->email }}" autocomplete="email">

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
                                                   value="{{ $user->cnic }}" autocomplete="email">

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
                                                   name="phone_number" value="{{ $user->phone_number }}"
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
                                                   name="emergency_number" value="{{ $user->emergency_number }}"
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
                                            <label for="dob"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Date of Birth') }}</label>
                                            <input id="dob" type="date"
                                                   class="form-control @error('dob') is-invalid @enderror"
                                                   name="dob" value="{{ $user->dob }}"
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
                                                <option value="">SELECT DATE OF BIRTH</option>
                                                <option
                                                    value="Below 18" {{ ($user->age == 'Below 18')  ? 'selected' : '' }}>
                                                    Below 18
                                                </option>
                                                <option
                                                    value="18 - 24" {{ ($user->age == '18 - 24')  ? 'selected' : '' }}>
                                                    18 - 24
                                                </option>
                                                <option
                                                    value="25 - 34" {{ ($user->age == '25 - 34')  ? 'selected' : '' }}>
                                                    25 - 34
                                                </option>
                                                <option
                                                    value="35 - 44" {{ ($user->age == '35 - 44')  ? 'selected' : '' }}>
                                                    35 - 44
                                                </option>
                                                <option
                                                    value="45 - 60" {{ ($user->age == '45 - 60')  ? 'selected' : '' }}>
                                                    45 - 60
                                                </option>
                                                <option value="60+" {{ ($user->age == '60+')  ? 'selected' : '' }}>60+
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
                                            <label for="address"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Address') }}
                                                <span class="mandatorySign">*</span></label>

                                            <input id="address" type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   name="address"
                                                   value="{{ $user->address }}" autocomplete="address">

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
                                                <option value="">Select an option</option>
                                                <option
                                                    value="pending" {{ ($user->status == 'pending') ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option
                                                    value="verified" {{ ($user->status == 'verified') ? 'selected' : '' }}>
                                                    Verified
                                                </option>
                                                <option
                                                    value="suspended" {{ ($user->status == 'suspended') ? 'selected' : '' }}>
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
                                                            value="{{$city->id}}" {{ ($user->city_id == $city->id) ? 'selected' : '' }}>{{$city->name}}</option>
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
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Area') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <select id="area_id"
                                                    class="form-control areas @error('area_id') is-invalid @enderror"
                                                    name="area_id"
                                                    autocomplete="area_id">
                                                @if(!empty($areas))
                                                    @foreach($areas as $area)
                                                        <option
                                                            value="{{ $area->id }}" {{ ($area->id == $user->area_id) ? 'selected' : ''}}>
                                                            {{ $area->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
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
                                                            value="{{$category->id}}" {{ ($user->category_id == $category->id) ? 'selected' : ''}}>{{($category->id == 1) ? "Female" : "Male"}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('gender')
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
                                                @if(!empty($user->roles))
                                                    @foreach($user->roles as $role)
                                                        <option
                                                            value="{{$role->id}}" {{ ($role->id == $user->role_id) ? 'selected' : ''}}
                                                        >{{ucfirst($role->name)}}</option>
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
                                    <div class="form-group row">
                                        @if(($user->role_id == 2 && !is_null($user->staff)))
                                            <div class="col-md-6 @if($errors->has('shifts'))  @else show-shifts @endif ">
                                                <label for="shifts"
                                                       class="col-md-4 col-form-label text-md-left">{{ __('Shift') }}
                                                    <span class="mandatorySign">*</span></label>
                                                <select id="shifts" class="form-control @if('shifts') is-invalid @enderror" name="shifts" autocomplete="shifts">
                                                    <option value="" {{ (old('shifts') == '') ? 'selected' : '' }}>
                                                        SELECT an
                                                        option
                                                    </option>
                                                    <option
                                                        value="morning" {{ ($user->staff->shifts == 'morning') ? 'selected' : '' }}>
                                                        Morning
                                                    </option>
                                                    <option
                                                        value="evening" {{ ($user->staff->shifts == 'evening') ? 'selected' : '' }}>
                                                        Evening
                                                    </option>
                                                    <option
                                                        value="night" {{ ($user->staff->shifts == 'night') ? 'selected' : '' }}>
                                                        Night
                                                    </option>
                                                </select>

                                                @error('shifts')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @elseif(($user->role_id == 4 && !is_null($user->staff)))
                                            <div class="col-md-6 @if($errors->has('shifts'))  @else show-shifts @endif ">
                                                <label for="shifts"
                                                       class="col-md-4 col-form-label text-md-left">{{ __('Shift') }}
                                                    <span class="mandatorySign">*</span></label>

                                                <select id="shifts"
                                                        class="form-control @error('shifts') is-invalid @enderror"
                                                        name="shifts" autocomplete="shifts">
                                                    <option value="" {{ (old('shifts') == '') ? 'selected' : '' }}>
                                                        SELECT an
                                                        option
                                                    </option>
                                                    <option
                                                        value="morning" {{ ($user->staff->shifts == 'morning') ? 'selected' : '' }}>
                                                        Morning
                                                    </option>
                                                    <option
                                                        value="evening" {{ ($user->staff->shifts == 'evening') ? 'selected' : '' }}>
                                                        Evening
                                                    </option>
                                                    <option
                                                        value="night" {{ ($user->staff->shifts == 'night') ? 'selected' : '' }}>
                                                        Night
                                                    </option>
                                                </select>

                                                @error('shifts')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>

                                        @endif
                                        @if($user->staff)
                                            <div class="col-md-6">
                                                <label for="service_category_id.0"
                                                       class="col-md-4 col-form-label text-md-left">{{ __('Service') }}
                                                    <span class="mandatorySign">*</span></label>
                                                <select id="service_category_id.0"
                                                        class="form-control service_category @error('service_category_id.0') is-invalid @enderror js-example-basic-multiple"
                                                        name="service_category_id[]"
                                                        autocomplete="service_category_id.0"
                                                        multiple="multiple">

                                                    @foreach($services as $service)

                                                        <option value="{{ $service->id }}"
                                                                @foreach($user->staff->categories as $category)
                                                                @if($category->id == $service->id)
                                                                selected
                                                            @endif
                                                            @endforeach
                                                        > {{ $service->name }}</option>
                                                    @endforeach

                                                </select>

                                                @error('service_category_id.0')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endif

                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="image"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Image') }}</label>
                                            <input value="{{old('image')}}" type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   onchange="readURL(this)" id="image"
                                                   name="image" style="padding: 9px; cursor: pointer">
                                            <img width="300" height="200" class="img-thumbnail"
                                                 style="display:{{($user->profile_pic) ? 'block' : 'none'}};"
                                                 id="img"
                                                 src="{{ asset('/uploads/user_profiles/'.$user->profile_pic) }}"
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
@push('models')

    <div id="addLocation{{$user->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <form action="{{ route('admin.user.location') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                    <input type="hidden" id="address-input" name="current_address"
                                           class="form-control map-input"
                                           value="@if(!is_null($user->current_address))
                                           {{ $user->current_address }}
                                           @else
                                           {{ $user->area->name }},{{ $user->city->name }},546000,Pakistan
                                           @endif">
                                    <input type="hidden" name="latitude" id="address-latitude"
                                           value="{{ $user->latitude ?? 0 }}"/>
                                    <input type="hidden" name="longitude" id="address-longitude"
                                           value="{{ $user->longitude ?? 0 }}"/>
                                </div>
                                <div id="address-map-container" style="width:100%;height:400px; ">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>

                                <button type="submit"
                                        class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air button-right">
                                    SAVE
                                </button>
                            </form>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>
@endpush

@push('js')
    <script src="{{ asset('js/mapInput.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZQiMEU1xYMEVTgch8O5WmL-iZVfQjko0&libraries=places&callback=initialize"
        async defer></script>

    <script>


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
    </script>
    <script>
        $('.services').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.service_category';
            var service_id = $(this).val();
            var request = "service_id=" + service_id;

            if (service_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.serviceCategory') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    processData: false,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' disabled>Select Service</option>");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value='' disabled>Select Service</option>");
            }
        });
        $('.js-example-basic-multiple').select2();
    </script>

@endpush
