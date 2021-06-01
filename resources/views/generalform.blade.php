@extends('layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Brands</h3>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add Brand
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label>Name*</label>
                                            <input value="{{old('name')}}" required type="text" placeholder="Brand Name"
                                                   class="form-control" name="name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label>Image</label>
                                            <input value="{{old('image')}}" type="file" class="form-control"
                                                   name="image" style="padding: 0px; cursor: pointer">
                                            <img width="300" height="200" class="img-thumbnail" style="display:none;"
                                                 id="img" src="#"
                                                 alt="your image"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" cols="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <a href="" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-primary">Create</button>
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
