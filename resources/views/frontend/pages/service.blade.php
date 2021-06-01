@extends('frontend.layout.app')

@push('css')
    <style>
        .serviceBox img {
            min-height: 262px;
            object-fit: cover;
        }
    </style>
@endpush
@section('content')
    <section class="service">
        <div class="container-fluid">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Se<span>rvi</span>ces</h2>
                </div>
                <ul class="nav nav-tabs">
                    @foreach($categories as $category)
                        <li class="{{ ($category->name == 'women') ? 'active' : '' }}"><a data-toggle="tab"
                                                                                          href="#{{ ucfirst($category->name) }}"
                                                                                          class="btn buttonMain hvr-bounce-to-right">
                                {{--                                <i class="{{ ($category->name == 'women') ? 'fas fa-female' : 'fas fa-male' }}"></i>--}}
                                {{  ucfirst($category->name) }}
                            </a></li>
                    @endforeach

                </ul>

                <div class="tab-content">
                    @foreach($categories as $category)
                        <div id="{{ucfirst($category->name)}}"
                             class="tab-pane fade in {{ ($category->name == 'women') ? 'active' : '' }}">
                            <div class="row ">
                                <div class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                    <a href="{{ route('package.show',$category->name) }}" id="packages">
                                        <div class="serviceBox">
                                            <img
                                                src="{{asset('/uploads/packages/thumbnails/8.png') }}"
                                                alt="1140x420_0004_05.jpg"
                                                style="">
                                            <div class="serviceBoxDet">
                                                <h3><strong>PACKAGES</strong></h3>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @foreach($category->categories as $service)
                                    <div
                                            class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                        <a href="{{ route('service.items', $service->slug) }}">
                                            <div class="serviceBox">

                                                <img
                                                        src="{{asset('/uploads/service_category/thumbnails/'.$service->thumbnail_image) }}"
                                                        alt="{{$service->thumbnail_image}}">
                                                <div class="serviceBoxDet">
                                                    <h3><strong>{{ $service->name }}</strong></h3>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                                    <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

