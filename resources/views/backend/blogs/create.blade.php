@extends('layouts.master')
@section('title','Special Offers')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
{{--                <h3 class="m-subheader__title ">{{ __('Special Offers') }}</h3>--}}
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Special Offers') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.special-offers.store') }}" id="create"
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
                                                   name="name"
                                                   value="{{ old('name') }}" autocomplete="name">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_category_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Category') }} <span class="mandatorySign">*</span></label>

                                            <select id="service_category_id"
                                                    class="form-control cities @error('service_category_id') is-invalid @enderror"
                                                    name="service_category_id" autocomplete="service_category_id">
                                                <option value="">Select an option</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{$category->id}}" {{ (old('service_category_id') == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('service_category_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="description"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Description') }} <span class="mandatorySign">*</span></label>

                                            <textarea id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      name="description"
                                                      value="{{ old('description') }}"
                                                      autocomplete="description"></textarea>

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
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Image') }} <span class="mandatorySign">*</span></label>
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
                                        <div class="col-md-6">
                                            <label for="slug"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Slug') }} <span class="mandatorySign">*</span></label>

                                            <input id="slug" type="text"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   name="slug"
                                                   value="{{ old('slug') }}" autocomplete="slug">

                                            @error('slug')
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
                                                   value="{{ old('meta_title') }}" autocomplete="meta_title">

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
                                                   value="{{ old('meta_keywords') }}" autocomplete="meta_keywords">

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
                                                      autocomplete="meta_description"></textarea>

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
                                    <a href="{{ route('admin.special-offers.index') }}" class="btn btn-info">Back</a>
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
