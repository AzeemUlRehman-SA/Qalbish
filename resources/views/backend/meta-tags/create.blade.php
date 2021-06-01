@extends('layouts.master')

@section('title','Meta Tags')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">{{ __('Meta Tags') }}</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Meta Tags') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.meta-tags.store') }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="route"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Route') }} <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="route"
                                                    class="form-control @error('route') is-invalid @enderror"
                                                    name="route" autocomplete="route">
                                                <option value="">Select an option</option>
                                                <option value="index">Index</option>
                                                <option value="service">Service</option>
                                                <option value="blog">Blog</option>
                                                <option value="aboutus.detail">About Us</option>
                                                <option value="packages">Packages</option>
                                                <option value="memberships">Memberships</option>
                                                <option value="contacts">Contact Us</option>

                                            </select>

                                            @error('route')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="title"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Title') }} <span
                                                    class="mandatorySign">*</span></label>
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

                                        <div class="col-md-4">
                                            <label for="keywords"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Keywords') }}
                                                <span class="mandatorySign">*</span></label>
                                            <input id="keywords" type="text"
                                                   class="form-control @error('keywords') is-invalid @enderror"
                                                   name="keywords" value="{{ old('keywords') }}"
                                                   autocomplete="keywords" autofocus>

                                            @error('keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-12">


                                            <label for="description"
                                                   class="col-md-4 col-form-label text-md-left">Description <span
                                                    class="mandatorySign">*</span></label>

                                            <textarea name="description" id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      rows="10"
                                                      cols="80"></textarea>

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
                                    <a href="{{ route('admin.meta-tags.index') }}" class="btn btn-info">Back</a>
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
