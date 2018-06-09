<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Website Hotel">
        <meta name="author" content="vdoo.biz">
        <meta name="keyword" content="hotel, website hotel, booking room, cambodia hotel, sen han">
        <title>Sen Han Hotel</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('front/css/web-fonts-with-css/css/fontawesome-all.css')}}" rel="stylesheet">
        <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->        
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/magnific-popup.css')}}">
        <link href="{{asset('front/css/4-col-portfolio.css')}}" rel="stylesheet">
    </head>
    <body>

    <div class="container-fluit header-contact">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand navbar-brand-c col-md-3 col-3" href="{{url('/')}}"><img src="{{asset('front/img/logo.png')}}" width="100"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav">
                        <?php 
                            $menus = DB::table('main_menus')->where('active',1)->orderBy('order_number')->get();
                        ?>
                        @foreach($menus as $m)
                        <?php $subs = DB::table('sub_menus')
                            ->where('active',1)
                            ->where('parent_id', $m->id)
                            ->orderBy('order_number')
                            ->get();
                        ?>
                        @if(count($subs)<=0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{url($m->url)}}">{{$m->name}}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown dropdown-menu-c">
                                <a class="nav-link dropdown-toggle smenu" href="#" data-toggle="dropdown">
                                    {{$m->name}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-c">
                                    @foreach($subs as $s)
                                        <a class="dropdown-item dropdown-item-c" href="{{url($s->url)}}">{{$s->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                        </ul>
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a  href="#"><img src="{{asset('front/img/en.png')}}" alt="" width="35"></a>&nbsp;   
                            <a href="#"><img src="{{asset('front/img/cn.png')}}" alt=""  width="35"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('content')
    <footer class="py-5 footer">
      <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="logo-footer">
                    <img src="{{asset('front/img/logo.png')}}" width="80">
                </div>
                <p></p>
                <aside class="text-gray">
                    <i class="fas fa-map-marker"></i>&nbsp; #98, St. 600 coner St. 313, Sangkat Boueng Kok II,
                        Khan Toul Kok, Phnom Penh.
                </aside>
                <aside class="text-gray">
                    <i class="fas fa-envelope"></i>&nbsp; booking@senhanhotel.com <br>
                    <i class="fas fa-envelope"></i>&nbsp; info@senhanhotel.com
                </aside>
                <aside class="text-gray">
                    <i class="fa fa-phone"></i>&nbsp; (+855) 23 988 896 <br>
                    <i class="fa fa-phone"></i>&nbsp; (+855) 23 988 895
                </aside><br>  
            </div>
             <div class="col-md-3">
                <h6>Menu</h6>
                <div class="footer-page">
                    @foreach($menus as $m)
                    <aside class="text-gray">
                        <a href="{{$m->url}}" class="a text-gray">{{$m->name}}</a>
                    </aside>
                    @endforeach
                </div>
            </div>
            <?php 
                $socials = DB::table('socials')
                    ->where('active', 1)
                    ->select('icon','url')
                    ->orderBy('order_number', 'asc')
                    ->get();
            ?>
                <div class="col-md-4">
                    <h6>Follow Us On</h6>
                    <div class="footer-page">
                        @foreach($socials as $so)
                        <a href="{{$so->url}}" class="a" style="padding:2px;" target="_blank">
                            <img src="{{asset('uploads/socials/'.$so->icon)}}" width="40">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>
        <script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('front/vendor/jquery/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('front/vendor/jquery/popup-gallery.js')}}" type="text/javascript"></script>
        @yield('js')
    </body>
</html>