@extends('frontend.layout.app')

@push('css')


@endpush
@section('content')
    <section class="serviceInner aboutInnerPage membershipInner">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Memb<span>er</span>ship</h2>
                    <h3>{!! $membership_details->title !!}</h3>
                </div>
            </div>
            <div class="serviceInnerMain blogSingle">
                {!! $membership_details->description !!}
            </div>
        </div>
    </section>
    <section class="memberShip">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="membershipBox gold">
                        <img src="{{ asset('frontend/images/gold.png') }}" alt="">
                        <h4><strong>{!! $memberships[2]->title !!} Member</strong></h4>
                        {!! $memberships[2]->description !!}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="membershipBox silver">
                        <img src="{{ asset('frontend/images/silver.png') }}" alt="">
                        <h4><strong>{!! $memberships[1]->title !!} Member</strong></h4>
                        {!! $memberships[1]->description !!}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="membershipBox bronze">
                        <img src="{{ asset('frontend/images/bronze.png') }}" alt="">
                        <h4><strong>{!! $memberships[0]->title !!} Member</strong></h4>
                        {!! $memberships[0]->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush

