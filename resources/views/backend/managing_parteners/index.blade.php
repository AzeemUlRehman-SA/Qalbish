@extends('layouts.master')
@section('title','Partners')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Managing Partener
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.managing-parteners.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add Managing Partener</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="m-portlet__body">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>

                        <th> Sr NO.</th>
                        <th> Name</th>
                        <th> Designation</th>
                        <th width="15%"> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($managing_parteners))
                        @foreach($managing_parteners as $managing_partener)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$managing_partener->title}}</td>
                                <td >{{$managing_partener->designation}}</td>
                                <td nowrap width="15%">
                                    <a href="{{route('admin.managing-parteners.edit',$managing_partener->id)}}"
                                       class="btn btn-sm btn-info pull-left ">Edit</a>
                                    <form method="post"
                                          action="{{ route('admin.managing-parteners.destroy', $managing_partener->id) }}"
                                          id="delete_{{ $managing_partener->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                           href="javascript:void(0)"
                                           onclick="if(confirmDelete()){ document.getElementById('delete_<?=$managing_partener->id?>').submit(); }">
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
                { orderable: false, targets: [3] }
            ],
        });
    </script>
@endpush
