@extends('layouts.master')
@section('title','Orders')
@push('css')
    <style>
        .serviceInner {
            height: 280px;
        }

        .bannerFields {
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .orderReviewDetails p {
            margin: 0;
        }

        .selectedServices {
            border: #ff6c2b solid 2px;
            padding: 15px 15px;
        }

        .btn:not(.btn-sm):not(.btn-lg) {
            line-height: 1.44;
            background-color: #ff6c2b;
        }

        .serviceBoxHeader {
            color: #fff;
        }

        /* Rating Star Widgets Style */
        .rating-stars {
            width: 100%;
        }

        .rating-stars ul {
            list-style-type: none;
            padding: 0;
            margin-top: 30px;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul > li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size: 18px; /* Change the size of the stars */
            color: #ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color: #FF912C;
        }

        .ratingArea {
            margin-top: 30px;
        }

        .ratingArea h4 {
            font-weight: 700;
            margin: 10px 0;
            font-size: 16px;
        }

        .ratingArea img {
            object-fit: cover;
            width: 15%;
        }

        .modal .modal-content .modal-header {
            background: #ff6c2b;
        }

        .modal .modal-content .modal-header .modal-title {
            color: #fff;
        }
        @media screen and (max-width: 450px)
        {
            .orderReviewDetails h4
            {
                margin: 5px 0;
            }
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
                                <div class="container">
                                    <div class="serviceInnerMain">

                                        <div class="serviceBoxMain">
                                            <div class="serverInnerDetails">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 bannerFields">
                                                        <div class="row">
                                                            <div
                                                                class="col-md-12 col-sm-12 col-xs-12 orderReviewImage">

                                                                @if($order->order_status == 'completed' && $order->staff_status == 'completed')
                                                                @else
                                                                    <p>Thank you for placing an order with Qalbish!
                                                                        Someone will be in touch with you shortly to
                                                                        confirm your service order.</p>
                                                                @endif
                                                                {{--                                                               @endif <img--}}
                                                                {{--                                                                    src="{{ asset('uploads/user_profiles/'.$order->user->profile_pic) }}"--}}
                                                                {{--                                                                    alt="">--}}
                                                            </div>
                                                            <div
                                                                class="col-md-10 col-sm-10 col-xs-12 orderReviewDetails">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <h4><b>{{ $order->user->fullName() }} </b><br>
                                                                        </h4>
                                                                        <p>{{ $order->phone_number }}</p>
                                                                        <p>
                                                                            Date/Time: {{ $order->requested_date_time }}</p>
                                                                        <p>No of Person: {{ $order->total_persons }}</p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <h4><b>Address</b></h4>
                                                                        <p>{{  $order->user->address }}
                                                                            , {{ $order->area->name }}
                                                                            , {{ $order->city->name }}</p>

                                                                        @if(!is_null($order->alternate_address))
                                                                            <h4><b>Alternate Address</b></h4>
                                                                            <p>{{  $order->alternate_address }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if(!is_null($order->special_instruction))
                                                                        <div
                                                                            class=" col-md-4 col-sm-4 col-xs-12 mrgnDiv">
                                                                            <h4><b>Special Instructions</b></h4>
                                                                            <p>{{$order->special_instruction}}</p>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-12 col-sm-12 col-xs-12 selectedServicesRight selectedServicesRight2 ">
                                                        <h4 class="selectedServicesRightHeading"><b>Services Ordered</b>
                                                        </h4>
                                                        <div class="selectedServices">
                                                            @if(!empty($order->order_details))
                                                                @foreach($order->order_details as $order_details)
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-md-6 col-sm-6 col-xs-12">
                                                                                    <h4>{{ $order_details->name }}
                                                                                        x {{ $order_details->quantity }}</h4>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-6 col-sm-6 -col-xs-12 text-right">
                                                                                    <h4>
                                                                                        Rs. {{ $order_details->amount * $order_details->quantity }}</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            @if(!empty($order_details->order_menu_items_addons) && (count($order_details->order_menu_items_addons) > 0))
                                                                                <div class="addOnDiv">
                                                                                    <div class="row">

                                                                                        <div
                                                                                            class="col-md-12 col-sm-12 col-xs-12">
                                                                                            <h5><strong>Addon</strong>
                                                                                            </h5>
                                                                                            <div class="row">
                                                                                                @foreach($order_details->order_menu_items_addons as $addons)

                                                                                                    <div
                                                                                                        class="col-md-6 col-sm-6 col-xs-12">
                                                                                                        <h4>{{ $addons->name }}
                                                                                                            x {{ $addons->quantity }}</h4>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-md-6 col-sm-6 -col-xs-12 text-right">
                                                                                                        <h4>
                                                                                                            Rs.{{ $addons->amount * $addons->quantity }}</h4>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="clearfix"></div>
                                                                                            </div>


                                                                                            @endforeach


                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <hr style="margin: 10px 0; border: #ff6c2b dotted 1px; width: 100%;">
                                                                    </div>
                                                                @endforeach
                                                                <div class="row delivery-charges">
                                                                    <div
                                                                        class="col-md-12 col-sm-12 col-xs-12 text-left">
                                                                        <h5>Discount:
                                                                            <span style="float: right">Rs. <span
                                                                                    id="delivery-charges-price">{{ $order->referral_discount + $order->first_order_discount + $order->membership_discount + $order->admin_discount + $order->coupon_discount }}</span>
</span>
                                                                        </h5>

                                                                    </div>
                                                                    {{--                                                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">--}}
                                                                    {{--                                                                        <h5><strong>Rs. <span--}}
                                                                    {{--                                                                                    id="delivery-charges-price">{{ $order->referral_discount + $order->first_order_discount + $order->membership_discount + $order->admin_discount + $order->coupon_discount }}</span></strong>--}}
                                                                    {{--                                                                        </h5>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="row delivery-charges">

                                                                    <div
                                                                        class="col-md-12 col-sm-12 col-xs-12 text-left">
                                                                        <h5>Delivery Charges:
                                                                            <span style="float: right">Rs. <span
                                                                                    id="delivery-charges-price">{{ (int)$order->area->price }}</span></span>
                                                                        </h5>

                                                                    </div>
                                                                    {{--                                                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">--}}
                                                                    {{--                                                                        <h5>--}}
                                                                    {{--                                                                        </h5>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="serviceBoxHeader">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                                                                    <h5><strong>Grand Total</strong>
                                                                        <span style="float: right">
                                                                            <strong>Rs. <span
                                                                                    id="delivery-charges-price">{{ $order->grand_total }}</span></strong>
                                                                        </span>
                                                                    </h5>

                                                                </div>
                                                                {{--                                                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">--}}
                                                                {{--                                                                    <h5></h5>--}}
                                                                {{--                                                                </div>--}}
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($order->order_status == 'completed' && $order->staff_status == 'completed')

                                                    {{--                                                    {{ dd($order->staff) }}--}}
                                                    @if(!is_null($order->staff))
                                                        @if(!is_null($order->rating))
                                                            <form action="#" method="post" id="submit-rating"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row ratingArea disabledDiv">
                                                                    <div class="col-md-12">
                                                                        <h4>Rate</h4>
                                                                        <img width="300" height="200"
                                                                             class="img-thumbnail"
                                                                             src="{{ asset('uploads/user_profiles/'.$order->staff->profile_pic) }}"
                                                                             alt="">
                                                                        <h4>{{ucfirst( $order->staff->fullName()) }}</h4>
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                                                <h4>Time</h4>
                                                                                <div class='rating-stars'>
                                                                                    <ul id='stars'>
                                                                                        <li class='star     {{ ($order->rating->rate_star_1 >= '1') ? 'selected' : '' }} '
                                                                                            title='Poor'

                                                                                            data-value='1'
                                                                                            data-type="time">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star  {{ ($order->rating->rate_star_1 >= '2') ? 'selected' : '' }}'
                                                                                            title='Fair'

                                                                                            data-value='2'
                                                                                            data-type="time">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star   {{ ($order->rating->rate_star_1 >= '3') ? 'selected' : '' }}'
                                                                                            title='Good'

                                                                                            data-value='3'
                                                                                            data-type="time">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star  {{ ($order->rating->rate_star_1 >= '4') ? 'selected' : '' }}'
                                                                                            title='Excellent'

                                                                                            data-value='4'
                                                                                            data-type="time">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star  {{ ($order->rating->rate_star_1 >= '5') ? 'selected' : '' }}'
                                                                                            title='WOW!!!'

                                                                                            data-value='5'
                                                                                            data-type="time">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                                                <h4>Professionalism</h4>
                                                                                <div class='rating-stars'>
                                                                                    <ul id='stars'>
                                                                                        <li class='star {{ ($order->rating->rate_star_2 >= '1') ? 'selected' : '' }}'
                                                                                            title='Poor'

                                                                                            data-value='1'
                                                                                            data-type="profession">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star  {{ ($order->rating->rate_star_2 >= '2') ? 'selected' : '' }}'
                                                                                            title='Fair'
                                                                                            data-value='2'
                                                                                            data-type="profession">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star  {{ ($order->rating->rate_star_2 >= '3') ? 'selected' : '' }}'
                                                                                            title='Good'
                                                                                            data-value='3'
                                                                                            data-type="profession">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star {{ ($order->rating->rate_star_2 >= '4') ? 'selected' : '' }}'
                                                                                            title='Excellent'
                                                                                            data-value='4'
                                                                                            data-type="profession">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star {{ ($order->rating->rate_star_2 >= '5') ? 'selected' : '' }}'
                                                                                            title='WOW!!!'
                                                                                            data-value='5'
                                                                                            data-type="profession">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                                                <h4>Service</h4>
                                                                                <div class='rating-stars'>
                                                                                    <ul id='stars'>
                                                                                        <li class='star {{ ($order->rating->rate_star_3 >= '1') ? 'selected' : '' }}'
                                                                                            title='Poor'
                                                                                            data-value='1'
                                                                                            data-type="service">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star    {{ ($order->rating->rate_star_3 >= '2') ? 'selected' : '' }}'
                                                                                            title='Fair'
                                                                                            data-value='2'
                                                                                            data-type="service">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star   {{ ($order->rating->rate_star_3 >= '3') ? 'selected' : '' }}'
                                                                                            title='Good'
                                                                                            data-value='3'
                                                                                            data-type="service">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star   {{ ($order->rating->rate_star_3 >= '4') ? 'selected' : '' }}'
                                                                                            title='Excellent'
                                                                                            data-value='4'
                                                                                            data-type="service">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star   {{ ($order->rating->rate_star_3 >= '5') ? 'selected' : '' }}'
                                                                                            title='WOW!!!'
                                                                                            data-value='5'
                                                                                            data-type="service">
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </form>
                                                        @endif
                                                    @endif
                                                @endif
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

@push('models')
    @if(!is_null($order->staff))
        <div class="modal fade" id="staff_rating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Rate Now</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">

                        <form action="#" method="post" id="submit-rating"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Rate Now</h4>
                                    <img width="100" height="200" class="img-thumbnail"
                                         src="{{ asset('uploads/user_profiles/'.$order->staff->profile_pic) }}"
                                         alt="">
                                    <h4>{{ ucfirst( $order->staff->fullName()) }}</h4>
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                            <h4>Time</h4>
                                            <div class='rating-stars'>
                                                <ul id='stars'>
                                                    <li class='star '
                                                        title='Poor'

                                                        data-value='1' data-type="time">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star '
                                                        title='Fair'

                                                        data-value='2' data-type="time">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star   '
                                                        title='Good'

                                                        data-value='3' data-type="time">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star '
                                                        title='Excellent'

                                                        data-value='4' data-type="time">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star  '
                                                        title='WOW!!!'

                                                        data-value='5' data-type="time">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                            <h4>Professionalism</h4>
                                            <div class='rating-stars'>
                                                <ul id='stars'>
                                                    <li class='star '
                                                        title='Poor'

                                                        data-value='1'
                                                        data-type="profession">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star  '
                                                        title='Fair'
                                                        data-value='2'
                                                        data-type="profession">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star  '
                                                        title='Good'
                                                        data-value='3'
                                                        data-type="profession">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star '
                                                        title='Excellent'
                                                        data-value='4'
                                                        data-type="profession">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star'
                                                        title='WOW!!!'
                                                        data-value='5'
                                                        data-type="profession">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                            <h4>Service</h4>
                                            <div class='rating-stars'>
                                                <ul id='stars'>
                                                    <li class='star '
                                                        title='Poor'
                                                        data-value='1'
                                                        data-type="service">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star  '
                                                        title='Fair'
                                                        data-value='2'
                                                        data-type="service">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star   '
                                                        title='Good'
                                                        data-value='3'
                                                        data-type="service">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star   '
                                                        title='Excellent'
                                                        data-value='4'
                                                        data-type="service">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star  '
                                                        title='WOW!!!'
                                                        data-value='5'
                                                        data-type="service">
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </div>
                            <div class="row">


                                <div class="final-rating">
                                    <input type="hidden" name="order_id"
                                           value="{{ $order->id }}">
                                    <input type="hidden" name="staff_id"
                                           value="{{ $order->staff_id }}">
                                    <input type="hidden" name="customer_id"
                                           value="{{ $order->customer_id }}">
                                    <input type="hidden" name="rate_stat_1" value="0"
                                           id="rate_star_1">
                                    <input type="hidden" name="rate_stat_2" value="0"
                                           id="rate_star_2">
                                    <input type="hidden" name="rate_stat_3" value="0"
                                           id="rate_star_3">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <button type="submit"
                                            class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air float-right"
                                            disabled id="disable-btn">
                                        <span>Submit</span>

                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    @endif
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var selectedRating = $('#stars li.selected').last().data('type');

                if (selectedRating === 'time') {
                    $('#rate_star_1').val(ratingValue);
                } else if (selectedRating === 'profession') {
                    $('#rate_star_2').val(ratingValue);
                } else {
                    $('#rate_star_3').val(ratingValue);
                }
                var msg = "";


                if ((parseInt($('#rate_star_1').val()) > 1) && (parseInt($('#rate_star_2').val()) > 1) && (parseInt($('#rate_star_3').val()) > 1)) {

                    $('#disable-btn').removeAttr('disabled');
                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

        $('#submit-rating').submit(function (e) {
            e.preventDefault();
            form = $(this);
            var request = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.order.staff.rating') }}",
                data: request,
                dataType: "json",
                cache: true,
                success: function (response) {
                    if (response.status == "success") {
                        toastr['success']("Thanks for Rating.We Will Improve ourselves.");
                        setTimeout(function () {
                            window.location = '{{route('customer.order.history')}}';
                        }, 1000);
                    }
                },
                error: function () {
                    toastr['error']("Something Went Wrong.");
                }
            });
        });

    </script>
@endpush
