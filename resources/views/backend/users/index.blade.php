@extends('layouts.master')
@section('title','Users')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Users
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.users.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add User</span>
                                </span>
                            </a>
                        </li>
                    </ul>
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
                        <th>Mobile Number</th>
                        <th>CNIC</th>
                        <th> Role</th>
                        {{--                        <th> Referral Code</th>--}}
                        <th> Memberships</th>
                        <th> Total Spendings</th>
                        <th> Status</th>
                        <th> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($users))
                        @foreach($users as $user)
                            @if($user->user_type != 'admin')
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ucfirst($user->fullname())}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->cnic}}</td>
                                    <td>{{ucfirst($user->user_type)}}</td>
                                    {{--                                <td>{{$user->referral_code}}</td>--}}
                                    <td>
                                        @if($user->user_type == 'driver' || $user->user_type =='staff')
                                            --
                                        @else
                                            <select id="membership_id"
                                                    class="form-control assign-membership @error('membership_id') is-invalid @enderror"
                                                    name="membership_id" autocomplete="membership_id"
                                                    data-user-id="{{$user->id}}">
                                                <option value="">Select an option</option>
                                                @if(!empty($memberships))
                                                    @foreach($memberships as $membership)
                                                        <option
                                                            value="{{$membership->id}}" {{ ($user->membership_id == $membership->id) ? 'selected' : ''}}>{{ucfirst($membership->title)}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @endif

                                    </td>


                                    <td>
                                        @if($user->user_type == 'driver' || $user->user_type =='staff')
                                            --
                                        @else
                                            {{$user->orders->sum('total_price')}}
                                        @endif
                                    </td>

                                    <td style="width: 10%;">{{ucfirst($user->status)}}</td>
                                    <td nowrap style="width: 12%;">
                                        <a href="{{route('admin.users.edit',$user->id)}}"
                                           class="btn btn-sm btn-info pull-left ">Edit</a>
                                        <form method="post" action="{{ route('admin.users.destroy', $user->id) }}"
                                              id="delete_{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                               href="javascript:void(0)"
                                               onclick="if(confirmDelete()){ document.getElementById('delete_<?=$user->id?>').submit(); }">
                                                Delete
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
@push('js')
    <script>
        $("#m_table_1").dataTable({
            "ordering": false,
            "order": [[0, "desc"]],
            "columnDefs": [
                {orderable: false, targets: [7]}
            ],
        });

        $(document).on('change', '.assign-membership', function () {

            form = $(this).closest('form');
            node = $(this);
            var membership_id = $(this).val();
            var user_id = $(this).data('user-id');
            var request = {"membership_id": membership_id, "user_id": user_id};
            if (membership_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.assign.membership') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            toastr['success']("Membership Assign Successfully");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                toastr['error']("Please Select Membership");
            }

        });


    </script>
@endpush
