@extends('layouts.front')
@section('content')
    <?php 
        $slides = DB::table('slides')->where('active',1)->orderBy('order','asc')->get(); 
        $i = 1; 
        $c = 0;
    ?>
    <div class="container-fluit">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                @foreach($slides as $sl)
                    @if($c == 0)
                        <li data-target="#demo" data-slide-to="{{$c}}" class="active"></li>
                    @else 
                        <li data-target="#demo" data-slide-to="{{$c}}"></li>
                    @endif  
                    <?php $c++; ?>
                @endforeach
            </ul>
            <div class="carousel-inner">
                @foreach($slides as $slide)
                @if($i++ == 1)
                    <div class="carousel-item active">
                        <img src="{{asset('front/slides/'.$slide->photo)}}" alt="" width="100%">
                        <div class="carousel-caption carousel-caption-c hidden-sm-down">
                            <div class="col-md-6 btn-slide">
                                <p><b class="txt-slide">{{$slide->name}}</b></p>
                                <a href="{{$slide->url}}" class="btn btn-info btn-cicle">Read More</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{asset('front/slides/'.$slide->photo)}}" alt="" width="100%">
                        <div class="carousel-caption carousel-caption-c hidden-sm-down">
                            <div class="col-md-6 btn-slide">
                                <p><b class="txt-slide">{{$slide->name}}</b></p>
                                <a href="{{$slide->url}}" class="btn btn-info btn-cicle">Read More</a>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
       
    <div class="container-fluit">
        <h1 class="txt-wel text-gray" align="center">{{$our_service->title}}</h1>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 text-center text-gray">
                    <div class="container">
                        <aside class="text-os">{{$our_service->qoute}}</aside>
                        <p>{!!$our_service->description!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- portfolio-section -->
    <div class="space-medium">
        <div class="container-fluit portfolio">
             <div class="container">
              <ul class="nav justify-content-center" id="pills-tab" role="tablist">
              <?php $p= 1; ?>
                  @foreach($portfolio_categories as $por_cat)
                  @if($p == 1)
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-{{$por_cat->name}}-tab" data-toggle="pill" href="#pills-{{$por_cat->name}}" role="tab" aria-controls="pills-{{$por_cat->name}}" aria-selected="true"> {{$por_cat->name}}</a>
                  </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" id="pills-{{$por_cat->name}}-tab" data-toggle="pill" href="#pills-{{$por_cat->name}}" role="tab" aria-controls="pills-{{$por_cat->name}}" aria-selected="false">{{$por_cat->name}}</a>
                  </li>
                  @endif
                  <?php $p++; ?>
                    @endforeach
                </ul>
                </div>
            </div>
                <div class="tab-content" id="pills-tabContent">
                <?php $p2 = 1; ?>
                @foreach($portfolio_categories as $pc)
                <?php $portfolios= DB::table('portfolios')
                    ->where('active',1)
                    ->orderBy('order', 'asc')
                    ->where('category_id',  $pc->id)
                    ->limit(8)
                    ->get();
                ?>
                @if($p2++ == 1)
                  <div class="tab-pane fade show active" id="pills-{{$pc->name}}" role="tabpanel" aria-labelledby="pills-{{$pc->name}}-tab">
                  <div class="col-md-12">
                  <div class="row">
                        @foreach($portfolios as $hp)
                        <div class="col-lg-3 col-md-3 col-sm-6  pd-0">
                            <div class="gallery-img"><a href="{{asset('uploads/portfolios/'.$hp->photo)}}" class="image-link" title="{{$hp->name}}"><img src="{{asset('uploads/portfolios/small/'.$hp->photo)}}"  width="100%" alt=""></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
                  </div>  
                  @else 
                  <div class="tab-pane fade show" id="pills-{{$pc->name}}" role="tabpanel" aria-labelledby="pills-{{$pc->name}}-tab">
                  <div class="col-md-12">  
                    <div class="row">
                            @foreach($portfolios as $hp)
                            <div class="col-lg-3 col-md-3 col-sm-6  pd-0">
                                <div class="gallery-img"><a href="{{asset('uploads/portfolios/'.$hp->photo)}}" class="image-link" title="{{$hp->name}}"><img src="{{asset('uploads/portfolios/small/'.$hp->photo)}}"  width="100%" alt=""></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                  </div>
                @endif
                @endforeach
                </div>
                </div>
              </div>
             </div>
            <p></p>
            <div class="container">
                <h1 class="txt-wel2 text-center text-gray">OUR ROOMS</h1>
                <div class="row">
                    @foreach($rooms as $r)
                    <div class="col-lg-4 col-sm-6 portfolio-item">
                        <div class="card flat h-100">
                            <a href="#">
                                <img class="r-img" src="{{asset('uploads/rooms/small/'.$r->featured_image)}}" width="100%" alt=""></a>
                                <div class="price">
                                    USD {{$r->price}}
                                </div>
                                <div class="card-body">
                            <p class="card-title">
                                <a href="#" class="a"><b class="text-gray name">{{$r->name}}</b></a>
                            </p>
                            <p class="text-gray">{{$r->short_description}}</p>
                            <a  class="btn btn-sm btn-primary flat" href="#">BOOK NOW</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="container-fluit">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="txt-wel2 text-gray"> HOTEL'S LOCATION</p>
                        </div>
                    </div>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.6812727785455!2d104.89004131426223!3d11.574691247117576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095176283deb65%3A0x94f74c01df5e9248!2sSen+Han+Hotel!5e0!3m2!1sen!2skh!4v1527682998914" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
@endsection