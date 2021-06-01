@php
    $aboutus =\App\Models\Aboutus::first();

@endphp
<section class="about">
    <div class="container">
        <div class="text-center">
            <div class="heading">
                <h2 class="sectionHeading">Ab<span>out</span> Us</h2>
                <p>{!! $aboutus->summary !!}</p>
                <a href="{{ route('aboutus.detail') }}" class="btn buttonMain hvr-bounce-to-right">View More</a>
            </div>
        </div>
    </div>
</section>
