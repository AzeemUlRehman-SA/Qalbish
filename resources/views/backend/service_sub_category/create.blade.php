@extends('layouts.master')
@section('title','Menu Items')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">{{ __('Menu Items') }}</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Menu Item') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.menu-items.store') }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name') }} <span class="mandatorySign">*</span></label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ old('name') }}"
                                                   autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="slug"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Slug') }} <span class="mandatorySign">*</span></label>
                                            <input id="slug" type="text"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   name="slug" value="{{ old('slug') }}"
                                                   autocomplete="slug" autofocus>

                                            @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="service_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Category') }} <span class="mandatorySign">*</span></label>

                                            <select id="service_id"
                                                    class="form-control services @error('service_id') is-invalid @enderror"
                                                    name="service_id" autocomplete="service_id">
                                                <option value="">Select an option</option>
                                                @if(!empty($services))
                                                    @foreach($services as $service)
                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('service_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_category_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Service') }} <span class="mandatorySign">*</span></label>

                                            <select id="service_category_id"
                                                    class="form-control service_category @error('service_category_id') is-invalid @enderror"
                                                    name="service_category_id" autocomplete="service_category_id">

                                            </select>

                                            @error('service_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="is_available"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                                            <select id="is_available"
                                                    class="form-control @error('is_available') is-invalid @enderror"
                                                    name="is_available" autocomplete="is_available">
                                                <option value="0">Non-Active</option>
                                                <option value="1" selected>Active</option>
                                            </select>

                                            @error('is_available')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Price') }} <span class="mandatorySign">*</span></label>
                                            <input id="price" type="number"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price" value="{{ old('price') }}"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   autocomplete="price" autofocus>

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="discount_type"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Discount Type') }}</label>

                                            <select id="discount_type"
                                                    class="form-control @error('discount_type') is-invalid @enderror"
                                                    name="discount_type" autocomplete="discount_type">
                                                <option value="">Select an option</option>
                                                <option value="fixed">Fixed</option>
                                                <option value="percentage">Percentage</option>
                                            </select>

                                            @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount_price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Discount Price') }}</label>
                                            <input id="discount_price" type="number"
                                                   class="form-control @error('discount_price') is-invalid @enderror"
                                                   name="discount_price" value="0"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   autocomplete="discount_price" autofocus>

                                            @error('discount_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="description"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Description') }} </label>

                                            <textarea id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      name="description" rows="5" cols="15"
                                                      value="{{ old('description') }}"
                                                      autocomplete="description"></textarea>

                                            @error('description')
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
                                    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-info">Back</a>
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
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' selected>Select Service</option>");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value='' selected>Select Service</option>");
            }
        });
    </script>
@endpush

@push('js')
    <script>
        $('#name').focusout(function () {

            var name = $(this).val();
            name = name.replace(/\s+/g, '-').toLowerCase();

            $('#slug').val(name);
        })
    </script>
@endpush
