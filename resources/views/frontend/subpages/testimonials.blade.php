@php
    $testimonials =\App\Models\Testimonial::all();
@endphp
<section class="testimonials">
    <div class="container">
        <div class="text-center">
            <div class="heading">
                <h2 class="sectionHeading">Testi<span>mo</span>nials</h2>
            </div>
            <div class="owl-carousel" id="testimonails">
                @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="testimonialMain">
                            <div class="testimonialInner">
                                <h3>{{ $testimonial->title }}</h3>
                                <p>
                                    <span><i
                                            class="fas fa-quote-left"></i></span>{{\Illuminate\Support\Str::limit($testimonial->description,300)}}
                                    <span><i
                                            class="fas fa-quote-right"></i></span></p>
                                <div class="imageHolder">
                                    <img src="{{asset('/uploads/testimonials/'.$testimonial->image) }}" alt="" style="display: initial !important;width: 85% !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
