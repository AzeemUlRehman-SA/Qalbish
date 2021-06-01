@extends('layouts.master')
@section('title','Area')
@push('css')
    <style>
        .form-group {
            margin-bottom: 0;
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
                            Areas
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.areas.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add Area</span>
                                </span>
                            </a>
                        </li>


                        <li class="m-portlet__nav-item">


                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <form action="{{ route('admin.area.import.excel') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">

                                    <input type="file" name="file" class=" form-control">
                                </div>
                                <div class="col-md-6">
                                    <button type="submit"
                                            class="btn btn-success m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                        Upload
                                        File
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>

                        <th> Sr NO.</th>
                        <th> Name</th>
                        <th> Price</th>
                        <th> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($areas))
                        @foreach($areas as $area)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$area->name}}</td>
                                <td>{{$area->price}}</td>
                                <td nowrap>
                                    <a href="{{route('admin.areas.edit',$area->id)}}"
                                       class="btn btn-sm btn-info pull-left ">Edit</a>
                                    <form method="post" action="{{ route('admin.areas.destroy', $area->id) }}"
                                          id="delete_{{ $area->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                           href="javascript:void(0)"
                                           onclick="if(confirmDelete()){ document.getElementById('delete_<?=$area->id?>').submit(); }">
                                            Delete
                                        </a>
                                    </form>
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
                {orderable: false, targets: [3]}
            ],
        });
    </script>
@endpush
