<div id="orderRating" class="modal fade in" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order ID :: {{Session::get('pendingRatingOrder')['order_id']}}</h4>
            </div>
            <div class="modal-body">
                <div class="serviceInnerMain">

                    <div class="serviceBoxMain">
                        <div class="serverInnerDetails">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 bannerFields">
                                    <div class="row">
                                        {{--                                        <div class="col-md-2 col-sm-2 col-xs-12 orderReviewImage">--}}
                                        {{--                                            <img src="{{asset("/uploads/user_profiles/".auth()->user()->profile_pic)}}" alt="">--}}
                                        {{--                                        </div>--}}

                                        <div class="col-md-10 col-sm-10 col-xs-12 orderReviewDetails">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <h4><b>{{auth()->user()->fullName()}} </b><br></h4>
                                                    <p>{{Session::get('pendingRatingOrder')['phone_number']}}</p>
                                                    <p>No of
                                                        Person: {{Session::get('pendingRatingOrder')['total_persons']}}</p>
                                                    <p>
                                                        Date/Time: {{Session::get('pendingRatingOrder')['requested_date_time']}}</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <h4><b>Address</b></h4>
                                                    <p>{{Session::get('pendingRatingOrder')['address']}}</p>
                                                </div>
                                                <div class=" col-md-4 col-sm-4 col-xs-12">
                                                    <h4><b>Special Instructions</b></h4>
                                                    <p>{{Session::get('pendingRatingOrder')['special_instruction']}}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form enctype="multipart/form-data" id="rating-form-in-modal">
                                @csrf
                                <div class="row ratingArea">
                                    <div class="col-md-12">
                                        <h4>Rate Now</h4>
                                        <img width="300" height="200" class="img-thumbnail"
                                             src="{{Session::get('pendingRatingOrder')['staff']}}" alt="">
                                        <h4>{{Session::get('pendingRatingOrder')['staff_name']}}</h4>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                <h4>Time</h4>
                                                <div class="rating-stars">
                                                    <ul id="stars">
                                                        <li class="star" title="Poor" data-value="1" data-type="time">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Fair" data-value="2" data-type="time">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Good" data-value="3" data-type="time">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Excellent" data-value="4"
                                                            data-type="time">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="WOW!!!" data-value="5" data-type="time">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                <h4>Professionalism</h4>
                                                <div class="rating-stars">
                                                    <ul id="stars">
                                                        <li class="star" title="Poor" data-value="1"
                                                            data-type="profession">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Fair" data-value="2"
                                                            data-type="profession">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Good" data-value="3"
                                                            data-type="profession">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Excellent" data-value="4"
                                                            data-type="profession">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="WOW!!!" data-value="5"
                                                            data-type="profession">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 ratingAreaSections">
                                                <h4>Service</h4>
                                                <div class="rating-stars">
                                                    <ul id="stars">
                                                        <li class="star" title="Poor" data-value="1"
                                                            data-type="service">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Fair" data-value="2"
                                                            data-type="service">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Good" data-value="3"
                                                            data-type="service">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Excellent" data-value="4"
                                                            data-type="service">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="WOW!!!" data-value="5"
                                                            data-type="service">
                                                            <i class="fa fa-star fa-fw"></i>
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
                                               value="{{Session::get('pendingRatingOrder')['id']}}">
                                        <input type="hidden" name="staff_id"
                                               value="{{Session::get('pendingRatingOrder')['staff_id']}}">
                                        <input type="hidden" name="customer_id" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="rate_stat_1" value="0" id="rate_star_1">
                                        <input type="hidden" name="rate_stat_2" value="0" id="rate_star_2">
                                        <input type="hidden" name="rate_stat_3" value="0" id="rate_star_3">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-right mrgnDiv">
                                        <button type="button"
                                                class="btn buttonMain hvr-bounce-to-right modalBtnStyle"
                                                onclick="submitRatingForm(this)"
                                                disabled="" id="disable-btn">
                                            Submit

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
