@extends('layouts.master')
@section('title','Profile')
@push('css')
    <style>
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #fcefe1;
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="">
                <div class="">
                    <div class="m-portlet">
                        <div class="container">
                            <div class="m-portlet__body">
                                <div class="serviceBoxMain">
                                    <div class="serverInnerDetails">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12 bannerFields">
                                                <h4>Edit Profile</h4>
                                                <form action="{{ route('admin.update.user.profile') }}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="first_name">First Name</label>
                                                                <input type="text" id="first_name" name="first_name"
                                                                       class="form-control"
                                                                       value="{{ $user->first_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="last_name">Last Name</label>
                                                                <input type="text" class="form-control"
                                                                       name="last_name" id="last_name"
                                                                       value="{{ $user->last_name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email"
                                                                       name="email" value="{{ $user->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-12">--}}
{{--                                                            <h4>General Profile</h4>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" class="form-control disabledDiv"
                                                                       name="address" id="address"
                                                                       value="{{ $user->address }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="city_id">City </label>
                                                                <select class="form-control cities "
                                                                        name="city_id"
                                                                        id="city_id">
                                                                    @foreach($cities as $city)
                                                                        <option
                                                                            value="{{ $city->id }}" {{ ($city->id == $user->city_id) ? 'selected' : ''}}>{{ ucfirst($city->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="area_id">Area </label>
                                                                <select class="form-control areas "
                                                                        id="area_id"
                                                                        name="area_id">
                                                                    @foreach($areas as $area)
                                                                        <option
                                                                            value="{{ $area->id }}" {{ ($area->id == $user->area_id) ? 'selected' : ''}}>{{ ucfirst($area->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="category_id">Gender </label>
                                                                <select class="form-control" name="category_id"
                                                                        id="category_id">
                                                                    @foreach($categories as $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{ ($category->id == $user->category_id) ? 'selected' : ''}}>{{ ucfirst($category->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="cnic">CNIC </label>
                                                                <input type="text" class="form-control " name="cnic"
                                                                       id="cnic" value="{{ $user->cnic }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="age">Age</label>
                                                                <select id="age"
                                                                        class="form-control @error('age') is-invalid @enderror"
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
                                                                    <option
                                                                        value="60+" {{ ($user->age == '60+')  ? 'selected' : '' }}>
                                                                        60+
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                            <a href="{{ route('admin.profile.index') }}"
                                                               class="btn buttonMain hvr-bounce-to-right">
                                                                Cancel
                                                            </a>
                                                            <button type="submit"
                                                                    class="btn buttonMain hvr-bounce-to-right">Save
                                                                Changes
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

    <script>

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
@endpush
