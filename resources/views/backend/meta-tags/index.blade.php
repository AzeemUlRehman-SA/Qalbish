@extends('layouts.master')
@section('title','Meta Tags')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Meta Tags
                        </h3>
                    </div>
                </div>

{{--                <div class="m-portlet__head-tools">--}}
{{--                    <ul class="m-portlet__nav">--}}
{{--                        <li class="m-portlet__nav-item">--}}
{{--                            <a href="{{ route('admin.meta-tags.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">--}}
{{--                                <span>--}}
{{--                                    <i class="la la-plus"></i>--}}
{{--                                    <span>Add Meta Tags</span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>

            <div class="m-portlet__body">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>

                        <th> Sr NO. </th>
                        <th> Title </th>
                        <th> Keywords </th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($meta_tags))
                        @foreach($meta_tags as $meta_tag)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$meta_tag->title}}</td>
                                <td>{{$meta_tag->keywords}}</td>
                                <td nowrap>
                                    <a href="{{route('admin.meta-tags.edit',$meta_tag->id)}}" class="btn btn-sm btn-info pull-left ">Edit</a>
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
