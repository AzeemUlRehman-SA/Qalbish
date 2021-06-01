@extends('layouts.master')
@section('title','Special Offers')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Special Offers
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.special-offers.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add Special Offers</span>
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
{{--                        <th> Title</th>--}}
                        <th> Category</th>
                        <th> Status</th>
                        <th> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($blogs))
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ucfirst($blog->name)}}</td>
{{--                                <td>{{ucfirst($blog->name)}}</td>--}}
                                <td>{!! $blog->blogCategory['name'] !!}</td>
                                <td>{{ucfirst($blog->status)}}</td>
                                <td nowrap>
                                    <a href="{{route('admin.special-offers.edit',$blog->id)}}" class="btn btn-sm btn-info pull-left ">Edit</a>
                                    <form method="post" action="{{ route('admin.special-offers.destroy', $blog->id) }}"
                                          id="delete_{{ $blog->id }}">
                                        @method('delete')
                                        @csrf
                                        <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                           href="javascript:void(0)"
                                           onclick="if(confirmDelete()){ document.getElementById('delete_<?=$blog->id?>').submit(); }">
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
                { orderable: false, targets: [4] }
            ],
        });
    </script>
@endpush
