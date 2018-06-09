@extends('layouts.front')
@section('content')
    <div class="container-fluit">
        <h2 class="text-white title-page">
            <div class="container text-center">
                <b style="text-shadow:2px 3px 5px #fff;">Our Rooms</b>
            </div>
        </h2>
    </div>
    <div class="container">
        <p>
            <b class="text-gray"> Find comfort and relaxation in our luxury Sen Han Hotel rooms in Phnom Penh</b> 
        </p>
        <p align="justify">
            Nourish your senses and enjoy the tranquil serenity at <b class="text-primary" style="font-size: 18px;">Sen Han Hotel</b>, 
            a well-appointed hotel where you can enjoy the best of this historical 
            city in Phnom Penh. When you need a break after exploring the city’s best-kept secrets,
            come back to the comfort of our Sen Han hotel rooms. Soothing colors combined with wood,
            glass and metal work result in interiors that are both stylish and functional.
        </p>
        <p align="justify">
            This tasteful Sen Han Hotel in Phnom Penh also features thoughtful amenities to cater 
            to your every need. Enjoy cable television to give you the latest entertainment,
            high-speed Internet to help you keep up with work, and a separate shower for a blissful bath. 
            You’ll always enjoy the best when you stay in one of our elegant Sen Han Hotel rooms.
       </p>
        <div class="row">
            @foreach($rooms as $r)
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card flat h-100">
                    <a href="{{url('room/detail/'.$r->id)}}">
                        <img class="r-img" src="{{asset('uploads/rooms/small/'.$r->featured_image)}}" width="100%" alt=""></a>
                        <div class="price">
                            USD {{$r->price}}
                        </div>
                        <div class="card-body">
                    <p class="card-title">
                        <a href="{{url('room/detail/'.$r->id)}}" class="a"><b class="text-gray name">{{$r->name}}</b></a>
                    </p>
                    <p class="text-gray">{{$r->short_description}}</p>
                    <a  class="btn btn-sm btn-primary flat" href="{{url('room/detail/'.$r->id)}}">BOOK NOW</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            {{$rooms->links()}}
        </div>
    </div>
@endsection