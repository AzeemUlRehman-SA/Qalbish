@extends('frontend.layout.app')
@section('title',$service_detail->meta_title ?? 'Services')
@section('description',$service_detail->meta_description ?? 'Services')
@section('keywords',$service_detail->keywords ?? 'Services')

@push('css')
@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
{{--                    <h2 class="sectionHeading">Ser<span>vi</span>ces</h2>--}}
                    <h2 class="sectionHeading">{{ $service_detail->name }}</h2>
{{--                    <h3>{{ $service_detail->name }}</h3>--}}

                </div>
            </div>
            <div class="serviceInnerMain">
                <img src="{{ asset('/uploads/service_category/'.$service_detail->image) }}" alt="">
                <p>{{ $service_detail->description }}</p>
                @if(count($service_detail->sub_categories) > 0)
                    <div class="serviceBoxMain">
                        <div class="serviceBoxHeader">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                <h4>Services</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>Price</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="serviceData">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                @foreach($service_detail->sub_categories as $key=>$sub_category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading {{ ($key == 0) ? 'active' :'' }}" role="tab"
                                             id="heading{{$sub_category->id}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{ $sub_category->id }}" aria-expanded="true"
                                                   aria-controls="collapse{{$sub_category->id}}">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
{{--                                                        <img src="{{ asset('frontend/images/leaf.png') }}"--}}
{{--                                                             alt=""> --}}
                                                        {{ $sub_category->name }}
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4 priceRight">
                                                        @if($service_detail->discount_type === 'fixed' )
                                                            Rs. {{ $sub_category->price - $service_detail->discount_price }}
                                                        @elseif($service_detail->discount_type === 'percentage')
                                                            Rs. {{ $sub_category->price * (1- ($service_detail->discount_price / 100)) }}
                                                        @elseif($sub_category->discount_type === 'fixed' )
                                                            Rs. {{ $sub_category->price - $sub_category->discount_price }}
                                                        @elseif($sub_category->discount_type === 'percentage')
                                                            Rs. {{ $sub_category->price * (1- ($sub_category->discount_price / 100)) }}
                                                        @else
                                                            Rs. {{ $sub_category->price }}
                                                        @endif

                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$sub_category->id}}"
                                             class="panel-collapse collapse  {{ ($key == 0) ? 'in' :'' }}"
                                             role="tabpanel"
                                             aria-labelledby="heading{{$sub_category->id}}">
                                            <div class="panel-body">
                                                <p>{{ $sub_category->description }}</p>
                                                @if(count($sub_category->addons) > 0)
                                                    <h5>Add On</h5>
                                                    <ul>
                                                        @foreach($sub_category->addons as $addons)
                                                            <li>{{ $addons->name }}
                                                                <span>Rs .{{  $addons->price}}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-right serviceDetBtn">
                                                        @if(auth()->check() && auth()->user()->user_type  == 'customer')
                                                            <a href="{{ route('service') }}"
                                                               class="btn buttonMain hvr-bounce-to-right">Book Now</a>
                                                        @else
                                                            <a href="{{ route('login') }}"
                                                               class="btn buttonMain hvr-bounce-to-right">Book Now</a>
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
