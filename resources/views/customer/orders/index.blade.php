@extends('customer.main')
@section('title','Orders')
@push('css')
    <style>

        /*.btn-height {*/
        /*height: 40px;*/
        /*}*/
        @media screen and (max-width: 650px) {
            .responsiveTable {
                overflow-x: scroll;
            }

            .responsiveTable a {
                width: 100%;
                margin: 5px 0;
            }

        }

        @media screen and (max-width: 450px) {
            .qr-copy {
                width: 100% !important;
            }

            .input-group-addon {
                width: 100% !important;
                margin-top: 10px;
            }

            .buttonMain {
                width: 100%;
            }
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
            </div>

            <div class="m-portlet__body">

                <form action="{{ route('customer.order.history') }}" method="GET" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Filter</h4>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xl-3">


                            <label for="start_date" class="col-md-12 col-form-label text-md-left"><strong>Start
                                    Date:</strong></label>

                            <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="{{ old('start_date') }}">


                        </div>
                        <div class="col-md-3 col-sm-3 col-xl-3">
                            <label for="end_date" class="col-md-12 col-form-label text-md-left"><strong>End
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
                                <a href="{{ route('customer.order.history') }}"
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
                <div class="responsiveTable">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                        <thead>
                        <tr>

                            <th> Order ID.</th>
                            <th> Requested DateTime</th>
                            <th> Total Price</th>
                            <th> Mobile Number</th>
                            <th> No of Persons</th>
                            <th> Special Instructions</th>
                            <th> Order Status</th>
                            {{--                        <th> Assigned Staff</th>--}}
                            {{--                        <th> Staff Status</th>--}}
                            {{--                        <th> Staff Rating</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($orders))
                            @foreach($orders as $key=>$order)

                                @php
                                    $date= explode(' ',$order->requested_date_time)[0];
                                    $time= explode(' ',$order->requested_date_time)[1];
                                @endphp
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td> {{ $order->requested_date_time }}</td>
                                    <td>{{$order->total_price}}</td>

                                    <td>{{$order->phone_number ?? '-'}}</td>
                                    <td>{{$order->total_persons ?? '-'}}</td>
                                    <td>{{$order->special_instruction ??'-'}}</td>
                                    <td>{{ucfirst($order->order_status) ?? '-'}}</td>
                                    {{--                                <td>{{ucfirst($order->suggested_staff) ?? '-'}}</td>--}}
                                    {{--                                <td>{{ucfirst($order->staff_status)?? '-'}}</td>--}}
                                    {{--                                <td>--}}
                                    {{--                                    @if(!is_null($order->rating))--}}
                                    {{--                                        {{ round((($order->rating->rate_star_1 + $order->rating->rate_star_2 + $order->rating->rate_star_3)/3),2) }}--}}
                                    {{--                                    @else--}}
                                    {{--                                        Not Rated--}}
                                    {{--                                    @endif--}}
                                    {{--                                </td>--}}
                                    <td nowrap>
                                        <a href="{{route('customer.user.order.show',$order->id)}}"
                                           class="btn btn-sm btn-info pull-left ">View</a>
                                        {{--                                        <a href="{{route('admin.get.user.order.edit',$order->id)}}"--}}
                                        {{--                                           class="btn btn-sm btn-success pull-left ">Edit</a>--}}
                                        @if($order->order_progress_status == 'on-my-way')
                                            <a href="#" class="btn btn-sm btn-success pull-left"
                                               onclick="getLatLng('{{ $order->id }}')">Track Employee
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
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
        $("#m_table_1").dataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {orderable: false, targets: [7]}
            ],
        });
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
