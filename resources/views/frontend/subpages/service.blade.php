@php
    $categories = \App\Models\Service::with('categories')->get();
@endphp
<section class="service">
    <div class="container-fluid">
        <div class="text-center">
            <div class="heading">
                <h2 class="sectionHeading">Se<span>rvi</span>ces</h2>
            </div>


            @if(auth()->check() && auth()->user()->user_type  == 'customer')

                @if(!empty($categories))
                    @foreach($categories as $category)

                        @if($category->id == auth()->user()->category_id)
                            <div class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                <a href="#" id="packages" onclick="getServiceName('packages')">
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
                            @if(!empty($category->categories))
                                @foreach($category->categories as $service)
{{--                                    @if($loop->iteration < 9)--}}
                                        <a href="#" onclick="getServiceName('{{$service->name}}')">
                                        <div
                                            class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                            <div class="serviceBox">
                                                <img
                                                    src="{{asset('/uploads/service_category/thumbnails/'.$service->thumbnail_image) }}"
                                                    alt="{{$service->thumbnail_image}}"
                                                    style="">
                                                <div class="serviceBoxDet">
                                                    <h3><strong>{{ $service->name }}</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
{{--                                    @else--}}
{{--                                        @break--}}
{{--                                    @endif--}}
                                @endforeach
                            @endif




                        @endif
                    @endforeach
                @endif
            @else
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
                    @if(!empty($categories))
                        @foreach($categories as $category)
                            <div id="{{ucfirst($category->name)}}"
                                 class="tab-pane fade in {{ ($category->name == 'women') ? 'active' : '' }}">
                                <div class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                    <a href="{{ route('package.show',$category->name) }}" id="packages">
                                        <div class="serviceBox">
                                            <img
                                                src="{{asset('/uploads/packages/thumbnails/8.png') }}"
                                                alt="1140x420_0004_05.jpg"
                                                style="">
                                            <div class="serviceBoxDet">
                                                <h3>PACKAGES</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @if(!empty($category->categories))
                                    @foreach($category->categories as $service)
{{--                                        @if($loop->iteration < 9)--}}
                                            <div
                                                class="col-md-3 col-sm-3 col-xs-6 mrgnDiv">
                                                <a href="{{ route('service.items', $service->slug) }}">
                                                    <div class="serviceBox">
                                                        <img
                                                            src="{{asset('/uploads/service_category/thumbnails/'.$service->thumbnail_image) }}"
                                                            alt="{{$service->thumbnail_image}}"
                                                            style="">
                                                        <div class="serviceBoxDet">
                                                            <h3>{{ $service->name }}</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
{{--                                        @else--}}
{{--                                            @break--}}
{{--                                        @endif--}}
                                    @endforeach
                                @endif


                                <div class="clearfix"></div>
{{--                                <div class="row serBtn col-md-12">--}}
{{--                                    <a href="{{ route('service') }}" class="btn buttonMain hvr-bounce-to-right">View--}}
{{--                                        All</a>--}}
{{--                                </div>--}}
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif

        </div>
    </div>
</section>
@push('js')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        function getServiceName(name){
           $.ajax({
                url: "{{ route('getservicesname') }}",
               type: 'POST',
               data : { name: name},
               success: function(response){
                    if(response.status == 'success'){
                        window.location.href = "{{route('service')}}";
                    }else{
                        toastr['error']("Something went wrong.");
                    }
               },
               error: function(error){
                   toastr['error']("Something went wrong.");
               }

            });
        }
</script>
@endpush

