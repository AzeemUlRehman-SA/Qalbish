@extends('frontend.layout.app')
@push('css')
@endpush
@section('content')
    <section class="serviceInner aboutInnerPage">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Ab<span>out </span>Us</h2>
                </div>
            </div>
            <div class="serviceInnerMain blogSingle">
                {!! ($aboutus) ? $aboutus->description : '' !!}
            </div>
        </div>
    </section>
    <section class="aboutCenter">
        <div class="container">
            <div class="row text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Managin<span>g P</span>artners</h2>
                </div>
                <div class="owl-carousel" id="membersCarousel">
                    @if(!empty($teams))
                        @foreach($teams as $team)
                            <div class="item">
                                <a href="javascript:">
                                    <div class="col-md-12 col-sm-12 col-xs-12 team-member"
                                         data-action="{{ $team->id }}">
                                        <div class="imageHolder">
                                            <img src="{{ asset('/uploads/managing_parteners/'.$team->image) }}"
                                                 alt="{{$team->image}}" style="display: initial !important;width: 85%; !important;">
                                        </div>
                                        <h3>{{ $team->title }} </h3>
                                        <p>{{ $team->designation }} </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    @endif
                </div>

            </div>
        </div>
    </section>
    @include('frontend.subpages.testimonials')
@endsection
@push('models')
    <div id="memberModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><img
                            src="{{ asset('frontend/images/close.png') }}" alt="">
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>

        </div>
    </div>
@endpush
@push('js')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).on('click', '.imageHolder', function () {
            var $e = $(this);
            var url = '/get/team/' + $e.parents('.team-member').data('action');
            axios.get(url).then(function (r) {
                if (r.data != '') {
                    $('#memberModal .modal-body').html(r.data);
                    $('#memberModal').modal('show');
                }

            }).catch(function (r) {
            })
        });
    </script>
@endpush

