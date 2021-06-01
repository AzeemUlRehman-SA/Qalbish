@extends('layouts.master')
@section('title','Partners')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Managing Partener') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.managing-parteners.store') }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">

                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="title"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Title') }} <span class="mandatorySign">*</span></label>
                                            <input id="title" type="text"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   name="title" value="{{ old('title') }}"
                                                   autocomplete="title" autofocus>

                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="designation"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Designation') }} <span class="mandatorySign">*</span></label>
                                            <input id="designation" type="text"
                                                   class="form-control @error('designation') is-invalid @enderror"
                                                   name="designation" value="{{ old('designation') }}"
                                                   autocomplete="designation" autofocus>

                                            @error('designation')
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
                                    </div>

                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit text-md-right">
                                <div class="m-form__actions m-form__actions">
                                    <a href="{{ route('admin.managing-parteners.index') }}"
                                       class="btn btn-info">Back</a>
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
@endpush
