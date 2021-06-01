@extends('layouts.master')
@section('title','Orders')
@push('css')
    <style>
        .map-image {
            height: 60px;
            width: 60px;
            border-radius: 50px !important;
            margin-right: 15px;
            float: left;
        }

        .mw-100 {
            margin: 0 auto;
        }

    </style>
@endpush
@section('content')
    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Orders History
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <span>
                                <span><strong>No of orders: {{ $orders->count() }}</strong> </span>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">

                        <li class="m-portlet__nav-item">

                            <a href="{{ route('admin.order.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add Order</span>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="m-portlet__body">


                <form action="{{ route('admin.get.order.history') }}" method="GET" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Filter</h4>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xl-3">


                            <label for="start_date" class="col-md-4 col-form-label text-md-left"><strong>Start
                                    Date:</strong></label>

                            <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="{{ old('start_date') }}">


                        </div>
                        <div class="col-md-3 col-sm-3 col-xl-3">
                            <label for="end_date" class="col-md-4 col-form-label text-md-left"><strong>End
                                    Date:</strong></label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                   value="{{ old('end_date') }}">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xl-3">

                            <label for="status"
                                   class="col-md-4 col-form-label text-md-left"><strong>Status:</strong></label>

                            <select id="status"
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" autocomplete="status">

                                <option value="">Select an option</option>
                                <option value="pending" {{ (request()->get('status') == 'pending') ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option
                                    value="confirmed" {{ (request()->get('status') == 'confirmed') ? 'selected' : '' }}>
                                    Confirmed
                                </option>
                                <option
                                    value="completed" {{ (request()->get('status') == 'completed') ? 'selected' : '' }}>
                                    Completed
                                </option>
                            </select>

                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="m-form__actions m-form__actions">
                                <label style="display: block"
                                       class="col-md-4 col-form-label text-md-left">&nbsp;</label>
                                <a href="{{ route('admin.get.order.history') }}"
                                   class="btn btn-accent m-btn m-btn--icon m-btn--air refreshBtn">
                                <span>
                                    <i class="la la-refresh"></i>

                                </span>
                                </a>
                                <button class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>


                </form>


                <hr>
                {{--tableScroll--}}

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>

                        <th> Order No.</th>
                        <th> Customer Name</th>
                        <th> User Status</th>
                        <th width="15%"> Requested Time</th>
                        <th width="10%"> Total Price</th>
                        <th width="10%"> Grand Total</th>
                        <th>Alternate Address</th>
                        <th>Order Status</th>
                        <th>Booking Date/Time</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($orders))
                        @foreach($orders as $key=>$order)
                            @php


                                $date= explode(' ',$order->requested_date_time)[0];
                                $time= explode(' ',$order->requested_date_time)[1];

                            @endphp

                            @if(!is_null($order->user))
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{$order->user->fullName()}}</td>
                                    <td>{{ucfirst($order->user->status)}}</td>

                                    <td>{{ $order->requested_date_time }} </td>
                                    <td>{{$order->total_price ?? 0}}</td>
                                    <td>{{$order->grand_total ?? 0}}</td>
                                    <td>{{$order->alternate_address ?? '--'}}</td>
                                    <td>{{ucfirst($order->order_status) ?? '--'}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->setTimezone($order->time_zone)->format('d/m/Y h:i A')}}</td>
                                    {{--                                <td>{{$order->created_at->format("m/d/Y h:m A") ?? '--'}}</td>--}}

                                    <td nowrap>
                                        <a href="{{route('admin.get.user.order.edit',$order->id)}}"
                                           class="btn btn-sm btn-info pull-left ">Edit</a>
                                        @if($order->order_progress_status == 'on-my-way')
                                            <a href="#" class="btn btn-sm btn-success pull-left"
                                               onclick="getLatLng('{{ $order->id }}')">Track
                                            </a>
                                        @endif

                                        <form method="post" action="{{route('admin.get.user.order.delete',$order->id)}}"
                                              id="delete_{{ $order->id }}">
                                            @method('delete')
                                            @csrf
                                            <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                               href="javascript:void(0)"
                                               onclick="if(confirmDelete()){ document.getElementById('delete_<?=$order->id?>').submit(); }">
                                                Cancel
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@push('models')

    <div id="trackEmployee" class="modal fade mw-100 w-75" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Track Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
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
    </div>
@endpush
@push('js')

    <script>


        var table = $("#m_table_1").DataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {orderable: false, targets: [7]}
            ],
        });


        $('.order-status-change').change(function () {
            form = $(this).closest('form');
            node = $(this);
            var order_status = $(this).val();
            var order_id = $(this).data('order-id');
            var request = {"order_status": order_status, "order_id": order_id};
            if (order_status !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.order.status') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            toastr['success']("Order Status Change Successfully");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                toastr['error']("Please Select Order Status");
            }
        });

        function assingStaff(value) {

            var staff_id = $(value).val();
            var order_id = $(value).data('order-id');
            var request = {"order_id": order_id, "staff_id": staff_id};
            if (staff_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.assign.staff') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            toastr['success']("Staff Assigned Successfully");

                            setTimeout(function () {
                                window.location = '{{route('admin.get.order.history')}}';
                            }, 1500);
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                toastr['error']("Please Select Staff");
            }
        }
    </script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZQiMEU1xYMEVTgch8O5WmL-iZVfQjko0&libraries=places"
        async defer></script>

    <script type="text/javascript">
        var locations = [];

        function getLatLng(id) {
            ;
            var order_id = parseInt(id);
            var request = {"order_id": order_id};
            if (order_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.get.latlng') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {


                            var staff_image = '/uploads/pointers/staff_pointer.png';
                            var customer_image = '/uploads/pointers/customer_pointer.png';
                            locations.push([response.data.staff_latlng.address, response.data.staff_latlng.latitude, response.data.staff_latlng.longitude, response.data.staff_latlng.first_name, response.data.staff_latlng.last_name, response.data.staff_latlng.profile_pic, staff_image]);
                            locations.push([response.data.customer_latlng.address, response.data.customer_latlng.latitude, response.data.customer_latlng.longitude, response.data.customer_latlng.first_name, response.data.customer_latlng.last_name, response.data.customer_latlng.profile_pic, customer_image]);
                            initialize();

                            $('#trackEmployee').modal('show');

                            {{--toastr['success']("Staff Assigned Successfully");--}}

                            {{--setTimeout(function () {--}}
                            {{--    window.location = '{{route('admin.get.order.history')}}';--}}
                            {{--}, 1500);--}}
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                toastr['error']("Please Select Staff");
            }
        }

        function initialize() {


                {{--var staffs = @json($staff_users);--}}



                {{--$.each(staffs, function (index, object) {--}}
                {{--    locations.push([object.address, object.latitude, object.longitude, object.first_name, object.last_name, object.profile_pic])--}}
                {{--});--}}


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
                    map: map,
                    icon: locations[i][6]
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
