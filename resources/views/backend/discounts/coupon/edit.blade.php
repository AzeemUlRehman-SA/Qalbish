@extends('layouts.master')
@section('title','Coupons')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Edit {{ __('Coupon') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.coupons.update', $coupon->id) }}"
                              enctype="multipart/form-data" role="form">
                            @method('patch')
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="code"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Code') }}
                                                <span class="mandatorySign">*</span></label>
                                            <input id="code" type="text"
                                                   class="form-control @error('code') is-invalid @enderror"
                                                   name="code" value="{{ $coupon->code }}"
                                                   autocomplete="code" autofocus>

                                            @error('code')
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
                                                <option value="fixed" {{ ($coupon->type == 'fixed') ? 'selected' :'' }}>
                                                    Fixed
                                                </option>
                                                <option
                                                    value="percentage" {{ $coupon->type == 'percentage' ? 'selected' :'' }}>
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
                                                   value="{{ ($coupon->type == 'fixed') ? $coupon->value : $coupon->percent_off  }}"
                                                   autocomplete="price" autofocus>

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="expiry_date"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Expiry Date') }}
                                                <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="expiry_date" type="date"
                                                   class="form-control @error('expiry_date') is-invalid @enderror"
                                                   name="expiry_date" value="{{ $coupon->expiry_date }}"
                                                   autocomplete="expiry_date" autofocus>

                                            @error('expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="no_of_used"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Limit') }}
                                                <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="no_of_used" type="number"
                                                   class="form-control @error('no_of_used') is-invalid @enderror"
                                                   name="no_of_used" value="{{$coupon->no_of_used  }}"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   autocomplete="price" autofocus>

                                            @error('no_of_used')
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
