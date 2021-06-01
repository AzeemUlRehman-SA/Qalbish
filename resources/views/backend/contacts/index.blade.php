@extends('layouts.master')
@section('title','Contact Us')
@section('content')

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Email Messages
                        </h3>
                    </div>
                </div>

{{--                <div class="m-portlet__head-tools">--}}
{{--                    <ul class="m-portlet__nav">--}}
{{--                        <li class="m-portlet__nav-item">--}}
{{--                            <a href="{{ route('admin.contacts.create') }}"--}}
{{--                               class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">--}}
{{--                                <span>--}}
{{--                                    <i class="la la-plus"></i>--}}
{{--                                    <span>Add Contact</span>--}}
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
                        <th> Sr NO.</th>
                        <th> Name</th>
                        <th> Email</th>
                        <th> Nature of Contact</th>
                        <th> Subject</th>
                        <th> Message</th>
                        <th style="display: none"> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($contacts))
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ucfirst($contact->full_name)}}</td>
                                <td>{{ucfirst($contact->email)}}</td>
                                <td>{{ucfirst($contact->nature_of_contact)}}</td>
                                <td>{{ucfirst($contact->subject)}}</td>
                                <td>{{ucfirst($contact->message)}}</td>
                                <td nowrap style="display: none">
                                    <form method="post" action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                          id="delete_{{ $contact->id }}">
                                        @method('delete')
                                        @csrf
                                        <a style="margin-left:10px;" class="btn btn-sm btn-danger m-left"
                                           href="javascript:void(0)"
                                           onclick="if(confirmDelete()){ document.getElementById('delete_<?=$contact->id?>').submit(); }">
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
                { orderable: false, targets: [6] }
            ],
        });
    </script>
@endpush
