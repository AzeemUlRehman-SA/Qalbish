@extends('frontend.layout.app')
@section('title','Privacy Policy')
@section('description','We are the first luxury spa in Pakistan to offer Certified Ayurvedic treatments for the mind, body and soul in the comfort and privacy of your own home. Indulge yourself in a range of luxury spa services for all your beauty, wellness and therapeutic needs; our services are supplemented with a wide range of premium as well as Ayurvedic (chemical free) products. Book your appointment now through our website, app, and whatsapp or by phone.')
@section('keywords', 'Qalbish')
@push('css')
@endpush
@section('content')
    <section class="serviceInner aboutInnerPage">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Pri<span>vacy </span>Policy</h2>
                </div>
            </div>
            <div class="serviceInnerMain blogSingle">
                {!! ($privacyPolicy) ? $privacyPolicy->description : '' !!}

            </div>
        </div>
    </section>


@endsection



