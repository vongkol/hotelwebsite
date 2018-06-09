@extends('layouts.front')
@section('content')
    <div class="container-fluit">
        <h2 class="text-white title-page">
            <div class="container text-center">
                <b style="text-shadow:2px 3px 5px #fff;"> Gallery</b>
            </div>
        </h2>
    </div>
    <div class="container">
        <div class="tab-content" id="pills-tabContent">
            <?php $p2 = 1; ?>
            @foreach($categories as $c)
            <?php $gallerys= DB::table('gallerys')
                ->where('active',1)
                ->orderBy('order', 'asc')
                ->where('category_id',  $c->id)
                ->get();
            ?>
            <h4 class="text-gray text-center">
                <hr>
                <i class="fa fa-camera-retro" aria-hidden="true"></i> <b>{{$c->name}}</b>
                <hr>
            </h4>
            <div class="col-md-12">
                <div class="row">
                    @foreach($gallerys as $g)
                    <div class="col-lg-3 col-md-3 col-sm-6 pd-5" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="gallery-img"><a href="{{asset('uploads/gallerys/'.$g->featured_image)}}" class="image-link" title="{{$g->title}}"><img src="{{asset('uploads/gallerys/small/'.$g->featured_image)}}"  width="100%" alt=""></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <br>
    </div>
@endsection