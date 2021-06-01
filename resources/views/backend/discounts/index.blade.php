@extends('layouts.master')
@section('title','Discounts')
@push('css')
    <style>
        .mr-10 {
            margin-right: 10px;
        }

        .mb-15 {
            margin-bottom: 15px;
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
                            Discounts
                        </h3>
                    </div>
                </div>


            </div>

            <div class="m-portlet__body">
                <div class="portlet light bordered">

                    <div class="portlet-body">
                        <ul class="nav nav-pills">
                            <li class="active btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air mr-10">
                                <a href="#tab_2_1" data-toggle="tab" aria-expanded="true" class="text-white">
                                    Coupon </a>
                            </li>
                            <li class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air mr-10">
                                <a href="#tab_2_2" data-toggle="tab" aria-expanded="false" class="text-white">
                                    Membership </a>
                            </li>
                            <li class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air mr-10">
                                <a href="#tab_2_3" data-toggle="tab" aria-expanded="false" class="text-white">
                                    Referral </a>
                            </li>
                            <li class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air mr-10">
                                <a href="#tab_2_4" data-toggle="tab" aria-expanded="false" class="text-white">
                                    1st Order </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_2_1">
                                <div class="m-portlet__head mb-15">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Coupon Discount
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">
                                        <ul class="m-portlet__nav">
                                            <li class="m-portlet__nav-item">
                                                <a href="{{ route('admin.coupons.create') }}"
                                                   class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add Coupon</span>
                                </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="m_table_1">
                                    <thead>
                                    <tr>

                                        <th> Sr NO.</th>
                                        <th> Code</th>
                                        <th> Type</th>
                                        <th> Value</th>
                                        <th> Percentage</th>
                                        <th> Expiry Date</th>
                                        <th> Limit</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($coupon_discounts))
                                        @foreach($coupon_discounts as $coupon_discount)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$coupon_discount->code}}</td>
                                                <td>{{$coupon_discount->type}}</td>
                                                <td>{{$coupon_discount->value ?? '-'}}</td>
                                                <td>{{$coupon_discount->percent_off ?? '-'}}</td>
                                                <td>{{$coupon_discount->expiry_date ?? '-'}}</td>
                                                <td>{{$coupon_discount->no_of_used ?? '-'}}</td>
                                                <td nowrap>
                                                    <a href="{{route('admin.coupons.edit',$coupon_discount->id)}}"
                                                       class="btn btn-sm btn-info pull-left ">Edit</a>
                                                    <form method="post"
                                                          action="{{ route('admin.coupons.destroy', $coupon_discount->id) }}"
                                                          id="delete_{{ $coupon_discount->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a style="margin-left:10px;"
                                                           class="btn btn-sm btn-danger m-left"
                                                           href="javascript:void(0)"
                                                           onclick="if(confirmDelete()){ document.getElementById('delete_<?=$coupon_discount->id?>').submit(); }">
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
                            <div class="tab-pane" id="tab_2_2">
                                <div class="m-portlet__head mb-15">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Membership Discount
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="m_table_2">
                                    <thead>
                                    <tr>

                                        <th> Sr NO.</th>
                                        <th> Name</th>
                                        <th> Type</th>
                                        <th> Value</th>
                                        <th> Percentage</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($membership_discounts))
                                        @foreach($membership_discounts as $membership_discount)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ucfirst($membership_discount->name)}}</td>
                                                <td>{{ucfirst($membership_discount->type)}}</td>
                                                <td>{{$membership_discount->value ?? '-'}}</td>
                                                <td>{{$membership_discount->percent_off ?? '-'}}</td>

                                                <td nowrap>
                                                    <a href="{{route('admin.memberships-discount.edit',$membership_discount->id)}}"
                                                       class="btn btn-sm btn-info pull-left ">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab_2_3">
                                <div class="m-portlet__head mb-15">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Referral Discount
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="m_table_3">
                                    <thead>
                                    <tr>

                                        <th> Sr NO.</th>
                                        <th> Type</th>
                                        <th> Value</th>
                                        <th> Percentage</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($referral_discounts))
                                        @foreach($referral_discounts as $referral_discount)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>

                                                <td>{{ucfirst($referral_discount->type)}}</td>
                                                <td>{{$referral_discount->value ?? '-'}}</td>
                                                <td>{{$referral_discount->percent_off ?? '-'}}</td>

                                                <td nowrap>
                                                    <a href="{{route('admin.referral-discount.edit',$referral_discount->id)}}"
                                                       class="btn btn-sm btn-info pull-left ">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab_2_4">
                                <div class="m-portlet__head mb-15">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                1st Order Discount
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="m_table_4">
                                    <thead>
                                    <tr>

                                        <th> Sr NO.</th>
                                        <th> Type</th>
                                        <th> Value</th>
                                        <th> Percentage</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($first_order_discounts))
                                        @foreach($first_order_discounts as $first_order_discount)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>

                                                <td>{{ucfirst($first_order_discount->type)}}</td>
                                                <td>{{$first_order_discount->value ?? '-'}}</td>
                                                <td>{{$first_order_discount->percent_off ?? '-'}}</td>

                                                <td nowrap>
                                                    <a href="{{route('admin.first-order-discount.edit',$first_order_discount->id)}}"
                                                       class="btn btn-sm btn-info pull-left ">Edit</a>
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#m_table_1").dataTable({
            "columnDefs": [
                { orderable: false, targets: [7] }
            ],
        });
        $("#m_table_2").dataTable({
            "columnDefs": [
                { orderable: false, targets: [5] }
            ],
            "paging": false
        });
        $("#m_table_3").dataTable({
            "columnDefs": [
                { orderable: false, targets: [4] }
            ],
            "paging": false
        });
        $("#m_table_4").dataTable({
            "columnDefs": [
                { orderable: false, targets: [4] }
            ],
            "paging": false
        });
    </script>

@endpush
