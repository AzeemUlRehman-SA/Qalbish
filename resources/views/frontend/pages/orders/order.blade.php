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


        /*.modal-content {*/
        /*    width: 406px;*/
        /*    margin: 0 auto;*/
        /*}*/

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

        .owl-item {
            width: unset !important;
            text-transform: uppercase !important;
            padding-right: 15px !important;
            padding-left: 15px !important;
        }

        @media screen and (max-width: 550px) {
            .owl-item {
                width: 322px !important;
            }

            .serviceInnerTabContentHeading {
                font-size: 13px;
            }

            .serviceAppendBox select {
                background-position-x: 95%;
            }

            .serviceInnerTabContentSelect {
                margin-top: 10px;
            }
            .modal-content {
                width: 100%;
                margin: 0 auto;
            }
            .modal-dialog {
                margin: 5px;
            }
            .serviceDetBtn a
            {
                margin: 10px 0;
            }
        }

        @media screen and (max-width: 450px) {
            .owl-item {
                width: 254px !important;
            }
            .sectionHeading {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 415px) {
            .owl-item {
                width: 286px !important;
            }
        }

        @media screen and (max-width: 400px) {
            .owl-item {
                width: 254px !important;
            }
        }

        @media screen and (max-width: 374px) {
            .owl-item {
                width: 240px !important;
            }

            .serviceCarousel a {
                font-size: 11px;
                line-height: 8px;
            }
        }

        @media screen and (max-width: 359px) {
            .owl-item {
                width: 204px !important;
            }
        }
    </style>
@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    @if($servicename=="packages")
                    <h2 class="sectionHeading">PACKAGES</h2>
                    @else
                    <h2 class="sectionHeading">{{ $getservicedetail->name }}</h2>
                    @endif

                </div>
            </div>
            <div class="serviceInnerMain">
                @if($servicename=="packages")
                    <img src="{{ asset('/uploads/packages/1140x420_0002_03.jpg') }}" alt="" id="service_image">
                    <p id="service-description">Book our special packages and save up to 70% off your favourite treatments.</p>
                @else
                    <img src="{{ asset('uploads/service_category/'.$getservicedetail->image) }}" alt=""
                    id="service_image">
                    <p id="service-description">{{ $getservicedetail->description }}</p>
                @endif
                <div class="serviceBoxMain">
                    <div class="serviceBoxHeader">
                        <div class="col-md-12 col-sm-12 col-xs-12 serviceCarousel text-center">
                            <div class="owl-carousel" id="serviceCarousel">
                                <div class="item packageActiveClass">
                                    <a data-toggle="tab" href="#"
                                       class=" {{ ($servicename =="packages") ? 'activeServiceTab' : ''}} abcc" id="packagesBtn">Packages</a>
                                </div>
                                @if(!empty($services))
                                    @foreach($services as $service)
                                        <div class="item">
                                            <a data-toggle="tab" title="{{ $service->name }}" href="#{{$service->id}}"
                                               class="{{ ($service->name == $servicename) ? 'activeServiceTab' : ''}}"
                                               onclick="serviceTabs('{{ $service->name }}','{{ $service->image }}','{{$service->description}}')"
                                            >{{ $service->name }}
                                                {{--                                                {{ strtoupper(\Illuminate\Support\Str::limit($service->name,16)) }}--}}
                                            </a>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>
                        {{--                        <div class="col-md-2 col-sm-2 col-xs-12 servicePackageBtn">--}}
                        {{--                            <a data-toggle="tab" href="#packagesTab"--}}
                        {{--                               class="btn buttonMain hvr-bounce-to-right" id="packagesBtn">Packages</a>--}}
                        {{--                        </div>--}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="serverInnerDetails">
                        <div class="row">

                            <div class="col-md-8 col-sm-8 col-xs-12 noPaddDesktop">
                                <div class="serviceAppendContent">
                                    <div id="servicesTabsArea" class="tab-content">
                                        @if(!empty($services))
                                            @foreach($services as $key=>$service)
                                                <div id="{{ $service->id }}"
                                                     class="tab-pane fade in {{ ($service->name == $servicename) ? 'active' : ''}}">
                                                    <div class="col-md-12">

{{--                                                        <h4>{{ strtoupper($service->name) }}</h4>--}}
                                                        {{--                                                        <p>{{ ucfirst($service->description) }}</p>--}}
                                                        <div class="serviceAppendBox" id="toBeAppend{{ $service->id }}">
                                                            <div class="row">
                                                                @if(!empty($service->sub_categories))
                                                                    @foreach($service->sub_categories as $sub_categories)
                                                                        <div class="col-md-8 col-sm-7 col-xs-8">
                                                                            <div class="row">
                                                                                <div class="col-md-1 col-sm-2 col-xs-2">
                                                                                    <input type="checkbox"
                                                                                           id="menu_items_name{{$sub_categories->id}}"
                                                                                           name="menu_items_name{{$sub_categories->id}}"
                                                                                           onchange="showAddons('{{$service->id}}','{{$sub_categories->id}}')"
                                                                                           value="{{ ucfirst($sub_categories->name) }}">
                                                                                </div>
                                                                                &nbsp;
                                                                                <div
                                                                                    class="col-md-10 col-sm-9 col-xs-9 serviceInnerTabContentHeading">
                                                                                    {{ucfirst($sub_categories->name)}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-2 col-sm-2 col-xs-4 serviceInnerTabContentHeading">
                                                                            Rs. <span
                                                                                id="menu_items_price{{$sub_categories->id}}">
                                                                                @if($service->discount_type === 'fixed' )
                                                                                    {{ $sub_categories->price - $service->discount_price }}
                                                                                @elseif($service->discount_type === 'percentage')
                                                                                    {{ $sub_categories->price * (1- ($service->discount_price / 100)) }}
                                                                                @elseif($sub_categories->discount_type === 'fixed' )
                                                                                    {{ $sub_categories->price - $sub_categories->discount_price }}
                                                                                @elseif($sub_categories->discount_type === 'percentage')
                                                                                    {{ $sub_categories->price * (1- ($sub_categories->discount_price / 100)) }}
                                                                                @else
                                                                                    {{ $sub_categories->price }}
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2 col-xs-12"
                                                                             style="margin-bottom: 4px !important;">

                                                                            <select class="form-control"
                                                                                    disabled
                                                                                    id="menu_items_quantity{{$sub_categories->id}}"
                                                                                    onchange="menuItemsQuantity('{{$sub_categories->id}}','{{$service->id}}')"
                                                                                    name="menu_items_quantity">
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
                                                                        </div>
                                                                        <div class="clearfix"></div>



                                                                        <div class="col-md-12"
                                                                             id="serviceAppendSubDiv{{$sub_categories->id}}"
                                                                             style="display: none">
                                                                            <input type="hidden"
                                                                                   class="total_addon_price_for_order{{$sub_categories->id}}"
                                                                                   name="total_addon_price_for_order"
                                                                                   value="0">
                                                                            @if(!empty($sub_categories->addons) && $sub_categories->addons->count() > 0)
                                                                                <div
                                                                                    class="col-md-12 serviceAppendSubDiv mrgnDiv">
                                                                                    <div class="col-md-12">
                                                                                        <h4>Addons</h4>
                                                                                    </div>
                                                                                    @foreach($sub_categories->addons as $addons)
                                                                                        <div
                                                                                            class="col-md-8 col-sm-7 col-xs-8 serviceInnerTabContentHeading">

                                                                                            <input type="checkbox"
                                                                                                   name="addons_name"
                                                                                                   class="uncheckAddons{{$sub_categories->id}}"
                                                                                                   onchange="addOnsAddInOrder('{{$addons->id}}','{{$sub_categories->id}}')"
                                                                                                   id="addons_name{{$addons->id}}"
                                                                                                   value="{{ ucfirst($addons->name) }}">
                                                                                            &nbsp; {{ ucfirst($addons->name) }}
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-2 col-sm-2 col-xs-4 serviceInnerTabContentHeading">
                                                                                            Rs. <span
                                                                                                id="add_on_price{{$addons->id}}">{{ $addons->price }}</span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-2 col-sm-3 col-xs-12 mb-4 serviceInnerTabContentSelect"
                                                                                            style="margin-bottom: 4px !important; ">

                                                                                            <select
                                                                                                class="form-control addon_quantity{{$sub_categories->id}}"
                                                                                                name="addon_quantity"
                                                                                                disabled
                                                                                                onchange="addOnQuantity('{{$addons->id}}','{{$sub_categories->id}}')"
                                                                                                id="addon_quantity{{$addons->id}}">
                                                                                                <option value="1"
                                                                                                        selected>1
                                                                                                </option>
                                                                                                <option value="2">2
                                                                                                </option>
                                                                                                <option value="3">3
                                                                                                </option>
                                                                                                <option value="4">4
                                                                                                </option>
                                                                                                <option value="5">5
                                                                                                </option>
                                                                                                <option value="6">6
                                                                                                </option>
                                                                                                <option value="7">7
                                                                                                </option>
                                                                                                <option value="8">8
                                                                                                </option>
                                                                                                <option value="9">9
                                                                                                </option>
                                                                                                <option value="10">10
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                        <hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div id="packagesTabArea" class="tab-content">

                                        <div class="tab-pane fade in {{ ($servicename == 'packages') ? 'active' : ''}}" id="packagesTab">
                                            <div class="col-md-12">

                                                @if(!empty($packages))
                                                    @foreach($packages as $package)
                                                        <div class="serviceAppendBox mb-9"
                                                             id="toBeAppendPackages{{$package->id}}">
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-8 col-sm-7 col-xs-8 serviceInnerTabContentHeading">

                                                                    <div class="row">
                                                                        <div class="col-md-1 col-sm-2 col-xs-2">
                                                                            <input type="checkbox"
                                                                                   id="checkOrUncheckPackage{{ $package->id }}"
                                                                                   name="menu_items"
                                                                                   onchange="showPackage('{{ $package->id }}')"
                                                                                   value="{{ $package->name }}">
                                                                        </div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-9 serviceInnerTabContentHeading">
                                                                            <span>{{ $package->name }}</span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div
                                                                    class="col-md-2 col-sm-2 col-xs-4 serviceInnerTabContentHeading">
                                                                    <span> Rs. </span><span
                                                                        id="packages_price{{$package->id}}">{{ (int)$package->total_price }}</span>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 col-sm-2 col-xs-12 serviceInnerTabContentSelect"
                                                                    style="margin-bottom: 4px !important; ">

                                                                    <select class="form-control"
                                                                            disabled
                                                                            id="package_quantity{{$package->id }}"
                                                                            onchange="packageQuantity('{{$package->id}}')"
                                                                            name="package_quantity">
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
                                                                <div class="clearfix"></div>
                                                                <div class="col-md-12"
                                                                     id="serviceAppendPackageSubDiv{{ $package->id }}"
                                                                     style="display: none;">
                                                                    <div class="col-md-12 serviceAppendSubDiv mrgnDiv">
                                                                        <div class="col-md-12">
{{--                                                                            <h4>Menu Items</h4>--}}
                                                                        </div>
                                                                        @if(!empty($package->deal_services))
                                                                            @foreach($package->deal_services as $deal_service)
                                                                                @if(!empty($deal_service->deal_sub_categories))
                                                                                    @foreach($deal_service->deal_sub_categories as $deal_sub_category)
                                                                                        <div
                                                                                            class="col-md-8 col-sm-7 col-xs-12">
                                                                                            <span
                                                                                                class="mb-4">{{ $deal_sub_category->sub_category->name ?? '-' }}</span>

                                                                                            @if(!empty($deal_sub_category->deal_sub_category_addon))
                                                                                                <h4 class="mt-5">Add
                                                                                                    on</h4>
                                                                                                <ul class="pl-19">

                                                                                                    @foreach($deal_sub_category->deal_sub_category_addons as $deal_sub_category_addon)
                                                                                                        <li>{{ $deal_sub_category_addon->addon->name ?? '-' }}</li>
                                                                                                    @endforeach

                                                                                                </ul>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                        <hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--<hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">--}}

                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 selectedServicesRight">
                                <h4>Your Services</h4>
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
                                    <div class="row">
                                        <div class="destroyCoupon" style="display: none">

                                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                                <h5><strong>Discount (<span id="coupon-discount-name"></span>)</strong>
                                                </h5>
                                                <form action="#" method="post"
                                                      id="destroyCouponForm"
                                                      style="display:inline">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                                    <button type="submit" style="font-size:14px">Remove</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                                <h5><strong>Rs. <span
                                                            id="coupon_discount-value"></span></strong>
                                                </h5>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>

                                    {{--                                    <div class="row">--}}
                                    {{--                                        <div class="coupon">--}}
                                    {{--                                            <div class="col-md-12">--}}
                                    {{--                                                <h5>Have a code?</h5>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <form action="#" id="applyCoupon" method="post" autocomplete="off">--}}
                                    {{--                                                @csrf--}}
                                    {{--                                                <div class="col-md-7 col-sm-12 col-xs-12">--}}

                                    {{--                                                    <div class="form-group">--}}
                                    {{--                                                        <input type="text" class="form-control" name="coupon_code">--}}
                                    {{--                                                        <input type="hidden" class="form-control"--}}
                                    {{--                                                               name="subtotalvalue" value="0"--}}
                                    {{--                                                               id="subtotalvalue">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="col-md-5 col-sm-12 col-xs-12">--}}
                                    {{--                                                    <div class="form-group">--}}
                                    {{--                                                        <button type="submit"--}}
                                    {{--                                                                class="btn buttonMain hvr-bounce-to-right">--}}
                                    {{--                                                            Apply--}}
                                    {{--                                                        </button>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </form>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

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
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                            class="btn buttonMain hvr-bounce-to-right"><strong>Cancel</strong>
                                    </button>
                                    <a href="#" id="order-detials"
                                       class="btn buttonMain hvr-bounce-to-right"><strong>Book Now</strong></a>
                                    <span class="show-servies" style="color:red; display: none">Please select services to proceed</span>
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

        $('#order-cancel').click(function () {
            localStorage.clear();
            window.location.href = '{{ route('service') }}';
        });
        total = 0;
        subtotal = 0;
        couponType = '';
        fixedPrice = 0;
        percentOff = 0;
        coupon_id = 0;
        total_addon_price_for_order = 0;
        let services;

        let couponDiscount = {
            amount: 0,
            type: null,
            code:null,
        };


        $(document).ready(function () {

            localStorage.setItem('couponDiscount', JSON.stringify(couponDiscount));

            $('#order-detials').click(function () {
                var get_services = JSON.parse(localStorage.getItem('services'));


                if (parseInt($('#total').text()) >= 1000) {
                    if (get_services != null && get_services.length > 0) {
                        window.location.href = '{{ route('order.details') }}';
                        $('.show-servies').css('display', 'none');
                    } else {
                        $('.show-servies').css('display', 'block');
                        toastr['warning']('Please select services to proceed');
                    }
                } else {
                    toastr['warning']('Minimum Order is Rs 1000');
                }

            });

            var already_set_services = JSON.parse(localStorage.getItem('services'));

            if (already_set_services != null) {
                for (var i = 0; i < already_set_services.length; i++) {

                    if (already_set_services[i].type == 'Service') {

                        $('#toBeAppend' + already_set_services[i].subcategoryId + ' input[id=menu_items_name' + already_set_services[i].id + ']').prop('checked', true);
                        $('#toBeAppend' + already_set_services[i].subcategoryId + ' select[id=menu_items_quantity' + already_set_services[i].id + ']').val(already_set_services[i].quantity);
                        $('#serviceAppendSubDiv' + already_set_services[i].id + '').css('display', 'block');

                        $('#menu_items_quantity' + already_set_services[i].id + '').prop('disabled', false);
                        //Order Div Start
                        var html = "";
                        html += '<div id="menu_items_orders' + already_set_services[i].id + '">';
                        html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        html += '<div class="row">';

                        html += '<div class="col-md-10 col-sm-9 col-xs-10">';
                        html += '<h4><span>' + already_set_services[i].name + '</span> x <span id="menu_items_order_quantity' + already_set_services[i].id + '">' + already_set_services[i].quantity + '</span></h4>';
                        html += '<span>Rs. </span><span id="menu_items_order_price' + already_set_services[i].id + '">' + (already_set_services[i].quantity * already_set_services[i].amount) + '</span>';
                        html += '</div>';

                        html += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                        html += '<a onclick="deleteMenuItemOrders(' + already_set_services[i].id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                        html += '</div>';

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

                            $('#addon_quantity' + addons[j].id + '').prop('disabled', false);
                            //Order Div Start
                            var addonHTML = "";
                            addonHTML += '<div class="addOnDiv" id="addOnDiv' + addons[j].id + '">';
                            addonHTML += '<div class="row">';
                            addonHTML += '<div class="col-md-10 col-sm-9 col-xs-10">';
                            addonHTML += ' <h4><strong>Addon</strong></h4>';
                            addonHTML += ' <h4><span>' + addons[j].name + '</span> x <span id="add_on_order_quantity' + addons[j].id + '">' + addons[j].quantity + '</span></h4>';
                            addonHTML += '<span>Rs. </span><span id="add_on_order_price' + addons[j].id + '">' + (addons[j].quantity * addons[j].amount) + '</span>';
                            addonHTML += '</div>';
                            addonHTML += '<div class="col-md-2 col-sm-3 col-xs-2 text-right pt-20">';
                            addonHTML += '<a onclick="deleteMenuItemOrderAddons(' + addons[j].id + ',' + addons[j].subcategoryId + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                            addonHTML += '</div>';
                            addonHTML += '<div class="clearfix"></div>';
                            addonHTML += '</div>';
                            addonHTML += '</div>';

                            $('#menu_items_orders_addOnDiv' + already_set_services[i].id + '').append(addonHTML);
                            //Order Div Start

                            subtotal += (addons[j].quantity * addons[j].amount);
                            total_addon_price_for_order += (addons[j].quantity * addons[j].amount);


                            $('.total_addon_price_for_order' + addons[j].subcategoryId + '').val(total_addon_price_for_order);
                        }
                    } else {
                        $('#toBeAppendPackages' + already_set_services[i].id + ' input[id=checkOrUncheckPackage' + already_set_services[i].id + ']').prop('checked', true);
                        $('#toBeAppendPackages' + already_set_services[i].id + ' select[id=package_quantity' + already_set_services[i].id + ']').val(already_set_services[i].quantity);
                        $('#serviceAppendPackageSubDiv' + already_set_services[i].id + '').css('display', 'block');

                        $('#package_quantity' + already_set_services[i].id + '').prop('disabled', false);
                        //Order Div Start
                        var packagesHTML = "";
                        packagesHTML += '<div id="menu_items_orders_package' + already_set_services[i].id + '">';
                        packagesHTML += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        packagesHTML += '<div class="row">';
                        packagesHTML += '<div class="col-md-10 col-sm-9 col-xs-10">';
                        packagesHTML += '<h4><span>' + already_set_services[i].name + '</span> x <span id="menu_items_order_quantity_package' + already_set_services[i].id + '">' + already_set_services[i].quantity + '</span></h4>';
                        packagesHTML += '<span>Rs. </span><span id="menu_items_order_price_package' + already_set_services[i].id + '">' + (already_set_services[i].quantity * already_set_services[i].amount) + '</span>';
                        packagesHTML += '</div>';
                        packagesHTML += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                        packagesHTML += '<a onclick="deletePackageOrders(' + already_set_services[i].id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                        packagesHTML += '</div>';
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
            }
        });

        function serviceTabs(name, image, description) {
            $('#service_image').attr('src', 'uploads/service_category/' + image + '');
            $('#service-description').text(description);
            $('.sectionHeading').text(name);

            $('#servicesTabsArea').show();
            $('#packagesTabArea').hide();
        }


        function showAddons(service_id, id) {
            var menu_items_name = $('#menu_items_name' + id + '').val();
            var menu_items_price = $('#menu_items_price' + id + '').text();
            var menu_items_quantity = $('#menu_items_quantity' + id + ' option:selected').val();
            var html = "";
            if ($('#menu_items_name' + id + '').is(':checked')) {


                $('#menu_items_quantity' + id + '').removeAttr('disabled');


                $('#serviceAppendSubDiv' + id + '').css('display', 'block');

                html += '<div id="menu_items_orders' + id + '">';
                html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                html += '<div class="row">';
                html += '<div class="col-md-10 col-sm-9 col-xs-10">';
                html += '<h4><span>' + menu_items_name + '</span> x <span id="menu_items_order_quantity' + id + '">' + menu_items_quantity + '</span></h4>';
                html += '<span>Rs. </span><span id="menu_items_order_price' + id + '">' + (menu_items_price * menu_items_quantity) + '</span>';
                html += '</div>';
                html += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                html += '<a onclick="deleteMenuItemOrders(' + id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '</div>';
                html += '<div id="menu_items_orders_addOnDiv' + id + '">';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '<hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">';
                html += '</div>';

                $('#add-orders').append(html);
                subTotal = (parseInt($('#subtotal').text()) + (parseInt(menu_items_price) * parseInt(menu_items_quantity)));
                total = (parseInt($('#total').text()) + (parseInt(menu_items_price) * parseInt(menu_items_quantity)));
                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);


                    var newServices = {
                        id: id,
                        name: menu_items_name,
                        amount: parseInt(menu_items_price),
                        duration: 0,
                        quantity: parseInt(menu_items_quantity),
                        type: "Service",
                        subcategoryId: service_id,
                        isSelected: true,
                        addOns: []
                    };

                    services = JSON.parse(localStorage.getItem('services'));
                    if (services == null) {
                        services = [];
                    }
                    services.push(newServices);
                    localStorage.setItem('services', JSON.stringify(services));

            } else {

                $('#menu_items_quantity' + id + '').prop('disabled', true);
                var getservices = JSON.parse(localStorage.getItem('services'));

                for (var i = 0; i < getservices.length; i++) {

                    if (id == getservices[i].id && getservices[i].type == 'Service') {
                        getservices.splice(i, 1);
                    }
                }
                localStorage.setItem('services', JSON.stringify(getservices));
                subTotal = (parseInt($('#subtotal').text()) - (parseInt(menu_items_price) * parseInt(menu_items_quantity)));


                if (parseInt($('.total_addon_price_for_order' + id + '').val()) > 0) {
                    total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + id + '').val());
                    $('.total_addon_price_for_order' + id + '').val(0);

                    subTotal = subTotal - total_addon_price_for_order;
                }

                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);
                $('#serviceAppendSubDiv' + id + '').css('display', 'none');
                $('#menu_items_orders' + id + '').remove();
                $('.uncheckAddons' + id + '').prop('checked', false);
                $('#menu_items_quantity' + id + '').prop("selectedIndex", 0).trigger("change");
                $('.addon_quantity' + id + '').prop("selectedIndex", 0).trigger("change");


            }
        }

        function menuItemsQuantity(id, service_id) {

            if ($('#menu_items_name' + id + '').is(':checked')) {
                var menu_items_quantity = $('#menu_items_quantity' + id + ' option:selected').val();
                var menu_items_price = $('#menu_items_price' + id + '').text();

                // var previousPrice = parseInt($('#menu_items_order_price' + id + '').text());
                var previousQuantity = parseInt($('#menu_items_order_quantity' + id + '').text());
                $('#menu_items_order_quantity' + id + '').text(parseInt(menu_items_quantity));
                $('#menu_items_order_price' + id + '').text(parseInt(menu_items_quantity) * parseInt(menu_items_price));

                subtotal = parseInt($('#subtotal').text());
                total = parseInt($('#total').text());

                subtotal = (subtotal - (menu_items_price * previousQuantity));
                subtotal = (subtotal + (parseInt(menu_items_price) * parseInt(menu_items_quantity)));
                $('#subtotal').text(subtotal);
                $('#total').text(subtotal);

                var getservices = JSON.parse(localStorage.getItem('services'));

                for (var i = 0; i < getservices.length; i++) {

                    if (id == getservices[i].id && service_id == getservices[i].subcategoryId && getservices[i].type == 'Service') {
                        getservices[i].quantity = parseInt(menu_items_quantity);
                    }
                }
                localStorage.setItem('services', JSON.stringify(getservices));
            }
        }

        function deleteMenuItemOrders(id) {

            $('#menu_items_quantity' + id + '').prop('disabled', true);

            var menu_items_price = $('#menu_items_price' + id + '').text();
            var menu_items_quantity = $('#menu_items_quantity' + id + ' option:selected').val();

            var getservices = JSON.parse(localStorage.getItem('services'));

            for (var i = 0; i < getservices.length; i++) {

                if (id == getservices[i].id && getservices[i].type == 'Service') {
                    getservices.splice(i, 1);
                }
            }
            localStorage.setItem('services', JSON.stringify(getservices));


            subTotal = (parseInt($('#subtotal').text()) - (parseInt(menu_items_price) * parseInt(menu_items_quantity)));

            total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + id + '').val());
            $('.total_addon_price_for_order' + id + '').val(0);

            subTotal = subTotal - total_addon_price_for_order;
            $('#subtotal').text(subTotal);
            $('#total').text(subTotal);


            $('#menu_items_orders' + id + '').remove();
            $('#menu_items_name' + id + '').prop("checked", false);
            $('#serviceAppendSubDiv' + id + '').css('display', 'none');
            $('.uncheckAddons' + id + '').prop('checked', false);
            $('#menu_items_quantity' + id + '').prop("selectedIndex", 0).trigger("change");
            $('.addon_quantity' + id + '').prop("selectedIndex", 0).trigger("change");

        }


        function addOnsAddInOrder(addOnId, subCateogoryId) {
            var addon_items_name = $('#addons_name' + addOnId + '').val();
            var addon_items_price = $('#add_on_price' + addOnId + '').text();
            var addon_items_quantity = $('#addon_quantity' + addOnId + ' option:selected').val();

            var previous_addon_items_quantity = $('#add_on_order_price' + addOnId + '').text();
            var html = "";
            if ($('#addons_name' + addOnId + '').is(':checked')) {

                $('#addon_quantity' + addOnId + '').removeAttr('disabled');
                html += '<div class="addOnDiv" id="addOnDiv' + addOnId + '">';
                html += '<div class="row">';
                html += '<div class="col-md-10 col-sm-9 col-xs-10">';
                html += ' <h4><strong>Addon</strong></h4>';
                html += ' <h4><span>' + addon_items_name + '</span> x <span id="add_on_order_quantity' + addOnId + '">' + addon_items_quantity + '</span></h4>';
                html += '<span>Rs. </span><span id="add_on_order_price' + addOnId + '">' + (addon_items_price * addon_items_quantity) + '</span>';
                html += '</div>';
                html += '<div class="col-md-2 col-sm-3 col-xs-2 text-right pt-20">';
                html += '<a onclick="deleteMenuItemOrderAddons(' + addOnId + ',' + subCateogoryId + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '</div>';
                html += '</div>';

                $('#menu_items_orders_addOnDiv' + subCateogoryId + '').append(html);


                var addOns = {
                    id: addOnId,
                    name: addon_items_name,
                    amount: parseInt(addon_items_price),
                    duration: 0,
                    quantity: parseInt(addon_items_quantity),
                    subcategoryId: subCateogoryId,
                    isSelected: true,
                };
                var getservices = JSON.parse(localStorage.getItem('services'));

                for (var i = 0; i < getservices.length; i++) {

                    if (subCateogoryId == getservices[i].id && getservices[i].type == 'Service') {
                        getservices[i].addOns.push(addOns);
                    }
                }

                localStorage.setItem('services', JSON.stringify(getservices));


                if (parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) > 0) {
                    total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) - (parseInt(addon_items_price) * parseInt(previous_addon_items_quantity));
                    total_addon_price_for_order = total_addon_price_for_order + (parseInt(addon_items_price) * parseInt(addon_items_quantity));
                    $('.total_addon_price_for_order' + subCateogoryId + '').val(total_addon_price_for_order);
                } else {
                    total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) + (parseInt(addon_items_price) * parseInt(addon_items_quantity));
                    $('.total_addon_price_for_order' + subCateogoryId + '').val(total_addon_price_for_order);
                }


                subTotal = (parseInt($('#subtotal').text()) + (parseInt(addon_items_price) * parseInt(addon_items_quantity)));
                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);


            } else {

                $('#addon_quantity' + addOnId + '').prop('disabled', true);
                var getAddonServices = JSON.parse(localStorage.getItem('services'));
                var addons;
                for (var j = 0; j < getAddonServices.length; j++) {
                    if (getAddonServices[j].id == subCateogoryId && getAddonServices[j].type == 'Service') {
                        addons = getAddonServices[j].addOns;
                        for (var k = 0; k < addons.length; k++) {
                            if (addOnId == addons[k].id) {
                                addons.splice(k, 1);
                            }
                        }

                    }

                }
                localStorage.setItem('services', JSON.stringify(getAddonServices));


                if (parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) > 0) {
                    total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) - (parseInt(addon_items_price) * parseInt(previous_addon_items_quantity));
                    total_addon_price_for_order = total_addon_price_for_order + (parseInt(addon_items_price) * parseInt(addon_items_quantity));
                    $('.total_addon_price_for_order' + subCateogoryId + '').val(total_addon_price_for_order);
                }


                subTotal = (parseInt($('#subtotal').text()) - (parseInt(addon_items_price) * parseInt(addon_items_quantity)));
                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);
                $('#addOnDiv' + addOnId + '').remove();
                $('#addon_quantity' + addOnId + '').prop("selectedIndex", 0).trigger("change");

            }
        }

        function addOnQuantity(addOnId, subCateogoryId) {
            if ($('#addons_name' + addOnId + '').is(':checked')) {
                var addon_items_price = $('#add_on_price' + addOnId + '').text();
                var addon_items_quantity = $('#addon_quantity' + addOnId + ' option:selected').val();
                // var previousPrice = parseInt($('#add_on_order_price' + addOnId + '').text());
                var previousQuantity = parseInt($('#add_on_order_quantity' + addOnId + '').text());

                $('#add_on_order_quantity' + addOnId + '').text(parseInt(addon_items_quantity));
                $('#add_on_order_price' + addOnId + '').text(parseInt(addon_items_quantity) * parseInt(addon_items_price));

                subtotal = parseInt($('#subtotal').text());
                total = parseInt($('#total').text());


                if (parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) > 0) {

                    total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) - (parseInt(addon_items_price) * parseInt(previousQuantity));
                    total_addon_price_for_order = total_addon_price_for_order + (parseInt(addon_items_price) * parseInt(addon_items_quantity));
                    $('.total_addon_price_for_order' + subCateogoryId + '').val(total_addon_price_for_order);
                }


                subtotal = (subtotal - (addon_items_price * previousQuantity));
                subtotal = (subtotal + (parseInt(addon_items_price) * parseInt(addon_items_quantity)));
                $('#subtotal').text(subtotal);
                $('#total').text(subtotal);


                var getAddonServices = JSON.parse(localStorage.getItem('services'));
                var addons;
                for (var j = 0; j < getAddonServices.length; j++) {
                    if (getAddonServices[j].id == subCateogoryId && getAddonServices[j].type == 'Service') {
                        addons = getAddonServices[j].addOns;
                        for (var k = 0; k < addons.length; k++) {
                            if (addOnId == addons[k].id) {
                                addons[k].quantity = parseInt(addon_items_quantity);
                            }
                        }

                    }

                }
                localStorage.setItem('services', JSON.stringify(getAddonServices));


            }
        }

        function deleteMenuItemOrderAddons(addOnId, subCateogoryId) {

            $('#addon_quantity' + addOnId + '').prop('disabled', true);


            var getAddonServices = JSON.parse(localStorage.getItem('services'));
            var addons;
            for (var j = 0; j < getAddonServices.length; j++) {
                if (getAddonServices[j].id == subCateogoryId && getAddonServices[j].type == 'Service') {
                    addons = getAddonServices[j].addOns;
                    for (var k = 0; k < addons.length; k++) {
                        if (addOnId == addons[k].id) {
                            addons.splice(k, 1);
                        }
                    }

                }

            }
            localStorage.setItem('services', JSON.stringify(getAddonServices));

            var addon_items_price = $('#add_on_price' + addOnId + '').text();
            var addon_items_quantity = $('#addon_quantity' + addOnId + ' option:selected').val();
            subTotal = (parseInt($('#subtotal').text()) - (parseInt(addon_items_price) * parseInt(addon_items_quantity)));

            total_addon_price_for_order = parseInt($('.total_addon_price_for_order' + subCateogoryId + '').val()) - (parseInt(addon_items_price) * parseInt(addon_items_quantity));
            $('.total_addon_price_for_order' + subCateogoryId + '').val(total_addon_price_for_order);


            $('#subtotal').text(subTotal);
            $('#total').text(subTotal);


            $('#addOnDiv' + addOnId + '').remove();
            $('#addons_name' + addOnId + '').prop("checked", false);
            $('#addon_quantity' + addOnId + '').prop("selectedIndex", 0).trigger("change");
        }


        $(document).on('click', '#packagesBtn', function (e) {
        // $('#packagesBtn').click(function (e) {
            $('#servicesTabsArea').hide();
            $('#packagesTabArea').show();




            $('#packagesBtn').addClass('activeServiceTab');

            var description = 'Book our special packages and save up to 70% off your favourite treatments.';
            var image = '/uploads/packages/1140x420_0002_03.jpg';
            $('#service_image').attr('src', image);
            $('#service-description').text(description);
            $('.sectionHeading').text('PACKAGES');
        });

        function showPackage(id) {
            var menu_items_name = $('#checkOrUncheckPackage' + id + '').val();
            var menu_items_price = $('#packages_price' + id + '').text();
            var menu_items_quantity = $('#package_quantity' + id + ' option:selected').val();
            var html = "";

            if ($('#checkOrUncheckPackage' + id + '').is(':checked')) {
                $('#package_quantity' + id + '').removeAttr('disabled');
                $('#serviceAppendPackageSubDiv' + id + '').css('display', 'block');

                html += '<div id="menu_items_orders_package' + id + '">';
                html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                html += '<div class="row">';
                html += '<div class="col-md-10 col-sm-9 col-xs-10">';
                html += '<h4><span>' + menu_items_name + '</span> x <span id="menu_items_order_quantity_package' + id + '">' + menu_items_quantity + '</span></h4>';
                html += '<span>Rs. </span><span id="menu_items_order_price_package' + id + '">' + menu_items_price + '</span>';
                html += '</div>';
                html += '<div class="col-md-2 col-sm-3 col-xs-2 text-right">';
                html += '<a onclick="deletePackageOrders(' + id + ')" class="removeItem"><i class="fa fa-times-circle"></i></a>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '</div>';
                html += '<div id="menu_items_orders_addOnDiv' + id + '">';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '<hr style="margin: 10px 5px; border: #ff6c2b dotted 1px;">';
                html += '</div>';

                $('#add-orders').append(html);

                subTotal = (parseInt($('#subtotal').text()) + (parseInt(menu_items_price) * parseInt(menu_items_quantity)));
                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);

                var newServices = {
                    id: id,
                    name: menu_items_name,
                    amount: parseInt(menu_items_price),
                    duration: 0,
                    quantity: parseInt(menu_items_quantity),
                    type: "Package",
                    subcategoryId: 0,
                    isSelected: true,
                    addOns: []
                };

                services = JSON.parse(localStorage.getItem('services'));
                if (services == null) {
                    services = [];
                }
                services.push(newServices);
                localStorage.setItem('services', JSON.stringify(services));

            } else {
                $('#package_quantity' + id + '').prop('disabled', true);
                var getservices = JSON.parse(localStorage.getItem('services'));

                for (var i = 0; i < getservices.length; i++) {

                    if (id == getservices[i].id) {
                        getservices.splice(i, 1);
                    }
                }
                localStorage.setItem('services', JSON.stringify(getservices));
                subTotal = (parseInt($('#subtotal').text()) - (parseInt(menu_items_price) * parseInt(menu_items_quantity)));

                $('#subtotal').text(subTotal);
                $('#total').text(subTotal);
                $('#serviceAppendPackageSubDiv' + id + '').css('display', 'none');
                $('#menu_items_orders_package' + id + '').remove();
                $('#checkOrUncheckPackage' + id + '').prop('checked', false);
                $('#package_quantity' + id + '').prop("selectedIndex", 0).trigger("change");


            }
        }

        function packageQuantity(id) {


            if ($('#checkOrUncheckPackage' + id + '').is(':checked')) {
                var menu_items_price = $('#packages_price' + id + '').text();
                var menu_items_quantity = $('#package_quantity' + id + ' option:selected').val();
                var previousQuantity = parseInt($('#menu_items_order_quantity_package' + id + '').text());
                $('#menu_items_order_quantity_package' + id + '').text(parseInt(menu_items_quantity));
                $('#menu_items_order_price_package' + id + '').text(parseInt(menu_items_quantity) * parseInt(menu_items_price));


                subtotal = parseInt($('#subtotal').text());
                total = parseInt($('#total').text());
                subtotal = (subtotal - (menu_items_price * previousQuantity));
                subtotal = (subtotal + (parseInt(menu_items_price) * parseInt(menu_items_quantity)));
                $('#subtotal').text(subtotal);
                $('#total').text(subtotal);

                var getservices = JSON.parse(localStorage.getItem('services'));

                for (var i = 0; i < getservices.length; i++) {

                    if (id == getservices[i].id && getservices[i].type == 'Package') {
                        getservices[i].quantity = parseInt(menu_items_quantity);
                    }
                }
                localStorage.setItem('services', JSON.stringify(getservices));
            }
        }

        function deletePackageOrders(id) {
            $('#package_quantity' + id + '').prop('disabled', true);
            var menu_items_price = $('#packages_price' + id + '').text();
            var menu_items_quantity = $('#package_quantity' + id + ' option:selected').val();

            var getservices = JSON.parse(localStorage.getItem('services'));

            for (var i = 0; i < getservices.length; i++) {

                if (id == getservices[i].id && getservices[i].type == 'Package') {
                    getservices.splice(i, 1);
                }
            }
            localStorage.setItem('services', JSON.stringify(getservices));
            subTotal = (parseInt($('#subtotal').text()) - (parseInt(menu_items_price) * parseInt(menu_items_quantity)));

            $('#subtotal').text(subTotal);
            $('#total').text(subTotal);

            $('#serviceAppendPackageSubDiv' + id + '').css('display', 'none');
            $('#menu_items_orders_package' + id + '').remove();
            $('#checkOrUncheckPackage' + id + '').prop('checked', false);
            $('#package_quantity' + id + '').prop("selectedIndex", 0).trigger("change");


        }

    </script>
@endpush
