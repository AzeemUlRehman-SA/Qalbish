@extends('layouts.master')
@section('title','Memberships')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Memberships
                        </h3>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th> Sr NO. </th>
                        <th> Title </th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($memberships))
                        @foreach($memberships as $membership)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$membership->title}}</td>
                                <td nowrap>
                                    <a href="{{route('admin.memberships.edit',$membership->id)}}" class="btn btn-sm btn-info pull-left ">Edit</a>
                                </td>
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
        $("#m_table_1").dataTable({
            "columnDefs": [
                { orderable: false, targets: [2] }
            ],
            "paging": false
        });
    </script>
@endpush
