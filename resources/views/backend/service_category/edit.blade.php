@extends('layouts.master')
@section('title','Services')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Edit {{ __('Service') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post"
                              action="{{ route('admin.services.update', $service_category->id) }}"
                              enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{!! $service_category->name !!}"
                                                   autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="slug"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Slug') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="slug" type="text"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   name="slug" value="{!! $service_category->slug !!}"
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
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Category') }}
                                                <span class="mandatorySign">*</span></label>

                                            <select id="service_id"
                                                    class="form-control @error('service_id') is-invalid @enderror"
                                                    name="service_id" autocomplete="service_id">
                                                <option value="">Select an option</option>
                                                @if(!empty($services))
                                                    @foreach($services as $service)
                                                        <option
                                                            value="{{$service->id}}" {{ ($service->id == $service_category->service_id) ? 'selected' : '' }}>{{$service->name}}</option>
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
                                            <label for="is_available"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                                            <select id="is_available"
                                                    class="form-control @error('is_available') is-invalid @enderror"
                                                    name="is_available" autocomplete="is_available">
                                                <option
                                                    value="0" {{ ($service_category->is_available == 0) ? 'selected' : ''  }}>
                                                    Non-Active
                                                </option>
                                                <option
                                                    value="1" {{ ($service_category->is_available == 1) ? 'selected' : ''  }}>
                                                    Active
                                                </option>
                                            </select>

                                            @error('is_available')
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
                                                <option
                                                    value="fixed" {!! ($service_category->discount_type == 'fixed') ? 'selected' : '' !!}>
                                                    Fixed
                                                </option>
                                                <option
                                                    value="percentage" {!! ($service_category->discount_type == 'percentage') ? 'selected' : '' !!}>
                                                    Percentage
                                                </option>
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
                                                   name="discount_price"
                                                   value="{!! $service_category->discount_price !!}"
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
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Description') }}
                                                <span class="mandatorySign">*</span></label>

                                            <textarea id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      name="description"
                                                      autocomplete="description">{{ $service_category->description }}</textarea>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="image"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Banner Image (1170 * 390)') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   onchange="readURL(this)"
                                                   name="image" style="padding: 9px; cursor: pointer" id="image"
                                                   value="{{$service_category->image}}">
                                            <img width="300" height="200" class="img-thumbnail"
                                                 style="display:{{($service_category->image) ? 'block' : 'none'}};"
                                                 id="img"
                                                 src="{{ asset('/uploads/service_category/'.$service_category->image) }}"
                                                 alt="your image"/>

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="thumbnail_image"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Thumbnail Image (350 * 270)') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input type="file"
                                                   class="form-control @error('thumbnail_image') is-invalid @enderror"
                                                   onchange="readURLThumbnail(this)"
                                                   name="thumbnail_image" style="padding: 9px; cursor: pointer" id="thumbnail_image"
                                                   value="{{$service_category->thumbnail_image}}">
                                            <img width="300" height="200" class="img-thumbnail"
                                                 style="display:{{($service_category->thumbnail_image) ? 'block' : 'none'}};"
                                                 id="img_thumbnail"
                                                 src="{{ asset('/uploads/service_category/thumbnails/'.$service_category->thumbnail_image) }}"
                                                 alt="your image"/>

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="meta_title"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Title') }} </label>

                                            <input id="meta_title" type="text"
                                                   class="form-control @error('meta_title') is-invalid @enderror"
                                                   name="meta_title"
                                                   value="{{$service_category->meta_title }}" autocomplete="meta_title">

                                            @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="meta_keywords"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Keywords') }}</label>

                                            <input id="meta_keywords" type="text"
                                                   class="form-control @error('meta_keywords') is-invalid @enderror"
                                                   name="meta_keywords"
                                                   value="{{ $service_category->meta_keywords }}"
                                                   autocomplete="meta_keywords">

                                            @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="meta_description"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Description') }}</label>

                                            <textarea id="meta_description"
                                                      class="form-control @error('meta_description') is-invalid @enderror"
                                                      name="meta_description"
                                                      value="{{ old('meta_description') }}"
                                                      autocomplete="meta_description">{{ $service_category->meta_description }}</textarea>

                                            @error('meta_description')
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
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-info">Back</a>
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
        $('#name').focusout(function () {

            var name = $(this).val();
            name = name.replace(/\s+/g, '-').toLowerCase();

            $('#slug').val(name);
        })
    </script>
@endpush


