@extends('layouts.master')
@section('title','AddOns')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            AddOns
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.addons.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add AddOns</span>
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

                        <th> Sr NO. </th>
                        <th> Name </th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($service_sub_categories_addons))
                        @foreach($service_sub_categories_addons as $service_sub_categories_addon)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$service_sub_categories_addon->name}}</td>
                                <td nowrap>
                                    <a href="{{route('admin.addons.edit',$service_sub_categories_addon->id)}}" class="btn btn-sm btn-info pull-left ">Edit</a>
                                    <form method="post" action="{{ route('admin.addons.destroy', $service_sub_categories_addon->id) }}" id="delete_{{ $service_sub_categories_addon->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left" href="javascript:void(0)" onclick="if(confirmDelete()){ document.getElementById('delete_<?=$service_sub_categories_addon->id?>').submit(); }">
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
                { orderable: false, targets: [2] }
            ],
        });
    </script>
@endpush
