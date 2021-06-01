@extends('layouts.master')
@section('title','Memberships')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Edit {{ __('Membership Discount') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post"
                              action="{{ route('admin.memberships-discount.update', $membership_discount->id) }}"
                              enctype="multipart/form-data" role="form">
                            @method('patch')
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name"
                                                   value="{{ $membership_discount->name}}" readonly=""
                                                   autocomplete="price" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="type"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Discount Type') }}
                                                <span
                                                    class="mandatorySign">*</span></label>

                                            <select id="type"
                                                    class="form-control @error('type') is-invalid @enderror"
                                                    name="type" autocomplete="type">
                                                <option value="">Select an option</option>
                                                <option
                                                    value="fixed" {{ ($membership_discount->type == 'fixed') ? 'selected' :'' }}>
                                                    Fixed
                                                </option>
                                                <option
                                                    value="percentage" {{ $membership_discount->type == 'percentage' ? 'selected' :'' }}>
                                                    Percentage
                                                </option>
                                            </select>

                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Price') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="price" type="number"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   value="{{ ($membership_discount->type == 'fixed') ? $membership_discount->value : $membership_discount->percent_off  }}"
                                                   autocomplete="price" autofocus>

                                            @error('price')
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
                                    <a href="{{ route('admin.discount.index') }}" class="btn btn-info">Back</a>
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
