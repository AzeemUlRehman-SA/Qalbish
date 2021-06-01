@extends('layouts.master')
@section('title','Profile')
@push('css')
    <style>
        .serviceInner {
            height: 280px;
        }

        .bannerFields {
            margin-top: 15px;
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
                                                <form action="{{ route('admin.update.user.phone') }}"
                                                      method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="phone_number">Enter New Mobile
                                                                    Number</label>
                                                                <input type="tel" class="form-control"
                                                                       name="phone_number" id="phone_number"
                                                                       autocomplete="phone_number" autofocus placeholder="03001234567"
                                                                       pattern="[03]{2}[0-9]{9}"
                                                                       maxlength="11"
                                                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                                       title="Phone number with 03 and remaing 9 digit with 0-9"
                                                                       value="{{ $user->phone_number }}">
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

        $('#phone_number').focusout(function () {
            if (/^(03)\d{9}$/.test($(this).val())) {
                // value is ok, use it
            }else {

            }
        });

    </script>
@endpush
