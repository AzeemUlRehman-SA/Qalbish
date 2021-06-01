@extends('layouts.master')
@section('title','Orders')
@push('css')
    <style rel="stylesheet">
        .menuItemsCssClass input {
            width: 7%;
            float: left;
            margin-bottom: 15px;
        }

        .menuItemsCssClass span {
            padding-left: 20px;
            /*padding-top: 10px;*/
            display: block;
            margin-bottom: 15px;
        }

        .disabledDiv {
            pointer-events: none;
            opacity: 1.4;
        }

        .card-header a {
            text-decoration: none;
        }

        .accordion .card:first-of-type {
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header {
            background: #ff6c2b !important;
        }

        .mb-0 {
            color: #fff !important;
        }

        .orderModal .modal-header {
            background: #ff6c2b !important;
        }

        .orderModal .modal-title {
            color: #fff !important;
        }
    </style>
@endpush
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">{{ __('Orders') }}</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Order') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.order.store') }}" id="add-orders"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">

                                    <input type="hidden" value="0" name="category_id" id="category_id">
                                    <input type="hidden" value="0" name="grand_total" id="grand_total_price">
                                    <input type="hidden" value="0" name="memberships_discount"
                                           id="memberships_discount_order">
                                    <input type="hidden" value="0" name="first_order_discount"
                                           id="first_order_discount_order">
                                    <input type="hidden" value="0" name="referral_discount"
                                           id="referral_discount_order">
                                    <input type="hidden" value="0" name="referral_user_id" id="referral_user_id_order">
                                    <input type="hidden" value="0" name="delivery_charges" class="delivery_charges">
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="customer_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Customer') }}
                                                <span class="mandatorySign">*</span></label>

                                            <select id="customer_id"
                                                    class="form-control customers @error('customer_id') is-invalid @enderror"
                                                    name="customer_id" autocomplete="customer_id">
                                                <option value="">Select an Customer</option>
                                                @if(!empty($employees))
                                                    @foreach($employees as $employee)
                                                        <option
                                                            value="{{$employee->id}}" data-delivery_charges="{{$employee->area['price']}}">{{ ucfirst($employee->fullName())}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('customer_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_category_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Service') }}
                                                <span class="mandatorySign">*</span></label>

                                            <select id="service_category_id"
                                                    class="form-control service_category @error('service_category_id') is-invalid @enderror js-example-basic-multiple"
                                                    name="service_category_id[]" autocomplete="service_category_id"
                                                    multiple="multiple">

                                            </select>

                                            @error('service_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            {{--                                            <div id="log"></div>--}}
                                        </div>
                                    </div>
                                    @if(!empty($packages))
                                        <div class="form-group" id="packages_arrordion" style="display: none">

                                            <div class="">
                                                <div class="mb-4 accordion md-accordion" id="packagesaccordionEx24"
                                                     role="tablist"
                                                     aria-multiselectable="true">
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="packagesheadingOne24">
                                                            <a data-toggle="collapse"
                                                               data-parent="#packagesaccordionEx24"
                                                               href="#packagescollapseOne24" aria-expanded="true"
                                                               aria-controls="packagescollapseOne24">
                                                                <div class="form-group row" style="margin-bottom: 0;">
                                                                    <div class="col-md-6 text-left">
                                                                        <h5 class="mb-0" style="color: #000;">
                                                                            Packages</h5>
                                                                    </div>
                                                                    <div class="col-md-6 text-right"
                                                                         style="color: #fff;">
                                                                        <span>Rs: </span><span
                                                                            id="total_packages_price">0</span> &nbsp;<i
                                                                            class="fas fa-angle-down rotate-icon"
                                                                            style="float: right;"></i>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div id="packagescollapseOne24" class="collapse "
                                                             role="tabpanel"
                                                             aria-labelledby="packagesheadingOne24"
                                                             data-parent="#packagesaccordionEx24">
                                                            <div class="card-body">
                                                                <div class="col-md-7 float-left text-right">
                                                                    <span><b>Rs:</b> </span>
                                                                </div>
                                                                <div class="col-md-5 float-left text-right"><span><b>Quantity</b> </span>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                @foreach($packages  as $package)
                                                                    <div
                                                                        class="col-md-12 menuItemsCssClass menu-items-pacakges{{$package->id }}">
                                                                        <div class="col-md-5 float-left">
                                                                            <input type="checkbox"
                                                                                   id="service_sub_category_packages_id{{$package->id}}"
                                                                                   class="form-control services service_sub_category_package"
                                                                                   name="service_sub_category_packages_id[]"
                                                                                   onchange="subCategoryPackage('{{$package->id}}')"
                                                                                   autocomplete="service_sub_category_packages_id{{$package->id}}"
                                                                                   value="{{$package->id}}">
                                                                            <span
                                                                                id="service_sub_category_package_item_name{{$package->id}}">{{$package->name}}</span>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-2 float-left text-right"><span
                                                                                id="menu-items-price-package{{$package->id}}">{{(int)$package->total_price}}</span>
                                                                        </div>
                                                                        <div class="col-md-5 float-left text-right">
                                                                            <select class="orders-quantity"
                                                                                    name="menu-items-package-quantity{{$package->id}}"
                                                                                    id="menu-items-package-quantity{{$package->id}}"
                                                                                    onchange="subCategoryPacakgeQuantity('{{$package->id}}')">
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                                <option value="8">8</option>
                                                                                <option value="9">9</option>
                                                                                <option value="10">10</option>
                                                                            </select>
                                                                        </div>
                                                                        <div
                                                                            id="hidden_menu_items_package{{$package->id}}">

                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        @if(!empty($package->deal_services))
                                                                            @foreach($package->deal_services as $deal_service)
                                                                                @if(!empty($deal_service->deal_sub_categories))
                                                                                    @foreach($deal_service->deal_sub_categories as $deal_sub_category)
                                                                                        <div
                                                                                            class="row show-package-details{{$package->id }}"
                                                                                            style="display: none">

                                                                                            <div class="col-md-8"
                                                                                                 style="margin-left: 40px;">
                                                                                                <h5>
{{--                                                                                                    <img--}}
{{--                                                                                                        src="{{ asset('frontend/images/leaf.png') }}"--}}
{{--                                                                                                        alt=""> --}}
                                                                                                    {{ $deal_sub_category->sub_category->name ?? '-' }}
                                                                                                </h5>
                                                                                                @if(!empty($deal_sub_category->deal_sub_category_addons) && (count($deal_sub_category->deal_sub_category_addons) > 0))
                                                                                                    <h6><b>Add on</b>
                                                                                                    </h6>
                                                                                                    <ul>

                                                                                                        @foreach($deal_sub_category->deal_sub_category_addons as $deal_sub_category_addon)
                                                                                                            <li>{{ $deal_sub_category_addon->addon->name ?? '-' }}</li>
                                                                                                        @endforeach


                                                                                                    </ul>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-2"></div>
                                                                                        </div>

                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <hr style="margin: 10px 0; border: #ff6c2b dotted 1px;">
                                                                @endforeach


                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group" id="sub_categories_checkbox">

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 disabledDiv">
                                            <label for="net_price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Net Price') }}
                                                <span class="mandatorySign">*</span></label>
                                            <input id="net_price" type="number"
                                                   class="form-control @error('net_price') is-invalid @enderror"
                                                   name="net_price" value="0"
                                                   autocomplete="net_price" autofocus>

                                            @error('net_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="net_price"
                                                   class="col-md-6 col-form-label text-md-left">{{ __('Admin Discount (Fixed e.g. in Rupees)') }}
                                                <span class="mandatorySign">*</span></label>
                                            <input id="admin_discount" type="number"
                                                   class="form-control @error('admin_discount') is-invalid @enderror"
                                                   name="admin_discount" value="0" min="0"
                                                   onkeypress="return event.charCode >= 48"
                                                   autocomplete="admin_discount" autofocus>

                                            @error('admin_discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-4">
                                            <label for="datetimepicker1" class="col-md-4 col-form-label text-md-left">Date
                                                Time <span class="mandatorySign">*</span></label>

                                            <input type="text" name="datetimepicker1" id="datetimepicker1"
                                                   class="form-control @error('datetimepicker1') is-invalid @enderror"
                                                   required autocomplete="datetimepicker1">


                                            <span class="invalid-feedback" role="alert" style="display: none">
                                                    <strong>Please add time with gap of 2 hrs from now</strong>
                                                </span>
                                            @error('datetimepicker1')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>

                                        <div class="col-md-4">
                                            <label for="time" class="col-md-4 col-form-label text-md-left">Time <span class="mandatorySign">*</span></label>

                                            <input type="text" name="time" id="time"
                                                   class="form-control @error('time') is-invalid @enderror"
                                                   required autocomplete="time">


                                            <span class="invalid-feedback" role="alert" style="display: none">
                                                    <strong>Please add time with gap of 2 hrs from now</strong>
                                                </span>
                                            @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>

                                        <div class="col-md-4 disabledDiv">
                                            <label for="mobile_number" class="col-md-4 col-form-label text-md-left">{{ __('Mobile Number') }}</label>
                                            <input id="mobile_number" type="tel"
                                                   class="form-control @error('mobile_number') is-invalid @enderror"
                                                   name="mobile_number" value=""
                                                   autocomplete="mobile_number" autofocus>

                                            @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6 disabledDiv">
                                            <label for="address"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Address') }}
                                                <span class="mandatorySign">*</span></label>
                                            <input id="address" type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   name="address" value=""
                                                   autocomplete="address" autofocus>

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 disabledDiv">
                                            <label for="city_name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('City') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="city_name" type="text"
                                                   class="form-control @error('city_id') is-invalid @enderror"
                                                   name="city_name" value=""
                                                   autocomplete="city_name" autofocus>
                                            <input id="city_id" type="text" hidden
                                                   class="form-control @error('city_id') is-invalid @enderror"
                                                   name="city_id" value="0"
                                                   autocomplete="city_id" autofocus>

                                            @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6 disabledDiv">
                                            <label for="area_name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Area') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="area_name" type="text"
                                                   class="form-control @error('area_name') is-invalid @enderror"
                                                   name="area_name" value=""
                                                   autocomplete="area_name" autofocus>
                                            <input id="area_id" type="text" hidden
                                                   class="form-control @error('area_id') is-invalid @enderror"
                                                   name="area_id" value="0"
                                                   autocomplete="area_id" autofocus>

                                            @error('area_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">

                                            <label for="no_of_peoples" class="col-md-4 col-form-label text-md-left">Number
                                                of People <span class="mandatorySign">*</span></label>
                                            <input type="number" name="no_of_peoples" value="1" id="no_of_peoples"
                                                   class="form-control" min="1"
                                                   onkeypress="return event.charCode >= 48">

                                        </div>


                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">

                                            <label for="alternate_address" class="col-md-4 col-form-label text-md-left">Alternate Address for This Service</label>
                                            <textarea class="form-control" id="alternate_address" name="alternate_address"
                                                      rows="3"></textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">

                                            <label for="special_notes" class="col-md-4 col-form-label text-md-left">Special
                                                Instructions</label>
                                            <textarea class="form-control" id="special_notes" name="special_notes"
                                                      rows="3"></textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit text-md-right">
                                <div class="m-form__actions m-form__actions">
                                    <a href="{{ route('admin.get.order.history') }}" class="btn btn-info">Back</a>
                                    <button type="submit" id="get-orders" class="btn btn-primary" disabled>
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

@push('models')
    <!-- Modal -->
    <div class="modal fade orderModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to confirm this order?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row subtotal_section">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Sub Total </strong></h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span
                                        id="subtotal_price">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row admin_discount_section">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Admin Discount: </strong>(<span>Fixed</span>)</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span id="admin_discount_span">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row memberShips_section" style="display: none">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Membership Discount: </strong>(<span id="memberships_discount_type"></span>)
                            </h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span
                                        id="membership_discount">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row first_order_discount_section" style="display: none">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>First Order Discount: </strong>(<span id="first_order_discount_type"></span>)
                            </h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span
                                        id="first_order_discount">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row referral_discount_section" style="display: none">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Referral Discount: </strong>(<span id="referral_discount_type"></span>)</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span
                                        id="referral_discount">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Delivery Charges: </strong>(<span>Fixed</span>)</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span id="delivery_charges">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row grand_total">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h5><strong>Grand Total: </strong></h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h5><strong>Rs. <span
                                        id="grand_total">0</span></strong>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn buttonMain hvr-bounce-to-right" data-dismiss="modal">Close</button>
                    <a href="#" class="btn buttonMain hvr-bounce-to-right" id="order-submit">Yes</a>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script>
        var delivery_charges = 0;
        $('.customers').select2({
            maximumInputLength: 20 // only allow terms up to 20 characters long
        });



        $('.js-example-basic-multiple').select2();
        var dateToday = new Date();
        $('#datetimepicker1').datetimepicker({
            format: "DD/MM/YYYY",
            minDate: moment().add(1, 'hours'),
            icons: {
                time: 'fa fa-clock',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        // $('#time').datetimepicker({
        //     format: "hh:mm A",
        //     minDate: moment().add(1, 'hours'),
        //     icons: {
        //         time: 'fa fa-clock',
        //         date: 'fa fa-calendar',
        //         up: 'fa fa-chevron-up',
        //         down: 'fa fa-chevron-down',
        //         previous: 'fa fa-chevron-left',
        //         next: 'fa fa-chevron-right',
        //         today: 'fa fa-check',
        //         clear: 'fa fa-trash',
        //         close: 'fa fa-times'
        //     }
        // });



        var startTime = '09:15am';
        var endTime = '08:15pm';
        var startNewTime = moment(startTime, "HH:mm a");
        var endNewTime = moment(endTime, "HH:mm a");


        $('#time').datetimepicker({

            format: "hh:mm A",
            stepping: 15, //will change increments to 15m, default is 1m
            // minDate: moment().add(0, 'hours'),
            icons: {
                time: 'fa fa-clock',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
            // "enabledHours": [
            //     "9",
            //     "10",
            //     "11",
            //     "12",
            //     "13",
            //     "14",
            //     "15",
            //     "16",
            //     "17",
            //     "18",
            //     "19",
            //     "20",
            // ],
        }).on('dp.change', function (e) {
            var date = e.date;//e.date is a moment object
            var target = $(e.target).attr('name');

            // $('#time').val(date.add(2, 'hours').format('hh:mm A'));
            // var currentTime = moment($("#time").val(), "HH:mm a");
            // var isBetween = currentTime.isBetween(startNewTime, endNewTime);
            // if (moment().format('DD/MM/YYYY') == $('#datetimepicker1').val()) {
            //
            //     if (isBetween) {
            //         $('.invalid-feedback').css('display', 'block');
            //     } else {
            //         toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
            //         $('#time').val('');
            //     }
            // } else {
            //     if (isBetween) {
            //         $('.invalid-feedback').css('display', 'block');
            //         $('#time').val(date.format('hh:mm A'));
            //     } else {
            //         toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
            //         $('#time').val('');
            //     }
            // }

            if (moment().format('DD/MM/YYYY') == $('#datetimepicker1').val()) {

                $('#time').val(date.add(2, 'hours').format('hh:mm A'));
                // var currentTime = moment($("#time").val(), "HH:mm a");
                // var isBetween = currentTime.isBetween(startNewTime, endNewTime);
                // if (isBetween) {
                //     $('.invalid-feedback').css('display', 'block');
                // } else {
                //     toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                //     $('#time').val('');
                // }
            } else {
                $('#time').val(date.format('hh:mm A'));
                // var currentTimeOne = moment($("#time").val(), "HH:mm a");
                // var isBetweenOne = currentTimeOne.isBetween(startNewTime, endNewTime);
                // if (isBetweenOne) {
                //     $('.invalid-feedback').css('display', 'block');
                //
                // } else {
                //     toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                //     $('#time').val('');
                // }
            }
        });

    </script>
    <script>

        $('.customers').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.service_category';
            var customer_id = $(this).val();

            delivery_charges = parseInt($(this).find(':selected').data('delivery_charges'));
            $('#delivery_charges').text(delivery_charges)
            $('.delivery_charges').val(delivery_charges)

            var request = "customer_id=" + customer_id;

            $('#sub_categories_checkbox').empty();
            $('#net_price').val(0);
            $('#grand_total').val(0);

            if (customer_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.customerServiceCategory') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '" id="selectedCategory' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' disabled>Select Service</option>");


                            $('#mobile_number').val(response.data.user.phone_number);
                            $('#address').val(response.data.user.address);
                            $('#city_id').val(response.data.user.city_id);
                            $('#area_id').val(response.data.user.area_id);
                            $('#city_name').val(response.data.city_name);
                            $('#area_name').val(response.data.area_name);
                            $('#category_id').val(response.data.user.category_id);
                            $('.js-example-basic-multiple').select2();
                            $('#packages_arrordion').css('display', '');
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value=''disabled>Select Service</option>");
            }
        });
        $('.services').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.service_category';
            var service_id = $(this).val();
            var request = "service_id=" + service_id;

            if (service_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.serviceCategory') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '" id="selectedCategory' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' disabled>Select Service</option>");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value=''disabled>Select Service</option>");
            }
        });

        var $topo = $('#service_category_id');

        var valArray = ($topo.val()) ? $topo.val() : [];

        $topo.change(function () {
            var val = $(this).val(),
                numVals = (val) ? val.length : 0,
                changes;

            if (numVals != valArray.length) {
                var longerSet, shortSet;
                (numVals > valArray.length) ? longerSet = val : longerSet = valArray;
                (numVals > valArray.length) ? shortSet = valArray : shortSet = val;
                //create array of values that changed - either added or removed
                changes = $.grep(longerSet, function (n) {
                    return $.inArray(n, shortSet) == -1;
                });

                logChanges(changes, (numVals > valArray.length) ? 'selected' : 'removed');

            } else {
                // if change event occurs and previous array length same as new value array : items are removed and added at same time
                logChanges(valArray, 'removed');
                logChanges(val, 'selected');
            }
            valArray = (val) ? val : [];

            if(val.length == 0){
                if ($(".service_sub_category_package:checkbox:checked").length > 0) {
                    $("#get-orders").removeAttr("disabled");
                }else{
                    $("#get-orders").attr("disabled", "disabled");
                }

            }
        });
        var newValue = '';
        var oldUnselectValue = ''

        function logChanges(array, type) {

            $.each(array, function (i, item) {

                $('#log').html(item + ' was ' + type + '<br>');
                if (type == 'removed') {
                    newValue = '';
                    oldUnselectValue = item;
                } else {
                    newValue = item;
                }

            });
        }

        var net_price_value = 0;
        var total_add_on_value = 0;
        var total_add_on_value_per_subcategory = 0;

        $('.service_category').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '#sub_categories_checkbox';

            var lastSelectedTitle = $('#selectedCategory' + newValue + '').text();
            var service_id = newValue;
            if (service_id !== '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.packageServiceSubCategory') }}",
                    data: {'service_id': newValue, "_token": "{{ csrf_token() }}",},
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            html += '<div class="">';
                            html += '<input type="hidden" value="0" name="total_service_value' + newValue + '" id="total_service_value' + newValue + '">';
                            html += '<div class="mb-4 accordion md-accordion" id="accordionEx' + newValue + '" role="tablist" aria-multiselectable="true">';

                            html += '<div class="card">';
                            html += '<div class="card-header" role="tab" id="headingOne' + newValue + '">';
                            html += '<a data-toggle="collapse" data-parent="#accordionEx' + newValue + '" href="#collapseOne' + newValue + '" aria-expanded="true"aria-controls="collapseOne' + newValue + '">';
                            html += '<div class="form-group row" style="margin-bottom: 0;"><div class="col-md-6 text-left"><h5 class="mb-0" style="color: #000;">' + lastSelectedTitle + ' </h5></div>';

                            html += '<div class="col-md-6 text-right" style="color: #fff;"> <span>Rs: </span><span id="total_service_value_menu' + newValue + '">0</span> &nbsp;<i class="fas fa-angle-down rotate-icon" style="float: right;"></i></div><div class="clearfix"></div>';
                            html += '</div>'
                            html += '</a>';
                            html += '</div>'


                            html += '<div id="collapseOne' + newValue + '" class="collapse show" role="tabpanel"aria-labelledby="headingOne' + newValue + '" data-parent="#accordionEx">';
                            html += '<div class="card-body">'

                            if (response.data.service_category.length > 0) {
                                html += '<div class="col-md-7 float-left text-right"><span><b>Rs:</b> </span></div>';
                                html += '<div class="col-md-5 float-left text-right"><span><b>Quantity</b> </span></div>';
                                html += '<div class="clearfix"></div>';

                                $.each(response.data.service_category, function (i, obj) {
                                    html += '<div class="col-md-12 menuItemsCssClass menu-items' + obj.id + '">';
                                    html += '<div class="col-md-5 float-left"><input type="checkbox" id="service_sub_category_id' + obj.id + '" class="form-control services service_sub_category" name="service_sub_category_id[' + newValue + '][]" onchange="subCategoryAddon(' + obj.id + ' ,' + newValue + ',' + obj.price + ')" autocomplete="service_sub_category_id" value="' + obj.id + '"><span id="service_sub_category_item_name' + obj.id + '">' + obj.name + '</span></div>';
                                    html += '<div class="col-md-2 float-left text-right"><span id="menu-items-price' + newValue + '">' + obj.price + '</span></div>';
                                    html += '<div class="col-md-5 float-left text-right"><select class="orders-quantity" name="menu-items-quantity' + newValue + '" id="menu-items-quantity' + obj.id + '" onchange="subCategoryQuantity(' + obj.id + ' ,' + newValue + ',' + obj.price + ')"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div>';
                                    html += '<div id="hidden_menu_items' + obj.id + '"></div>'

                                    html += '<div class="clearfix"></div>';
                                    html += '<div><input type="hidden" id="total_value__per_subcatgory_addons' + obj.id + '" value="0"></div>';
                                    html += '</div> <hr>';
                                });
                                html += '<div><input type="hidden" id="total_value_addons' + newValue + '" value="0"></div>';


                            }

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            $(node_to_modify).append(html);
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {

                var netPrice = parseInt($('#net_price').val());
                var total_service_value = parseInt($('#total_service_value' + oldUnselectValue + '').val());
                netPrice = netPrice - total_service_value;
                $('#net_price').val(netPrice);
                $('#total_service_value' + oldUnselectValue + '').val(0);
                $('#total_service_value_menu' + oldUnselectValue + '').text(0);
                $('#accordionEx' + oldUnselectValue + '').remove();

            }
        });

        function subCategoryAddon(id, value, price) {
            var item_name = $('#service_sub_category_item_name' + id + '').text();
            var quantity = $('#menu-items-quantity' + id + ' option:selected').val();


            checkedSubCategory = '#service_sub_category_id' + id + '';
            var service_id = id;
            var request = "service_id=" + service_id;
            if ($(checkedSubCategory).is(':checked')) {

                var hiddenHtml = '';

                hiddenHtml += '<input type="hidden" name="service_sub_category_name[' + value + '][' + id + ']" value="' + item_name + '" id="service_sub_category_name[' + value + '][' + id + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_price[' + value + '][' + id + ']" value="' + price + '" id="service_sub_category_price[' + value + '][' + id + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_quantity[' + value + '][' + id + ']" value="' + quantity + '" id="service_sub_category_quantity' + value + '' + id + '">';
                hiddenHtml += '<input type="hidden" value="' + (price * quantity) + '" id="total_menu_items_price' + value + '' + id + '">';


                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + value + '').val());

                netPrice = netPrice + (price * quantity);
                total_service_price = total_service_price + (price * quantity);
                $('#net_price').val(netPrice);

                $('#total_service_value' + value + '').val(total_service_price);
                $('#total_service_value_menu' + value + '').text(total_service_price);

                if (service_id !== '') {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('ajax.serviceSubCategoryAddon') }}",
                        data: request,
                        dataType: "json",
                        cache: true,
                        success: function (response) {
                            if (response.status == "success") {
                                var html = "";
                                if (response.data.service_sub_category_addon.length > 0) {
                                    html += '<div class="col-md-12 menuItemsCssClass2">';
                                    html += '<label for="service_sub_category_addon_id" id="remove_add_on' + id + '" class="col-md-4 col-form-label text-md-left"><strong>Add Ons</strong></label>';
                                    html += '<div class="col-md-12 menu-items-addons' + id + '">'
                                    $.each(response.data.service_sub_category_addon, function (i, obj) {
                                        html += '<div class="col-md-5 float-left"><input type="checkbox" id="service_sub_category_addon_id' + obj.id + '" onchange="subCategoryAddonPrice(' + obj.id + ' ,' + value + ',' + obj.price + ' ,' + id + ')" class="form-control services service_sub_category_addon" name="service_sub_category_addon_id[' + value + '][' + id + '][]" autocomplete="service_sub_category_addon_id" value="' + obj.id + '"><span id="service_sub_category_items_addon_name' + obj.id + '">' + obj.name + '</span></div>';
                                        html += '<div class="col-md-2 float-left text-right"><span id="menu-items-addon-price' + obj.id + '">' + obj.price + '</span></div>';
                                        html += '<div class="col-md-5 float-left text-right"><select class="orders-quantity" name="menu-items-addon-quantity' + value + '" id="menu-items-addon-quantity' + obj.id + '" onchange="subCategoryAddonQuantity(' + obj.id + ' ,' + value + ',' + obj.price + ' ,' + id + ')"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div>';
                                        html += '<div id="hidden_addons' + id + '"></div>'

                                        html += '<div class="clearfix"></div>';

                                    });
                                    html += '</div></div>'
                                    $('.menu-items' + id + '').append(html);

                                }
                                $('#hidden_menu_items' + id + '').append(hiddenHtml);
                            }
                        },
                        error: function () {
                            toastr['error']("Something Went Wrong.");
                        }
                    });
                } else {

                }
            } else {

                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + value + '').val());

                let total_menu_items_price = parseInt($('#total_menu_items_price' + value + id).val());
                netPrice = netPrice - total_menu_items_price;
                total_service_price = total_service_price - total_menu_items_price;

                $('#net_price').val(netPrice);
                $('#total_service_value' + value + '').val(total_service_price);
                $('#total_service_value_menu' + value + '').text(total_service_price);

                $('#hidden_menu_items' + id + '').empty();
                $('.menu-items-addons' + id + '').remove();
                $('#remove_add_on' + id + '').remove();

            }

        }

        function subCategoryAddonPrice(addOnId, divId, addOnPrice, subCategoryId) {
            var item_name = $('#service_sub_category_items_addon_name' + addOnId + '').text();
            var quantity = $('#menu-items-addon-quantity' + addOnId + ' option:selected').val();

            checkedSubCategory = '#service_sub_category_addon_id' + addOnId + '';
            if ($(checkedSubCategory).is(':checked')) {

                var hiddenHtml = '';

                hiddenHtml += '<input type="hidden" name="service_sub_category_addons_name[' + divId + '][' + subCategoryId + '][' + addOnId + ']" value="' + item_name + '" id="service_sub_category_addons_name[' + divId + '][' + subCategoryId + '][' + addOnId + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_addons_price[' + divId + '][' + subCategoryId + '][' + addOnId + ']" value="' + addOnPrice + '" id="service_sub_category_addons_price[' + divId + '][' + subCategoryId + '][' + addOnId + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_addons_quantity[' + divId + '][' + subCategoryId + '][' + addOnId + ']" value="' + quantity + '" id="service_sub_category_addons_quantity' + divId + '' + subCategoryId + '' + addOnId + '">';

                $('#hidden_addons' + subCategoryId + '').append(hiddenHtml);


                total_add_on_value = parseInt($('#total_value_addons' + divId + '').val()) + addOnPrice;
                total_add_on_value_per_subcategory = parseInt($('#total_value__per_subcatgory_addons' + subCategoryId + '').val()) + addOnPrice;
                net_price_value = parseInt($('#net_price').val()) + addOnPrice;
                // $('#net_price').val(net_price_value);


                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + divId + '').val());

                netPrice = netPrice + (addOnPrice * quantity);
                total_service_price = total_service_price + (addOnPrice * quantity);
                $('#net_price').val(netPrice);
                $('#total_service_value' + divId + '').val(total_service_price);

                $('#total_service_value_menu' + divId + '').text(total_service_price);


                $('#total_value_addons' + divId + '').val(total_add_on_value);
                $('#total_value__per_subcatgory_addons' + subCategoryId + '').val(total_add_on_value_per_subcategory);

                let totalMenuItemsPrice = $('#total_menu_items_price' + divId + subCategoryId).val();
                let totalMenuItemsPriceUpdated = parseInt(totalMenuItemsPrice) + (addOnPrice * quantity);
                $('#total_menu_items_price' + divId + subCategoryId).val(totalMenuItemsPriceUpdated);

            } else {

                $('#hidden_addons' + subCategoryId + '').empty();
                total_add_on_value = parseInt($('#total_value_addons' + divId + '').val()) - addOnPrice;
                total_add_on_value_per_subcategory = parseInt($('#total_value__per_subcatgory_addons' + subCategoryId + '').val()) - addOnPrice;
                net_price_value = parseInt($('#net_price').val()) - addOnPrice;
                // $('#net_price').val(net_price_value);


                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + divId + '').val());

                netPrice = netPrice - (addOnPrice * quantity);
                total_service_price = total_service_price - (addOnPrice * quantity);
                $('#net_price').val(netPrice);
                $('#total_service_value' + divId + '').val(total_service_price);
                $('#total_service_value_menu' + divId + '').text(total_service_price);

                $('#total_value_addons' + divId + '').val(total_add_on_value);
                $('#total_value__per_subcatgory_addons' + subCategoryId + '').val(total_add_on_value_per_subcategory);

                let totalMenuItemsPrice = $('#total_menu_items_price' + divId + subCategoryId).val();
                let totalMenuItemsPriceUpdated = parseInt(totalMenuItemsPrice) - (addOnPrice * quantity);
                $('#total_menu_items_price' + divId + subCategoryId).val(totalMenuItemsPriceUpdated);
            }

        }

        function subCategoryQuantity(id, value, price) {

            if($("#service_sub_category_id"+ id).is("checked")){
                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + value + '').val());
                var previous_quantity = parseInt($('#service_sub_category_quantity' + value + '' + id + '').val());
                var menu_item_quantity = parseInt($('#menu-items-quantity' + id + ' option:selected').val());

                $('#service_sub_category_quantity' + value + '' + id + '').val(menu_item_quantity);

                netPrice = netPrice - (price * previous_quantity);
                netPrice = netPrice + (price * menu_item_quantity);
                total_service_price = total_service_price - (price * previous_quantity);
                total_service_price = total_service_price + (price * menu_item_quantity);

                $('#net_price').val(netPrice);
                $('#total_service_value' + value + '').val(total_service_price);
                $('#total_service_value_menu' + value + '').text(total_service_price);

                let totalMenuItemsPrice = $('#total_menu_items_price' + value + id).val();
                let totalMenuItemsPricePrevious = totalMenuItemsPrice - (price * previous_quantity)
                let totalMenuItemsPriceUpdated = totalMenuItemsPricePrevious + (price * menu_item_quantity)
                $('#total_menu_items_price' + value + id).val(totalMenuItemsPriceUpdated);
            }

        }

        function subCategoryAddonQuantity(id, serviceID, price, menuItemId) {

            if($("#service_sub_category_addon_id"+ id).is("checked")){
                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + serviceID + '').val());
                var previous_addons_quantity = parseInt($('#service_sub_category_addons_quantity' + serviceID + '' + menuItemId + '' + id + '').val());
                var menu_item_addons_quantity = parseInt($('#menu-items-addon-quantity' + id + ' option:selected').val());
                $('#service_sub_category_addons_quantity' + serviceID + '' + menuItemId + '' + id + '').val(menu_item_addons_quantity);
                netPrice = netPrice - (price * previous_addons_quantity);
                netPrice = netPrice + (price * menu_item_addons_quantity);
                // $('#net_price').val(netPrice);


                total_service_price = total_service_price - (price * previous_addons_quantity);
                total_service_price = total_service_price + (price * menu_item_addons_quantity);
                $('#net_price').val(netPrice);
                $('#total_service_value' + serviceID + '').val(total_service_price);
                $('#total_service_value_menu' + serviceID + '').text(total_service_price);

                let totalMenuItemsPrice = $('#total_menu_items_price' + serviceID + menuItemId).val();
                let totalMenuItemsPricePrevious = parseInt(totalMenuItemsPrice) - (price * previous_addons_quantity);
                let totalMenuItemsPriceUpdated = totalMenuItemsPricePrevious + (price * menu_item_addons_quantity);
                $('#total_menu_items_price' + serviceID + menuItemId).val(Math.abs(totalMenuItemsPriceUpdated));
            }

        }

        function subCategoryPackage(id) {
            checkedSubCategory = '#service_sub_category_packages_id' + id + '';
            if ($(checkedSubCategory).is(':checked')) {
                $('.show-package-details' + id + '').css('display', 'block');
                var hiddenHTML = "";
                var price = parseInt($('#menu-items-price-package' + id + '').text());
                var name = $('#service_sub_category_package_item_name' + id + '').text();
                var quantity = parseInt($('#menu-items-package-quantity' + id + ' option:selected').val());
                hiddenHTML += '<input type="hidden" name="package_price[' + id + ']" id="package_price' + id + '" value="' + price + '"/>'
                hiddenHTML += '<input type="hidden" name="package_quantity[' + id + ']" id="package_quantity' + id + '" value="' + quantity + '"/>'
                hiddenHTML += '<input type="hidden" name="package_name[' + id + ']" id="package_name' + id + '" value="' + name + '"/>'
                var netPrice = parseInt($('#net_price').val());
                netPrice = netPrice + (price * quantity);

                var total = parseInt($('#total_packages_price').text());
                total = total + (price * quantity);
                $('#total_packages_price').text(total);

                $('#net_price').val(netPrice);
                $('#hidden_menu_items_package' + id + '').append(hiddenHTML);
            } else {
                var previous_price = parseInt($('#package_price' + id + '').val());
                var previous_quantity = parseInt($('#package_quantity' + id + '').val());
                var netPrice = parseInt($('#net_price').val());
                netPrice = netPrice - (previous_price * previous_quantity);

                var total = parseInt($('#total_packages_price').text());
                total = total - (previous_price * previous_quantity);
                $('#total_packages_price').text(total);
                $('#net_price').val(netPrice);
                $('.show-package-details' + id + '').css('display', 'none');
                $('#hidden_menu_items_package' + id + '').empty();
            }
        }

        function subCategoryPacakgeQuantity(id) {
            if($("#service_sub_category_packages_id"+ id).is("checked")){
                var previous_price = parseInt($('#package_price' + id + '').val());
                var previous_quantity = parseInt($('#package_quantity' + id + '').val());
                var price = parseInt($('#menu-items-price-package' + id + '').text());
                var quantity = parseInt($('#menu-items-package-quantity' + id + ' option:selected').val());
                var netPrice = parseInt($('#net_price').val());
                netPrice = netPrice - (previous_price * previous_quantity);
                netPrice = netPrice + (price * quantity);

                var total = parseInt($('#total_packages_price').text());
                total = total - (previous_price * previous_quantity);
                total = total + (price * quantity);
                $('#total_packages_price').text(total);

                $('#net_price').val(netPrice);
                $('#package_quantity' + id + '').val(quantity);
            }

        }


        $('#get-orders').click(function (e) {
            e.preventDefault();
            var request = "customer_id=" + $('#customer_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('ajax.getDiscounts') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {


                    if (response.status == 'error') {
                        toastr['error'](response.data.customer_id);
                    } else {
                        var netPrice        = parseInt($('#net_price').val());
                        $('#subtotal_price').text(netPrice);
                        netPrice            = netPrice + delivery_charges;
                        var adminDiscount   = parseInt($('#admin_discount').val());
                        netPrice            = netPrice - adminDiscount;
                        $('#admin_discount_span').text(adminDiscount);

                        if (response.data.membership_discount && netPrice > 0) {
                            var discount = 0;
                            if (response.data.membership_discount.type == 'percentage') {

                                discount = response.data.membership_discount.percent_off / 100;
                                var discounted_price = parseFloat(discount) * netPrice;
                                netPrice = netPrice - discounted_price;
                                $('#membership_discount').text(discounted_price);
                                $('#memberships_discount_type').text(response.data.membership_discount.percent_off + '%');
                                $('#memberships_discount_order').val(discounted_price);
                            } else if (response.data.membership_discount.type == 'fixed') {
                                discount = response.data.membership_discount.value;
                                netPrice = netPrice - parseInt(discount);
                                $('#membership_discount').text(discount);
                                $('#memberships_discount_type').text(response.data.membership_discount.type);
                                $('#memberships_discount_order').val(discount);
                            }

                            $('.memberShips_section').css('display', '');
                            $('#grand_total').text(netPrice);
                            $('#grand_total_price').val(netPrice);
                        }

                        if (response.data.first_order_discount && netPrice > 0) {
                            var $first_order_discount = 0;
                            if (response.data.first_order_discount.type == 'percentage') {
                                $first_order_discount = response.data.first_order_discount.percent_off / 100;
                                var first_order_discounted_price = parseFloat($first_order_discount) * parseInt($('#total').text());
                                netPrice = netPrice - first_order_discounted_price;
                                $('#first_order_discount').text(first_order_discounted_price);
                                $('#first_order_discount_type').text(response.data.first_order_discount.percent_off + '%');
                                $('#first_order_discount_order').val(first_order_discounted_price);
                            } else if (response.data.first_order_discount.type == 'fixed') {
                                $first_order_discount = response.data.first_order_discount.value;
                                netPrice = netPrice - parseInt($first_order_discount);
                                $('#first_order_discount').text($first_order_discount);
                                $('#first_order_discount_type').text(response.data.first_order_discount.type);
                                $('#first_order_discount_order').val($first_order_discount);
                            }
                            $('.first_order_discount_section').css('display', '');
                            $('#grand_total').text(netPrice);
                            $('#grand_total_price').val(netPrice);
                        } else if (response.data.referral_discount && netPrice > 0) {
                            var referral_discount = 0;
                            if (response.data.referral_discount.type == 'percentage') {
                                referral_discount = response.data.referral_discount.percent_off / 100;
                                var referral_discounted_price = parseFloat(referral_discount) * parseInt($('#total').text());
                                netPrice = netPrice - referral_discounted_price;
                                $('#referral_discount').text(discounted_price);
                                $('#referral_discount_type').text(response.data.referral_discount.percent_off + '%');
                                $('#referral_discount_order').val(referral_discounted_price);
                            } else if (response.data.referral_discount.type == 'fixed') {
                                referral_discount = response.data.referral_discount.value;
                                netPrice = netPrice - parseInt(referral_discount);
                                $('#referral_discount').text(referral_discount);
                                $('#referral_discount_type').text(response.data.referral_discount.type);
                                $('#referral_discount_order').val(referral_discount);
                            }
                            $('.referral_discount_section').css('display', '');
                            $('#grand_total').text(netPrice);
                            $('#grand_total_price').val(netPrice);
                        } else {
                            $('#grand_total').text(netPrice);
                            $('#grand_total_price').val(netPrice);
                        }
                        $('#exampleModal').modal('show');
                    }


                },
                error: function () {
                    toastr['error']("Something Went Wrong.");
                }
            });

        });

        $('#order-submit').click(function (e) {

            if (moment().format('DD/MM/YYYY') == $('#datetimepicker1').val()) {
                var currentTime = moment($("#time").val(), "HH:mm a");
                var isBetween = currentTime.isBetween(startNewTime, endNewTime);
                if (isBetween) {
                    e.preventDefault();
                    let form = $('#add-orders');
                    var request = $(form).serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.order.store') }}",
                        data: request,
                        dataType: "json",
                        cache: false,
                        success: function (response) {
                            toastr[response.data.flash_status](response.data.flash_message);

                            if (response.data.flash_status == "success") {
                                window.location = '{{route('admin.get.order.history')}}';
                            }

                        },
                        error: function () {
                            toastr['error']("Something Went Wrong.");
                        }
                    });
                } else {
                    toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                    $('#time').val('');
                }
            } else {
                var currentTimeOne = moment($("#time").val(), "HH:mm a");
                var isBetweenOne = currentTimeOne.isBetween(startNewTime, endNewTime);
                if (isBetweenOne) {
                    e.preventDefault();
                    let form = $('#add-orders');
                    var request = $(form).serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.order.store') }}",
                        data: request,
                        dataType: "json",
                        cache: false,
                        success: function (response) {
                            toastr[response.data.flash_status](response.data.flash_message);

                            if (response.data.flash_status == "success") {
                                window.location = '{{route('admin.get.order.history')}}';
                            }

                        },
                        error: function () {
                            toastr['error']("Something Went Wrong.");
                        }
                    });
                } else {
                    toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                    $('#time').val('');
                }
            }







        });



        $('#admin_discount').keyup(function() {
            if(parseInt($(this).val()) > parseInt($('#net_price').val())){
                $(this).val($('#net_price').val())
            }
        });


        $(document).on("click", ".service_sub_category_package", function () {

            if ($(".service_sub_category_package:checkbox:checked").length > 0) {

                $("#get-orders").removeAttr("disabled");

            } else {

                if ($(".service_sub_category:checkbox:checked").length == 0) {
                    $("#get-orders").attr("disabled", "disabled");
                } else {
                    $("#get-orders").removeAttr("disabled");
                }

            }
        });

        $(document).on("click", ".service_sub_category", function () {

            if($("#service_category_id").val() != ''){

                if ($(".service_sub_category:checkbox:checked").length > 0) {
                    $("#get-orders").removeAttr("disabled");
                } else {
                    $("#get-orders").attr("disabled", "disabled");
                }
            }else{
                $("#get-orders").removeAttr("disabled");
            }

        });


    </script>

@endpush


