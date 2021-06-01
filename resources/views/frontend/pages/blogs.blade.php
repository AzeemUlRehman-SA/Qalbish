@extends('frontend.layout.app')

@push('css')
    <style>
        .count-font-size {
            font-size: 18px;
            color: #0f0f0f;
            text-decoration: none;
        }

        #remove-row {
            text-align: center;
        }
    </style>
@endpush
@section('content')

    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Spec<span>ial</span> Offers</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 noPaddSm" id="load-data">
                    @if(!empty($blogs) && count($blogs) > 0)
                        @php
                            $blogId           = null;
                            $blog_category_id = null;
                        @endphp
                        @foreach($blogs as $blog)

                            @php
                                $blogId = $blog->id;
                                $blog_category_id = $blog->blog_category_id;
                            @endphp
                            <div class="col-md-6 col-sm-6 col-xs-12 blogPost">
                                <div class="thumbnail">
                                    <img src="{{asset('/uploads/blogs_images/thumbnails/'.$blog->image) }}" alt="">
                                    <div class="caption">
                                        <h6><i class="far fa-clock"></i> {{ $blog->created_at->format('F j, Y') }} <span>/ </span>
                                            {{ ucfirst($blog->blogCategory->name) }}
                                        </h6>
                                        <h3>{{ $blog->name }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit($blog->description,100) }}</p>
                                        <a href="{{ route('blog.show',$blog->slug) }}"
                                           class="btn buttonMain hvr-bounce-to-right">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <div class="clearfix"></div>
                        <div class="col-md-12" id="remove-row">
                            <button id="btn-more" data-id="{{ $blogId }}"
                                    data-blog-category-id="{{ $blog_category_id }}"
                                    class="btn buttonMain hvr-bounce-to-right">
                                Load
                                More
                            </button>
                        </div>
                    @else
                        <div id="remove-row">
                            <button class="btn buttonMain hvr-bounce-to-right">
                                No Record Found
                            </button>
                        </div>
                    @endif

                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="serviceBoxMain blogBoxMain">
                        <div class="serviceBoxHeader">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <h4>Categories</h4>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                                    <img src="{{ asset('frontend/images/cup.png') }}" alt="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="serviceBoxData">
                            <ul class="list-unstyled">

                                @if(!empty($categories))

                                    @foreach($categories as $category)

                                        <li><a href="{{ route('category.blogs',$category->slug) }}">
{{--                                                <img src="{{ asset('frontend/images/leaf.png') }}" alt=""> --}}
                                                {{ $category->name }}</a><span
                                                class="count-font-size">@if($category->blogs->count() > 0)
                                                    ( {{$category->blogs->count() }} )@endif </span>
                                        </li>

                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="serviceBoxMain">
                        <div class="serviceBoxHeader">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <h4>Recent Posts
                                        <ol></ol>
                                    </h4>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                                    <img src="{{ asset('frontend/images/cup.png') }}" alt="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="serviceBoxData">
                            @if(!empty($recent_blogs))
                                @foreach($recent_blogs as $recent_blog)
                                    <div class="row form-group">
                                        <a href="{{ route('blog.show',$recent_blog->slug) }}">
                                            <div class="col-md-3 col-sm-3 col-xs-3 recentBlogImg">
                                                <img src="{{asset('/uploads/blogs_images/'.$recent_blog->image) }}"
                                                     alt="">
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 recentBlogPost">
                                                <h3>{{ $recent_blog->name }}</h3>
                                                <h6>{{ $recent_blog->blogCategory->name }}</h6>
                                                <h6>
                                                    <i class="far fa-clock"></i>{{ $recent_blog->created_at->format('F j, Y') }}
                                                </h6>
                                            </div>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

    <script>
        $(document).ready(function () {
            $(document).on('click', '#btn-more', function () {
                var id = $(this).data('id');
                var blog_category_id = $(this).data('blog-category-id');
                $("#btn-more").html("Loading....");
                $.ajax({
                    url: '{{ route('blog.load.more') }}',
                    method: "POST",
                    data: {id: id, blog_category_id: blog_category_id, _token: "{{csrf_token()}}"},
                    dataType: "text",
                    success: function (data) {
                        if (data != '') {
                            $('#remove-row').remove();
                            $('#load-data').append(data);
                        } else {
                            $('#btn-more').remove();
                        }
                    }
                });
            });
        });
    </script>
@endpush
