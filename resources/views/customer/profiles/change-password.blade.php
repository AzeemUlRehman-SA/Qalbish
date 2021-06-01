@extends('customer.main')
@section('title','Profile')
@push('css')
    <style>
        .profile-image {
            width: 85% !important;
            height: auto;
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

                                                    @if (session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif

                                                    <form action="{{ route('customer.update.user.password') }}"
                                                          method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div
                                                                    class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                                    <label for="current-password">Current
                                                                        Password</label>
                                                                    <input type="password" class="form-control"
                                                                           name="current-password"
                                                                           id="current-password">
                                                                    @if ($errors->has('current-password'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('current-password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div
                                                                    class="form-group {{ $errors->has('new-password') ? ' has-error' : '' }}">
                                                                    <label for="new-password">New Password</label>
                                                                    <input type="password" class="form-control"
                                                                           name="new-password" id="new-password">
                                                                    @if ($errors->has('new-password'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('new-password') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="new-password-confirm">Re-type
                                                                        Password</label>
                                                                    <input type="password" class="form-control"
                                                                           name="new-password-confirm"
                                                                           id="new-password-confirm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                                <a href="{{ route('customer.profile.index') }}"
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
@endpush
