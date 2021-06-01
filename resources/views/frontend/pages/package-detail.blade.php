@extends('frontend.layout.app')
@section('title',$deal->meta_title ?? 'Packages')
@section('description',$deal->meta_description ?? 'Packages')
@section('keywords',$deal->keywords ?? 'Packages' )
@push('css')
    <style>

    </style>

@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Pac<span>ka</span>ges</h2>
                </div>
            </div>
            <div class="serviceInnerMain">
                <img src="{{ asset('uploads/packages/'.$deal->image) }}" alt="{{ $deal->image }}">
                <div class="serviceBoxMain">
                    <div class="serviceBoxHeader serviceBoxHeader2">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h4>{{ $deal->name }}</h4>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <h4>Rs: {{ $deal->total_price }}</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="serviceBoxHeader">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <h4>Service</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="serviceDataPackage">
                        @if(!empty($deal->deal_services) && (count($deal->deal_services) > 0))
                            @foreach($deal->deal_services as $deal_service)
                                @if(!empty($deal_service->deal_sub_categories) && (count($deal_service->deal_sub_categories) > 0))
                                    @foreach($deal_service->deal_sub_categories as $deal_sub_category)
                                        <div class="row">

                                            <div class="col-md-12">
                                                <h5><img class="leaf" src="{{ asset('frontend/images/leaf.png') }}"
                                                         alt=""> {{ $deal_sub_category->sub_category->name ?? '-' }}
                                                </h5>
                                                @if(!empty($deal_sub_category->deal_sub_category_addons) && (count($deal_sub_category->deal_sub_category_addons) > 0))
                                                    <h6>Add on</h6>
                                                    <ul>

                                                        @foreach($deal_sub_category->deal_sub_category_addons as $deal_sub_category_addon)
                                                            <li>{{ $deal_sub_category_addon->addon->name ?? '-' }}</li>
                                                        @endforeach

                                                        @endif
                                                    </ul>
                                            </div>

                                        </div>
                                        <hr style="margin: 10px 0; border: #ff6c2b dotted 1px;">
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center serviceDetBtn">
                    <a href="{{ route('packages') }}" class="btn buttonMain hvr-bounce-to-right">Book Now</a>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
@endpush

