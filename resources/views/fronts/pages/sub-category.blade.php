@extends('layouts.front')
@section('content')
<style>
.ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #fff;
}

.li .a2 {
    display: block;
    color: #000;
    padding: 8px 16px;
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px solid #ccc;
}

.li .a2.active {
    background-color: #f7ba03;
    color: white;
}

.li .a2:hover:not(.active) {
    background-color: #f7ba03;
    color: white;
}
</style>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <h3 class="text-warning"><i class="far fa-newspaper news-icon"></i> {{$main->name}}</h3>
                <ul class="ul">
                    <li class="li"><a class="a2" href="{{url('/category/'.$main->id)}}">All</a></li>
                    @foreach($subs as $s)
                        <li class="li"><a class="a2" href="{{url('/sub-category/'.$main->id.'?sub='.$s->id)}}">{{$s->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    @foreach($posts as $p)
                        <div class="col-sm-4">
                            <p>
                                <a href="{{url('/post/'.$main->id .'?pid='.$p->id)}}">
                                    <img src="{{asset('uploads/posts/250x250/'.$p->featured_image)}}" alt="" width="99%">
                                </a>
                            </p>
                            <p>
                               <strong>
                                    <a  class="a text-dark-gray" href="{{url('/post/'.$main->id.'?pid='.$p->id)}}">{{$p->title}}</a>
                                </strong> 
                            </p>
                            <p>
                                <a  class="a text-dark-gray" href="{{url('/post/'.$main->id.'?pid='.$p->id)}}">{{$p->short_description}}</a>
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection