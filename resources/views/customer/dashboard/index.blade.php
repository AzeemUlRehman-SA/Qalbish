@extends('customer.main')
@section('title','Dashboard')
@section('content')
    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('customer.order.history') }}">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $total_orders }}">{{ $total_orders }}</span>
                                </div>
                                <div class="desc">All Orders</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 red"
                           href="{{ url('customer/order-history?status=pending') }}">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $pending_orders }}">{{ $pending_orders }}</span>
                                </div>
                                <div class="desc"> Pending Orders</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 green"
                           href="{{ url('customer/order-history?status=completed') }}">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup"
                                          data-value="{{ $completed_orders->count() }}">{{ $completed_orders->count() }}</span>
                                </div>
                                <div class="desc"> Completed Orders</div>
                            </div>
                        </a>
                    </div>

                </div>
                @if(!empty($completed_orders) && (count($completed_orders) > 0))
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class=" icon-social-twitter font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Completed Orders</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_actions_pending">
                                            <!-- BEGIN: Actions -->
                                            <div class="mt-actions">

                                                @foreach($completed_orders as $completed_order)
                                                    <div class="mt-action">
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-icon ">
                                                                        <i class="icon-magnet"></i>
                                                                    </div>
                                                                    <div class="mt-action-details ">
                                                                        <span
                                                                            class="mt-action-author">{{ $completed_order->user->fullName() }}</span>
                                                                        <p class="mt-action-desc">{{ $completed_order->special_instruction ?? '-' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span
                                                                        class="mt-action-date">{{ $completed_order->created_at->format('d/m/y') }}</span>
                                                                </div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <a href="{{route('customer.user.order.show',$completed_order->id)}}"
                                                                           class="btn btn-outline green btn-sm">View
                                                                            Order</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <!-- END: Actions -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
