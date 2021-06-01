@extends('layouts.master')
@section('title','Contact Us')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Contact') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.contacts.store') }}" id="create"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="full_name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name *') }}</label>

                                            <input id="full_name" type="text"
                                                   class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                                   value="{{ old('full_name') }}" autocomplete="full_name">

                                            @error('full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Email *') }}</label>

                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="nature_of_contact"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Nature of Contact *') }}</label>

                                            <select id="nature_of_contact"
                                                    class="form-control cities @error('nature_of_contact') is-invalid @enderror"
                                                    name="nature_of_contact" autocomplete="nature_of_contact">
                                                <option value="">Select an option</option>
                                                <option
                                                    value="Suggestion" {{ (old('nature_of_contact') == 'Suggestion') ? 'selected' : ''}}>
                                                    Suggestion
                                                </option>
                                                <option
                                                    value="Bug Report" {{ (old('nature_of_contact') == 'Bug Report') ? 'selected' : ''}}>
                                                    Bug Report
                                                </option>
                                                <option
                                                    value="Complaint" {{ (old('nature_of_contact') == 'Complaint') ? 'selected' : ''}}>
                                                    Complaint
                                                </option>
                                                <option
                                                    value="Feature Request" {{ (old('nature_of_contact') == 'Feature Request') ? 'selected' : ''}}>
                                                    Feature Request
                                                </option>
                                                <option
                                                    value="Other" {{ (old('nature_of_contact') == 'Other') ? 'selected' : ''}}>
                                                    Other
                                                </option>
                                            </select>

                                            @error('nature_of_contact')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subject"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Subject *') }}</label>

                                            <input id="subject" type="text"
                                                   class="form-control @error('subject') is-invalid @enderror"
                                                   name="subject" value="{{ old('subject') }}" autocomplete="subject">

                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="message" class="col-md-4 col-form-label text-md-left">{{ __('Message') }}</label>

                                            <textarea id="message"
                                                      class="form-control @error('message') is-invalid @enderror"
                                                      name="message" rows="10" cols="50"
                                                      autocomplete="message">{{ old('message') }}</textarea>

                                            @error('message')
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
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-info">Back</a>
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
