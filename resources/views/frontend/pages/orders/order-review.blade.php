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
        button.close
        {
            color: #fff !important;
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
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-12 orderReviewImage">
                                        <img src="{{ asset('/uploads/user_profiles/'.auth()->user()->profile_pic) }}"
                                             alt="{{auth()->user()->profile_pic}}">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-12 orderReviewDetails">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <h4 id="user_name">{{ auth()->user()->fullName() }}
                                                </h4>
                                                <p id="mobile_number"></p>
                                                <p>Date/Time: <span id="dateTime"></span></p>
                                                <p>No. of Persons <span id="no_of_persons"></span></p>
                                                {{--                                                <p>6:43:09 PM</p>--}}
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <h4>Address</h4>
                                                <p id="address"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mrgnDiv">
                                                <h4>Special Instructions</h4>
                                                <p id="specialInstructions"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 text-right mrgnDiv">
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                            class="btn buttonMain hvr-bounce-to-right">Cancel
                                    </button>
                                    <a href="#" id="finalOrder" class="btn buttonMain hvr-bounce-to-right">Confirm</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 selectedServicesRight selectedServicesRight2">
                                <h4 class="selectedServicesRightHeading">Services Ordered</h4>
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
                                            <h5><strong>Membership Discount: </strong>(<span
                                                    id="memberships_discount_type"></span>)</h5>
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
                                            <h5><strong>First Order Discount: </strong>(<span
                                                    id="first_order_discount_type"></span>)</h5>
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
                                            <h5><strong>Referral Discount: </strong>(<span
                                                    id="referral_discount_type"></span>)</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <h5><strong>Rs. <span
                                                        id="referral_discount">0</span></strong>
                                            </h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="row">

                                        <div class="destroyCoupon" style="display: none">

                                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                                <h5><strong>Discount (<span id="coupon-discount-name"></span>)</strong>
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


        $(document).ready(function () {


            var orderDiscountApply = JSON.parse(localStorage.getItem('couponDiscount'));

            $('#order-cancel').click(function () {
                localStorage.clear();
                window.location.href = '{{ route('service') }}';
            });

            $('#finalOrder').click(function () {
                var finalOrder = JSON.parse(localStorage.getItem('finalOrder'));
                var orderDiscount = JSON.parse(localStorage.getItem('orderDiscount'));


                if (finalOrder != null) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.final') }}",
                        data: {
                            'finalOrder': finalOrder,
                            'orderDiscount': orderDiscount,
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

                                window.location = '{{route('customer.order.history')}}';
                            }
                        },
                        error: function () {
                            toastr['error']("Something Went Wrong.");
                        }
                    });
                } else {
                    toastr['error']("You didn't have selected any item yet.");
                }

            });
            var already_set_services = JSON.parse(localStorage.getItem('services'));
            var finalOrder = JSON.parse(localStorage.getItem('finalOrder'));

            if (finalOrder != null) {
                $('#mobile_number').text(finalOrder.mobileNumber);
                $('#address').text(finalOrder.address);
                $('#specialInstructions').text(finalOrder.specialInstructions);
                $('#dateTime').text(finalOrder.requestedDatetime);
                $('#no_of_persons').text(finalOrder.noOfPeople);
            }
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
                        html += '<hr style="margin: 10px 0; border: #ff6c2b dotted 1px;">';
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
                        packagesHTML += '<hr style="margin: 10px 0; border: #ff6c2b dotted 1px;"></div>';

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
                $('#memberships_discount_type').text('{{$membership_discount->percent_off}}%');
                @elseif($membership_discount->type == 'fixed')
                    discount = '{{($membership_discount->value) }}';
                subtotal = subtotal - parseInt(discount);
                $('#membership_discount').text(discount);
                $('#memberships_discount_type').text('{{$membership_discount->type}}');
                @endif
                $('.memberShips_section').css('display', 'block');
                $('#total').text(subtotal);
                    @endif

                    @if(isset($first_order_discount) && !empty($first_order_discount))
                var $first_order_discount = 0;
                @if($first_order_discount->type == 'percentage')
                    $first_order_discount = '{{($first_order_discount->percent_off / 100) }}';
                var first_order_discounted_price = parseFloat($first_order_discount) * parseInt($('#total').text());
                total = parseInt($('#total').text()) - first_order_discounted_price;
                $('#first_order_discount').text(first_order_discounted_price);
                $('#first_order_discount_type').text('{{$first_order_discount->percent_off}}%');
                @elseif($first_order_discount->type == 'fixed')
                    $first_order_discount = '{{($first_order_discount->value) }}';
                total = parseInt($('#total').text()) - parseInt($first_order_discount);
                $('#first_order_discount').text($first_order_discount);
                $('#first_order_discount_type').text('{{$first_order_discount->type}}');
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
                $('#referral_discount_type').text('{{$referral_discount->percent_off}}%');
                @elseif($referral_discount->type == 'fixed')
                    referral_discount = '{{($referral_discount->value) }}';
                total = parseInt($('#total').text()) - parseInt(referral_discount);
                $('#referral_discount').text(referral_discount);
                $('#referral_discount_type').text('{{$referral_discount->type}}');
                @endif
                $('.referral_discount_section').css('display', 'block');
                $('.coupon').css('display', 'none');
                $('#total').text(total);
                @endif


                if (orderDiscountApply != '' && orderDiscountApply != null) {
                    if (orderDiscountApply.type != null && orderDiscountApply.amount != null) {
                        $('#coupon-discount-name').text(orderDiscountApply.type);
                        $('#coupon_discount-value').text(orderDiscountApply.amount);

                        total = parseInt($('#total').text());


                        total = total - parseInt(orderDiscountApply.amount);
                        $('#total').text(total);

                        $('.destroyCoupon').show();
                        $('.coupon').hide();

                    }
                }

            }

        });


        $("#applyCoupon").submit(function (e) {
            e.preventDefault();
            form = $(this);
            var request = $(form).serialize();
            if ($('#subtotalvalue').val() > 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('customer.coupons.store') }}",
                    data: request,
                    dataType: "json",
                    cache: false,
                    success: function (response) {

                        if (response.data.flash_status == "success" && response.data.session == 'yes') {
                            toastr[response.data.flash_status](response.data.flash_message);
                            $('#coupon-discount-name').text(response.data.name);
                            $('#coupon_discount-value').text(response.data.discount);
                            couponType = response.data.type;
                            coupon_id = response.data.coupon_id;
                            $('#coupon_id').val(coupon_id);
                            if (response.data.type == 'percent') {
                                percentOff = response.data.percent_off;
                            } else {
                                fixedPrice = response.data.fixed_price;
                            }

                            var subtotal_new = parseInt($('#subtotal').text());
                            $('#total').text(subtotal_new - response.data.discount);
                            $('.coupon').hide();
                            $('.destroyCoupon').show();

                        } else {
                            $('#coupon-discount-name').text('');
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
            } else {
                toastr['error']("You didn't have selected any item yet.");
            }

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
                        $('#coupon-discount-name').text('');
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
