@extends('layouts.front')
@section('content')
    <div class="container-fluit">
        <h2 class="text-white title-page">
            <div class="container text-center">
                <b style="text-shadow:2px 3px 5px #fff;"> Offer</b>
            </div>
        </h2>
    </div>
    <div class="container">
        <p class="text-gray">
            There are many variations of passages of Lorem Ipsum available,
            but the majority have suffered alteration in some form,
            by injected humour, or randomised words which don’t look even slightly believable.
            If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t
            anything embarrassing hidden in the middle of text.
        </p>
        <div class="row">
            @foreach($offers as $r)
            <div class="col-lg-6 col-sm-6 portfolio-item">
                <div class="card flat h-100">
                    <a href="#">
                        <img class="r-img" src="{{asset('uploads/offers/'.$r->featured_image)}}" width="100%" alt=""></a>
                        <div class="card-body">
                    <h3 class="card-title">
                        <a href="#" class="a"><b class="text-danger name">{{$r->title}}</b></a>
                    </h3>
                    <p class="text-gray">{!!$r->description!!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            {{$offers->links()}}
        </div>
    </div>
@endsection