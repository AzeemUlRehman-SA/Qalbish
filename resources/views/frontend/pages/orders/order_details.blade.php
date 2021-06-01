@extends('frontend.layout.app')
@section('title','Orders')
@push('css')

    <style>
        .pl-19 {
            padding-left: 19px;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .mb-27 {
            margin-bottom: 27px;
        }

        .mb-9 {
            margin-bottom: 9px;
        }

        .pt-20 {
            padding-top: 20px;
        }


        .modal-content {
            width: 406px;
            margin: 0 auto;
        }

        .modal-title {
            margin: 0;
            line-height: 1.42857143;
            float: left;
            color: #fff;
        }

        .modal-header {
            background: #ff6c2b;
            color: #fff;
        }

        button.close {
            color: #fff !important;
        }


        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #fcefe1;
            opacity: 1;
        }


        #coupon-checkbox {
            margin-top: -10px;
        }

        .positions-checkbox {
            position: absolute !important;
            margin-left: -14px !important;
        }

        .positions-checkbox-1 {
            position: absolute;
            margin-left: 12px;
        }

        @media screen and (max-width: 550px) {
            .modal-content {
                width: 100%;
                margin: 0 auto;
            }

            .modal-dialog {
                margin: 5px;
            }

            .serviceDetBtn a {
                margin: 10px 0;
            }
        }

        @media screen and (max-width: 850px) {
            .selectedServicesRight .serviceDetBtn .buttonMain {
                margin-top: 0px !important;
            }
        }

    </style>
@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                </div>
            </div>
            <div class="serviceInnerMain">
                <div class="serviceBoxMain">
                    <div class="serverInnerDetails">
                        <div class="row">

                            <div class="col-md-8 col-sm-8 col-xs-12 bannerFields">
                                <h4>Confirm Appointment Details</h4>
                                <form action="#" method="post">
                                    <div class="row">
                                        <input type="hidden" name="grand_total" id="grand_total" value="0">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="datetimepicker1">Date</label>
                                                <input type="text" name="date" id="datetimepicker1" onkeypress="return false;"
                                                       class="form-control" required>


                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="time">Time <span style="font-size: 12px; color:#000;">(Operating hours are between 9:30 AM to 8:00 PM)</span></label>
                                                    <input type="text" name="time" id="time" class="form-control" required onkeypress="return false;">

                                                {{--                                                <div class="input-group bootstrap-timepicker timepicker">--}}
                                                {{--                                                    <label for="time">Time <span style="font-size: 12px; color:#000;">(Operating hours are between 9:30 AM to 8:00 PM)</span></label>--}}

                                                {{--                                                    <input id="time" type="text" class="form-control input-small">--}}
                                                {{--                                                    <span class="input-group-addon"><i--}}
                                                {{--                                                            class="glyphicon glyphicon-time"></i></span>--}}
                                                {{--                                                </div>--}}

                                                <span class="invalid-feedback" role="alert" style="display: none">
                                                    <strong>Please add time with gap of 2 hrs from now</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="mobile_number">Mobile Number</label>
                                                <input type="tel" name="mobile_number" id="mobile_number"
                                                       class="form-control" value="{{ $user->phone_number }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" name="address" class="form-control"
                                                       value="{{ $user->address }}" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="city_id">City</label>

                                                <input type="text" name="city_name" id="city_name" class="form-control"
                                                       required=""
                                                       readonly value="{{$city_name}}">

                                                <input type="hidden" name="city_id" id="city_id" class="form-control"
                                                       required=""
                                                       readonly value="{{$user->city_id}}">
                                                {{--                                                <select name="city_id" id="city_id" class="form-control" required=""--}}
                                                {{--                                                        readonly="">--}}
                                                {{--                                                    <option value="{{ $user->city_id }}"--}}
                                                {{--                                                            selected>{{$city_name}}</option>--}}
                                                {{--                                                </select>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="area_id">Area</label>

                                                <input type="hidden" name="area_id" id="area_id" class="form-control"
                                                       required=""
                                                       readonly value="{{$user->area_id}}">

                                                <input type="text" name="area_name" id="area_name" class="form-control"
                                                       required=""
                                                       readonly value="{{$user->area->name}}">
                                                <select class="form-control areass_add" name="areass_add" id="area_id"
                                                        required="" hidden>
                                                    @foreach($areas as $area)
                                                        <option
                                                            value="{{ $area->id }}" {{ ($area->id == $user->area_id) ? 'selected' : '' }}>{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkbox-clicked"><label
                                                    for="alternate-address">Alternate Address for This Service</label>
                                                <textarea type="text" id="alternate-address" name="alternate-address"
                                                          rows="3"
                                                          class="form-control" style="display: none"
                                                          value=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="no_of_peoples">Number of People</label>

                                                <select class="form-control" id="no_of_peoples" name="no_of_peoples">
                                                    <option value="1" selected>1</option>
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
                                                {{--                                                <input type="number" name="no_of_peoples" value="1" id="no_of_peoples"--}}
                                                {{--                                                       class="form-control">--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="special_notes">Notes</label>
                                                <textarea class="form-control" id="special_notes" name="special_notes"
                                                          rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    <div class="row">--}}
                                    {{--                                        <div class="col-md-12 col-sm-12 col-xs-12 text-right">--}}
                                    {{--                                            --}}{{--                                            <a href="#" id="order-cancel" class="btn buttonMain hvr-bounce-to-right">Cancel--}}
                                    {{--                                            --}}{{--                                            </a>--}}
                                    {{--                                            <a href="#" id="order-reviews" class="btn buttonMain hvr-bounce-to-right">Review--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                </form>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 selectedServicesRight selectedServicesRight2">
                                <h4 class="selectedServicesRightHeading">Your Services</h4>
                                <div class="selectedServices">
                                    <div class="row" id="add-orders">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                            <h5><strong>Sub Total</strong></h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <h5><strong>Rs. <span
                                                        id="subtotal">0</span></strong>
                                            </h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="row memberShips_section" style="display: none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                            <h5><strong>Membership Discount: </strong>
                                                {{--                                                (<span id="memberships_discount_type"></span>)--}}
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
                                            <h5><strong>First Order Discount: </strong>
                                                {{--                                                (<span id="first_order_discount_type"></span>)--}}
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
                                            <h5><strong>Referral Discount: </strong>
                                                {{--                                                (<span id="referral_discount_type"></span>)--}}
                                            </h5>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <h5><strong>Rs. <span
                                                        id="referral_discount">0</span></strong>
                                            </h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>


                                    <div class="row delivery-charges" style="display: none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                            <h5><strong>Delivery Charges: </strong>
                                                {{--                                                (<span id="referral_discount_type"></span>)--}}
                                            </h5>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <h5><strong>Rs. <span
                                                        id="delivery-charges-price">0</span></strong>
                                            </h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="row">
                                        <div class="destroyCoupon" style="display: none">

                                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                                <h5><strong>Discount
                                                        {{--                                                        (<span id="coupon-discount-name"></span>)--}}
                                                    </strong>
                                                </h5>
                                                {{--                                                <form action="#" method="post"--}}
                                                {{--                                                      id="destroyCouponForm"--}}
                                                {{--                                                      style="display:inline">--}}
                                                {{--                                                    @csrf--}}
                                                {{--                                                    @method('delete')--}}
                                                {{--                                                    <input type="hidden" name="coupon_id" id="coupon_id" value="0">--}}
                                                {{--                                                    <button type="submit" style="font-size:14px">Remove</button>--}}
                                                {{--                                                </form>--}}
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                                <h5><strong>Rs. <span
                                                            id="coupon_discount-value"></span></strong>
                                                </h5>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="coupon">
                                            <div class="col-md-12 mb-27">

                                                <div class="col-md-2 col-sm-12 col-xs-12 ">

                                                    <div class="form-group">
                                                        <input type="checkbox" id="coupon-checkbox"
                                                               class="positions-checkbox">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-12 col-xs-12 positions-checkbox-1">
                                                    <label>Have a Code?</label>
                                                </div>
                                            </div>
                                            <form action="#" id="applyCoupon" method="post" autocomplete="off"
                                                  style="display: none">
                                                @csrf
                                                <div class="col-md-7 col-sm-12 col-xs-12">

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="coupon_code">
                                                        <input type="hidden" class="form-control"
                                                               name="subtotalvalue" value="0"
                                                               id="subtotalvalue">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <button type="submit"
                                                                class="btn buttonMain hvr-bounce-to-right">
                                                            Apply
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div class="serviceBoxHeader">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <h5>Rs. <span id="total">0</span>
                                            </h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center serviceDetBtn">
                                    <a href="{{ route('service') }}" class="btn buttonMain hvr-bounce-to-right"><strong>Back</strong></a>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                            class="btn buttonMain hvr-bounce-to-right"><strong>Cancel</strong>
                                    </button>
                                    <a href="#" id="finalOrder" class="btn buttonMain hvr-bounce-to-right"><strong>Confirm</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('models')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center p-3 f-13">
                        <span>Are you sure you want to cancel the order?</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn buttonMain hvr-bounce-to-right" data-dismiss="modal">Close</button>
                    <a href="#" class="btn buttonMain hvr-bounce-to-right" id="order-cancel">Yes</a>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script>
        total = 0;
        subtotal = 0;
        couponType = '';
        fixedPrice = 0;
        percentOff = 0;
        coupon_id = 0;
        total_addon_price_for_order = 0;
        let services;
        let final_order;
        let orderDiscount = {
            memberships_discount: null,
            first_order_discount: null,
            referral_discount: null,
            referral_user_id: null,

        };

        let couponDiscount = {
            amount: 0,
            type: null,
            code: null,
        };


        $(document).ready(function () {


            $('.areass_add').hide();

            $('#checkbox-clicked').click(function (e) {

                if ($(this).is(':checked')) {
                    $('#alternate-address').css('display', 'block');
                } else {
                    $('#alternate-address').css('display', 'none');
                }

            });
            $('#coupon-checkbox').click(function (e) {

                if ($(this).is(':checked')) {
                    $('#applyCoupon').css('display', 'block');
                } else {
                    $('#applyCoupon').css('display', 'none');
                }

            });

            $('#order-cancel').click(function () {
                localStorage.clear();
                window.location.href = '{{ route('service') }}';
            });


            function saveOrder() {
                var get_services = JSON.parse(localStorage.getItem('services'));
                if (get_services != null && get_services.length > 0) {
                    var newServices = {
                        services: get_services,
                        areaId: $('#area_id').val(),
                        cityId: $('#city_id').val(),
                        address: $('#address').val(),
                        noOfPeople: $('#no_of_peoples').val(),
                        requestedDatetime: $('#datetimepicker1').val(),
                        time: $('#time').val(),
                        specialInstructions: $('#special_notes').val(),
                        mobileNumber: $('#mobile_number').val(),
                        totalPrice: $('#total').text(),
                        grandTotal: $('#grand_total').val(),
                        subtotal: $('#subtotal').text(),
                        alternateAddress: $('#alternate-address').val(),
                        timeZone:Intl.DateTimeFormat().resolvedOptions().timeZone
                    };
                    localStorage.setItem('finalOrder', JSON.stringify(newServices));


                    var finalOrder = JSON.parse(localStorage.getItem('finalOrder'));
                    var orderDiscount = JSON.parse(localStorage.getItem('orderDiscount'));


                    if (finalOrder != null) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('order.final') }}",
                            data: {
                                'finalOrder': finalOrder,
                                'orderDiscount': orderDiscount,
                                'couponDiscount': couponDiscount,
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: "json",
                            cache: false,
                            success: function (response) {

                                toastr[response.data.flash_status](response.data.flash_message);

                                if (response.data.flash_status == "success") {
                                    localStorage.removeItem('finalOrder');
                                    localStorage.removeItem('services');
                                    localStorage.removeItem('orderDiscount');
                                    localStorage.removeItem('couponDiscount');
                                    window.location = "{{ route('customer.user.order.show', ['id' => "_ORDER_ID_"]) }}".replace('_ORDER_ID_', response.data.order_id);
                                }
                            },
                            error: function () {
                                toastr['error']("Something Went Wrong.");
                            }
                        });
                    } else {
                        toastr['error']("You didn't have selected any item yet.");
                    }

                }
            }

            var startTime = '09:15am';
            var endTime = '08:15pm';
            var startNewTime = moment(startTime, "HH:mm a");
            var endNewTime = moment(endTime, "HH:mm a");

            $('#finalOrder').click(function () {

                if (moment().format('DD/MM/YYYY') == $('#datetimepicker1').val()) {

                    // $('#time').val(date.add(2, 'hours').format('hh:mm A'));
                    var currentTime = moment($("#time").val(), "HH:mm a");
                    var isBetween = currentTime.isBetween(startNewTime, endNewTime);
                    if (isBetween) {
                        saveOrder();
                    } else {
                        toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                        $('#time').val('');
                    }
                } else {
                    var currentTimeOne = moment($("#time").val(), "HH:mm a");
                    var isBetweenOne = currentTimeOne.isBetween(startNewTime, endNewTime);
                    if (isBetweenOne) {
                        saveOrder();
                    } else {
                        toastr['warning']('Operating hours are between 9:30 AM to 8:00 PM');
                        $('#time').val('');
                    }
                }


            });

            var orderDiscountApply = JSON.parse(localStorage.getItem('couponDiscount'));
            localStorage.removeItem('orderDiscount');

            $('#order-reviews').click(function () {
                var get_services = JSON.parse(localStorage.getItem('services'));
                if (get_services != null && get_services.length > 0) {
                    var newServices = {
                        services: get_services,
                        areaId: $('#area_id').val(),
                        cityId: $('#city_id').val(),
                        address: $('#address').val(),
                        noOfPeople: $('#no_of_peoples').val(),
                        requestedDatetime: $('#datetimepicker1').val(),
                        time: $('#time').val(),
                        specialInstructions: $('#special_notes').val(),
                        mobileNumber: $('#mobile_number').val(),
                        totalPrice: $('#total').text(),
                        grandTotal: $('#grand_total').val(),
                        subtotal: $('#subtotal').text(),
                        alternateAddress: $('#alternate-address').text()
                    };
                    localStorage.setItem('finalOrder', JSON.stringify(newServices));
                    window.location.href = '{{ route('order.review') }}';
                } else {
                    toastr['warning']('Please select services to proceed');
                }
            });


            var already_set_services = JSON.parse(localStorage.getItem('services'));

            if (already_set_services != null) {
                for (var i = 0; i < already_set_services.length; i++) {

                    if (already_set_services[i].type == 'Service') {

                        $('#toBeAppend' + already_set_services[i].subcategoryId + ' input[id=menu_items_name' + already_set_services[i].id + ']').prop('checked', true);
                        $('#toBeAppend' + already_set_services[i].subcategoryId + ' select[id=menu_items_quantity' + already_set_services[i].id + ']').val(already_set_services[i].quantity);
                        $('#serviceAppendSubDiv' + already_set_services[i].id + '').css('display', 'block');

                        //Order Div Start
                        var html = "";
                        html += '<div id="menu_items_orders' + already_set_services[i].id + '">';
                        html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        html += '<div class="row">';

                        html += '<div class="col-md-10 col-sm-9 col-xs-10">';
                        html += '<h4><span>' + already_set_services[i].name + '</span> x <span id="menu_items_order_quantity' + already_set_services[i].id + '">' + already_set_services[i].quantity + '</span></h4>';
                        html += '<span>Rs. </span><span id="menu_items_order_price' + already_set_services[i].id + '">' + (already_set_services[i].quantity * already_set_services[i].amount) + '</span>';
                        html += '</div>';

                        // html += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                        // html += '<a onclick="deleteMenuItemOrders(' + already_set_services[i].id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                        // html += '</div>';

                        html += '<div class="clearfix"></div>';
                        html += '</div>';
                        html += '<div id="menu_items_orders_addOnDiv' + already_set_services[i].id + '">';
                        html += '</div>';
                        html += '</div>';

                        html += '<div class="clearfix"></div>';
                        html += '<hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">';
                        html += '</div>';

                        subtotal += (already_set_services[i].quantity * already_set_services[i].amount);


                        $('#add-orders').append(html);

                        //Order Div End


                        var addons = already_set_services[i].addOns;
                        for (var j = 0; j < addons.length; j++) {

                            $('#toBeAppend' + already_set_services[i].subcategoryId + ' #serviceAppendSubDiv' + addons[j].subcategoryId + ' input[id=addons_name' + +addons[j].id + ']').prop('checked', true);
                            $('#toBeAppend' + already_set_services[i].subcategoryId + ' #serviceAppendSubDiv' + addons[j].subcategoryId + ' select[id=addon_quantity' + +addons[j].id + ']').val(addons[j].quantity);

                            //Order Div Start
                            var addonHTML = "";
                            addonHTML += '<div class="addOnDiv" id="addOnDiv' + addons[j].id + '">';
                            addonHTML += '<div class="row">';
                            addonHTML += '<div class="col-md-10 col-sm-9 col-xs-10">';
                            addonHTML += ' <h4><strong>Addon</strong></h4>';
                            addonHTML += ' <h4><span>' + addons[j].name + '</span> x <span id="add_on_order_quantity' + addons[j].id + '">' + addons[j].quantity + '</span></h4>';
                            addonHTML += '<span>Rs. </span><span id="add_on_order_price' + addons[j].id + '">' + (addons[j].quantity * addons[j].amount) + '</span>';
                            addonHTML += '</div>';
                            // addonHTML += '<div class="col-md-2 col-sm-3 col-xs-2 text-right pt-20">';
                            // addonHTML += '<a onclick="deleteMenuItemOrderAddons(' + addons[j].id + ',' + addons[j].subcategoryId + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                            // addonHTML += '</div>';
                            addonHTML += '<div class="clearfix"></div>';
                            addonHTML += '</div>';
                            addonHTML += '</div>';

                            $('#menu_items_orders_addOnDiv' + already_set_services[i].id + '').append(addonHTML);
                            //Order Div Start

                            subtotal += (addons[j].quantity * addons[j].amount);
                        }
                    } else {
                        $('#toBeAppendPackages' + already_set_services[i].id + ' input[id=checkOrUncheckPackage' + already_set_services[i].id + ']').prop('checked', true);
                        $('#toBeAppendPackages' + already_set_services[i].id + ' select[id=package_quantity' + already_set_services[i].id + ']').val(already_set_services[i].quantity);
                        $('#serviceAppendPackageSubDiv' + already_set_services[i].id + '').css('display', 'block');

                        //Order Div Start
                        var packagesHTML = "";
                        packagesHTML += '<div id="menu_items_orders_package' + already_set_services[i].id + '">';
                        packagesHTML += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        packagesHTML += '<div class="row">';
                        packagesHTML += '<div class="col-md-10 col-sm-9 col-xs-10">';
                        packagesHTML += '<h4><span>' + already_set_services[i].name + '</span> x <span id="menu_items_order_quantity_package' + already_set_services[i].id + '">' + already_set_services[i].quantity + '</span></h4>';
                        packagesHTML += '<span>Rs. </span><span id="menu_items_order_price_package' + already_set_services[i].id + '">' + (already_set_services[i].quantity * already_set_services[i].amount) + '</span>';
                        packagesHTML += '</div>';
                        // packagesHTML += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                        // packagesHTML += '<a onclick="deletePackageOrders(' + already_set_services[i].id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                        // packagesHTML += '</div>';
                        packagesHTML += '<div class="clearfix"></div>';
                        packagesHTML += '</div>';
                        packagesHTML += '<div id="menu_items_orders_addOnDiv' + already_set_services[i].id + '"></div>';
                        packagesHTML += '</div>';
                        packagesHTML += '<div class="clearfix"></div>';
                        packagesHTML += '<hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;"></div>';

                        $('#add-orders').append(packagesHTML);
                        //Order Div Start

                        subtotal += (already_set_services[i].quantity * already_set_services[i].amount);
                    }

                }
                $('#subtotal').text(subtotal);
                $('#total').text(subtotal);

                    @if(isset($membership_discount) && !empty($membership_discount))

                var discount = 0;
                @if($membership_discount->type == 'percentage')
                    discount = '{{($membership_discount->percent_off / 100) }}';
                var discounted_price = parseFloat(discount) * subtotal;
                subtotal = subtotal - discounted_price;
                $('#membership_discount').text(discounted_price);
                orderDiscount.memberships_discount = discounted_price;
                @elseif($membership_discount->type == 'fixed')
                    discount = '{{($membership_discount->value) }}';
                subtotal = subtotal - parseInt(discount);

                $('#membership_discount').text(discount);
                orderDiscount.memberships_discount = discount;
                @endif
                $('.memberShips_section').css('display', 'block');
                $('#total').text(subtotal);

                @else
                $('#total').text(parseInt($('#subtotal').text()));
                    @endif

                    @if(isset($first_order_discount) && !empty($first_order_discount))
                var $first_order_discount = 0;
                @if($first_order_discount->type == 'percentage')
                    $first_order_discount = '{{($first_order_discount->percent_off / 100) }}';
                var first_order_discounted_price = parseFloat($first_order_discount) * parseInt($('#total').text());
                total = parseInt($('#total').text()) - first_order_discounted_price;
                $('#first_order_discount').text(first_order_discounted_price);
                orderDiscount.first_order_discount = first_order_discounted_price;
                @elseif($first_order_discount->type == 'fixed')
                    $first_order_discount = '{{($first_order_discount->value) }}';
                total = parseInt($('#total').text()) - parseInt($first_order_discount);
                $('#first_order_discount').text($first_order_discount);
                orderDiscount.first_order_discount = $first_order_discount;
                @endif
                $('.first_order_discount_section').css('display', 'block');
                $('.coupon').css('display', 'none');
                $('#total').text(total);

                    @elseif(isset($referral_discount) && !empty($referral_discount))
                var referral_discount = 0;
                @if($referral_discount->type == 'percentage')
                    referral_discount = '{{($referral_discount->percent_off / 100) }}';
                var referral_discounted_price = parseFloat(referral_discount) * parseInt($('#total').text());
                total = parseInt($('#total').text()) - referral_discounted_price;
                $('#referral_discount').text(discounted_price);
                orderDiscount.referral_discount = referral_discounted_price;
                @elseif($referral_discount->type == 'fixed')
                    referral_discount = '{{($referral_discount->value) }}';
                total = parseInt($('#total').text()) - parseInt(referral_discount);
                $('#referral_discount').text(referral_discount);
                orderDiscount.referral_discount = referral_discount;
                @endif
                    orderDiscount.referral_user_id = '{{$referral_user_id}}';
                $('.referral_discount_section').css('display', 'block');
                $('.coupon').css('display', 'none');
                $('#total').text(total);
                    @endif


                var area_price = 0;
                area_price = parseInt({{ $area->price }});
                total = parseInt($('#total').text());

                if (total > (area_price)) {

                    total = total + (area_price);
                    $('#total').text(total);
                    $('#subtotalvalue').val(total);

                    $('#delivery-charges-price').text(parseInt(area_price));
                    $('.delivery-charges').css('display', 'block');
                }

                localStorage.setItem('orderDiscount', JSON.stringify(orderDiscount));
                if (orderDiscountApply != '' && orderDiscountApply != null) {
                    if (orderDiscountApply.type != null && orderDiscountApply.amount != null) {
                        $('#coupon_discount-value').text(orderDiscountApply.amount);
                        total = parseInt($('#total').text());
                        total = total - parseInt(orderDiscountApply.amount);

                        $('#grand_total').val(total + parseInt(orderDiscountApply.amount));
                        $('#total').text(total);
                        $('.destroyCoupon').show();
                        $('.coupon').hide();

                    }
                }
            }

        });
        $('#datetimepicker1').datetimepicker({
            format: "DD/MM/YYYY",
            minDate: moment().add(0, 'hours'),
        });


        $('#time').datetimepicker({

            format: "hh:mm A",
            stepping: 15, //will change increments to 15m, default is 1m
            // minDate: moment().add(0, 'hours'),

        }).on('dp.change', function (e) {
            var date = e.date;//e.date is a moment object
            var target = $(e.target).attr('name');


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

        $("#applyCoupon").submit(function (e) {
            e.preventDefault();
            form = $(this);
            var request = $(form).serialize();
            // if ($('#subtotal').val() > 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('customer.coupons.store') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {

                    if (response.data.flash_status == "success" && response.data.session == 'yes') {
                        toastr[response.data.flash_status](response.data.flash_message);
                        // $('#coupon-discount-name').text(response.data.name);
                        $('#coupon_discount-value').text(response.data.discount);
                        couponType = response.data.type;
                        coupon_id = response.data.coupon_id;
                        $('#coupon_id').val(coupon_id);
                        if (response.data.type == 'percent') {
                            percentOff = response.data.percent_off;
                        } else {
                            fixedPrice = response.data.fixed_price;
                        }

                        couponDiscount.amount = response.data.discount;
                        couponDiscount.type = response.data.type;
                        couponDiscount.code = response.data.name;

                        localStorage.setItem('couponDiscount', JSON.stringify(couponDiscount));

                        var subtotal_new = parseInt($('#subtotal').text());
                        var total_new = parseInt($('#total').text());
                        $('#total').text(total_new - response.data.discount);
                        $('#grand_total').val(total_new);
                        $('.coupon').hide();
                        $('.destroyCoupon').show();

                    } else {
                        // $('#coupon-discount-name').text('');
                        $('#coupon_discount-value').text('');
                        $('.coupon').show();
                        $('.destroyCoupon').hide();
                        toastr[response.data.flash_status](response.data.flash_message);
                    }
                },
                error: function () {
                    toastr['error']("Something Went Wrong.");
                }
            });
            // } else {
            //     toastr['error']("You didn't have selected any item yet.");
            // }

        });

        $("#destroyCouponForm").submit(function (e) {
            e.preventDefault();
            form = $(this);
            var request = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('customer.coupons.destroy') }}",
                data: request,
                dataType: "json",
                cache: false,
                success: function (response) {

                    if (response.data.flash_status == "success") {
                        toastr[response.data.flash_status](response.data.flash_message);

                        var discountedValue = parseInt($('#coupon_discount-value').text());
                        var totalValue = parseInt($('#total').text());
                        $('#total').text(discountedValue + totalValue);
                        // $('#coupon-discount-name').text('');
                        $('#coupon_discount-value').text('');
                        $('.coupon').show();
                        $('.destroyCoupon').hide();

                    }
                },
                error: function () {
                    toastr['error']("Something Went Wrong.");
                }
            });
        });


    </script>
@endpush
