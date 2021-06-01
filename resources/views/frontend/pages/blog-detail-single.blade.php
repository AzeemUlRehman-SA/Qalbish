@extends('frontend.layout.app')
@section('title',$blog->meta_title ?? 'Special Offers')
@section('description',$blog->meta_description ?? 'Special Offers')
@section('keywords',$blog->keywords ?? 'Special Offers')
@push('css')
@endpush
@section('content')
    <section class="serviceInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Spec<span>ial</span> Offers</h2>
                </div>
            </div>
            <div class="serviceInnerMain blogSingle">
                <img src="{{ asset('/uploads/blogs_images/'.$blog->image) }}" alt="">
                <h3>{{ $blog->name }}</h3>
                <h6><i class="far fa-clock"></i> {{ $blog->created_at->format('F j, Y') }} <span>/ </span>
                    {{ ucfirst($blog->blogCategory->name) }}</h6>
                <p>{{$blog->description }}</p>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
