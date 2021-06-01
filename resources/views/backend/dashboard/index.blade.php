@extends('layouts.master')
@section('title','Dashboard')
@push('css')
    <style>
        .map-image {
            height: 60px;
            width: 60px;
            border-radius: 50px !important;
            margin-right: 15px;
            float: left;
        }

    </style>
@endpush
@section('content')
    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">

            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ route('admin.users.index') }}">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $users_count }}">{{ $users_count }}</span>
                                </div>
                                <div class="desc"> Total Users</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('admin.get.order.history') }}">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $total_orders }}">{{ $total_orders }}</span>
                                </div>
                                <div class="desc">All Orders</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 red"
                           href="{{ url('admin/order-history?status=pending') }}">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $pending_orders }}">{{ $pending_orders }}</span>
                                </div>
                                <div class="desc"> Pending Orders</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 green"
                           href="{{url('admin/order-history?status=completed') }}">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $completed_orders->count() }}">{{ $completed_orders->count() }}</span>
                                </div>
                                <div class="desc"> Completed Orders</div>
                            </div>
                        </a>
                    </div>

                </div>
                @if(!empty($completed_orders) && (count($completed_orders) > 0))
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class=" icon-social-twitter font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Completed Orders</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_actions_pending">
                                            <!-- BEGIN: Actions -->
                                            <div class="mt-actions">

                                                @foreach($completed_orders as $completed_order)
                                                    <div class="mt-action">
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-icon ">
                                                                        <i class="icon-magnet"></i>
                                                                    </div>
                                                                    <div class="mt-action-details ">
                                                                        <span
                                                                            class="mt-action-author">{{ $completed_order->user->fullName() }}</span>
                                                                        <p class="mt-action-desc">{{ $completed_order->special_instruction ?? '-' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span
                                                                        class="mt-action-date">{{ $completed_order->created_at->format('d/m/y') }}</span>
                                                                </div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <a href="{{route('admin.get.user.order.show',$completed_order->id)}}"
                                                                           class="btn btn-outline green btn-sm">View
                                                                            Order</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <!-- END: Actions -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @endif

                <div class="row">

                    <div class="col-lg-12 col-xs-12 col-sm-12">

                        <div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="map"></div>
                        </div>
                    </div>


                </div>

            </div>


        </div>
    </div>
@endsection
@push('js')

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZQiMEU1xYMEVTgch8O5WmL-iZVfQjko0&libraries=places&callback=initialize"
        async defer></script>

    <script type="text/javascript">

        function initialize() {


            var staffs = @json($staff_users);


            var locations = [];
            $.each(staffs, function (index, object) {
                locations.push([object.address, object.latitude, object.longitude, object.first_name, object.last_name, object.profile_pic])
            });


            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(31.5204, 74.3587),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        var contentString = '';

                        contentString += '<div id="content">';
                        contentString += '<div id="siteNotice">';
                        contentString += '<img id="image" name="image" src="/uploads/user_profiles/' + locations[i][5] + '"  class="map-image"/>';
                        contentString += '<h5 id="firstHeading" class="firstHeading">' + locations[i][3] + ' ' + locations[i][4] + '</h5>';//doesnt work here
                        contentString += '<div id="bodyContent">' + locations[i][0] + '</div>';
                        contentString += '</div>';

                        infowindow.setContent(contentString);
                        // infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }

    </script>


@endpush
