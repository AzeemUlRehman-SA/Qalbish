@extends('layouts.master')
@section('title','Driver')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Assign Driver
                        </h3>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body">
                <input type="hidden">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>

                        <th> Sr NO.</th>
                        <th> Full Name</th>
                        <th> Email</th>
                        <th> Assign Driver</th>
                        <th> Driver Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($staffs))
                        @foreach($staffs as $staff)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ucfirst($staff->full_name)}}</td>
                                <td>{{$staff->email}}</td>
                                <td>

                                    <select id="driver_id"
                                            class="form-control assign-driver @error('driver_id') is-invalid @enderror"
                                            name="driver_id" autocomplete="driver_id"
                                            data-staff-id="{{$staff->id}}">
                                        <option value="">Select an option</option>
                                        @if(!empty($drivers))
                                            @foreach($drivers as $driver)
                                                <option
                                                    value="{{$driver->id}}" {{ ($staff->driver_id == $driver->id) ? 'selected' : ''}}>{{ucfirst($driver->full_name)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>


                                <td style="width: 10%;"
                                    id="staff_status{{$staff->id}}">{{ucfirst($staff->driver_status)}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#m_table_1").dataTable();

        $('.assign-driver').change(function () {
            form = $(this).closest('form');
            node = $(this);
            var driver_id = $(this).val();
            var staff_id = $(this).data('staff-id');
            var request = {"driver_id": driver_id, "staff_id": staff_id};
            if (driver_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.assign.driver') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            toastr['success']("Driver Assigned Successfully");

                            $('#staff_status' + staff_id + '').text('Assigned');

                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                toastr['error']("Please Select Driver");
            }
        });
    </script>
@endpush
