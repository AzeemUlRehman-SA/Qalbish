@php
    $latest_blog =\App\Models\Blog::orderBy('id','DESC')->first();
    $user = \App\Models\User::where('id','1')->first();

@endphp

<section class="blog">
    <div class="container">
        <div class="text-center">
            <div class="heading">
                <h2 class="sectionHeading">Spec<span>ial</span> Offers</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 blogImage">
                <img src="{{asset('/uploads/blogs_images/'.$latest_blog->image) }}" alt="">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 blogText">
                <h4>{{ $latest_blog->name }}</h4>
                <h6><i class="far fa-clock"></i> {{ $latest_blog->created_at->format('F j, Y') }} <span>/</span>
                    {{ ucfirst($latest_blog->blogCategory->name) }}
                </h6>
                <p> {{ \Illuminate\Support\Str::limit($latest_blog->description,1300) }}</p>
                <a href="{{ route('blog.show',$latest_blog->slug) }}">Read More</a>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('blog') }}" class="btn buttonMain hvr-bounce-to-right">View All</a>
        </div>
    </div>
</section>
