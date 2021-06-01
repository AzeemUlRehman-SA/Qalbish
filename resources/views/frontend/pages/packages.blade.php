@extends('frontend.layout.app')
@section('title',$deal->meta_title ?? 'Packages')
@section('description',$deal->meta_description ?? 'Packages')
@section('keywords',$deal->keywords ?? 'Packages' )
@push('css')
    <style>
        .leaf {
            width: 0 !important;
            height: 0 !important;
            object-fit: none !important;
        }
    </style>
@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Packages</h2>


                </div>
            </div>

            <div class="serviceInnerMain">
                <img src="{{asset('/uploads/packages/1140x420_0002_03.jpg') }}" alt="">

                <p>Book our special packages and save up to 70% off your favourite treatments.</p>
                @if(!empty($deals) && (count($deals) > 0))

                    <div class="serviceBoxMain">
                        <div class="serviceBoxHeader">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                <h4></h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>Price</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="serviceData">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                @foreach($deals as $key=>$deal)
                                    <div class="panel panel-default">
                                        <div class="panel-heading {{ ($key == 0) ? 'active' :'' }}" role="tab"
                                             id="heading{{$deal->id}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{ $deal->id }}" aria-expanded="true"
                                                   aria-controls="collapse{{$deal->id}}">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
{{--                                                        <img src="{{ asset('frontend/images/leaf.png') }}"--}}
{{--                                                             alt=""> --}}
                                                        {{ $deal->name }}
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4 priceRight">

                                                        Rs. {{ (int)$deal->total_price }}

                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$deal->id}}"
                                             class="panel-collapse collapse  {{ ($key == 0) ? 'in' :'' }}"
                                             role="tabpanel"
                                             aria-labelledby="heading{{$deal->id}}">
                                            <div class="panel-body">
                                                @if(!empty($deal->deal_services) && (count($deal->deal_services) > 0))
                                                    @foreach($deal->deal_services as $deal_service)
                                                        @if(!empty($deal_service->deal_sub_categories) && (count($deal_service->deal_sub_categories) > 0))
                                                            @foreach($deal_service->deal_sub_categories as $deal_sub_category)
                                                                <div class="row">

                                                                    <div class="col-md-12">
                                                                        <h5>
                                                                            <img class="leaf"
                                                                                 src="{{ asset('frontend/images/leaf.png') }}"
                                                                                 alt=""> {{ $deal_sub_category->sub_category->name ?? '-' }}
                                                                        </h5>
                                                                        @if(!empty($deal_sub_category->deal_sub_category_addons) && (count($deal_sub_category->deal_sub_category_addons) > 0))
                                                                            <h5 style="padding-left: 20px">Add on</h5>
                                                                            <ul style="padding-left: 36px;">

                                                                                @foreach($deal_sub_category->deal_sub_category_addons as $deal_sub_category_addon)
                                                                                    <li>{{ $deal_sub_category_addon->addon->name ?? '-' }}</li>
                                                                                @endforeach

                                                                                @endif
                                                                            </ul>
                                                                    </div>

                                                                </div>
                                                                {{--                                                                <hr style="margin: 10px 0; border: #ff6c2b dotted 1px;">--}}
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 col-xs-12 text-right serviceDetBtn">
                                                        @if(auth()->check() && auth()->user()->user_type  == 'customer')
                                                            <a href="{{ route('service') }}"
                                                               class="btn buttonMain hvr-bounce-to-right">Book
                                                                Now</a>
                                                        @else
                                                            <a href="{{ route('login') }}"
                                                               class="btn buttonMain hvr-bounce-to-right">Book
                                                                Now</a>
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                @endif
            </div>


        </div>
    </section>

@endsection
@push('js')

@endpush

