@extends('layouts.master')
@section('title','Settings')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('Settings') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post"
                              action="{{ route('admin.settings.update', $setting->id) }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            @method('patch')
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">
                                        <div class="col-md-6">

                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name"
                                                   value="{{ ($setting) ? $setting->name : '' }}"
                                                   autocomplete="title" autofocus disabled>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">

                                            <label for="value"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Value') }}</label>
                                            <input id="value" type="text"
                                                   class="form-control @error('value') is-invalid @enderror"
                                                   name="value"
                                                   value="{{ ($setting) ? $setting->value : '' }}"
                                                   autocomplete="value" autofocus>

                                            @error('value')
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
