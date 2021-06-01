<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 modalLeft">
        <div class="imageHolder">
            <img src="{{ asset('/uploads/managing_parteners/'.$team->image) }}"
                 alt="{{$team->image}}" style="display: initial !important;width: 85%!important;">
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 modalRight">
        <h3>{{ $team->title }} </h3>
        <p>{{ $team->designation }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>{{ $team->description }}</h4>
    </div>
</div>
