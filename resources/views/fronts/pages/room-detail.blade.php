@extends('layouts.front')
@section('content')
<link href="{{asset('front/css/datepicker.css')}}" rel="stylesheet">
    <div class="container-fluit">
        <h2 class="text-white title-page">
            <div class="container text-center">
                <b style="text-shadow:2px 3px 5px #fff;">Detail Room</b>
            </div>
        </h2>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-sm-6 portfolio-item">
                <img src="{{asset('uploads/rooms/'.$room->featured_image)}}" width="100%" alt=""></a>
                <p></p>
                <p class="text-gray">{{$room->short_description}}</p><hr>
                <p>{!!$room->description!!}</p>
            </div>
            <div class="col-md-6 col-md-6">
                <h4 class="text-info"><b>{{$room->name}}</b></h4><hr>
                <h5><b class="text-danger">USD {{$room->price}}</b></h5>

                <div class="card flat">
                    <div class="card-header">
                       <b> Form Booking Room</b>
                    </div>
                    <div class="card-body">

                        <p>
                            <label for="email"> Full Name <span class="text-danger">*</span> </label>
                            <input type="text" name="full_name" required placeholder="Enter your full name here..." class="form-control">
                        </p>
                        <p>
                            <label for="phone"> Phone Number <span class="text-danger">*</span> </label>
                            <input type="text" name="phone" required placeholder="Phone Number" class="form-control">
                        </p>
                        <p>
                        <label for="email"> Email </label>
                        <input type="email" name="email" placeholder="Email" class="form-control">
                        </p>
                        <p>
                        <p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="check_in"> Check In <span class="text-danger">*</span> </label>
                                <input type="text" name="check_in" placeholder="yyyy-mm-dd" id="check_in" required  class="form-control  datepicker-icon">
                            </div>
                            <div class="col-md-6">
                            <label for="check_out"> Check Out <span class="text-danger">*</span> </label>
                            <input type="text" name="check_out" placeholder="yyyy-mm-dd" id="check_out" required class="form-control  datepicker-icon">
                            </div>
                        </div>
                        </p>
                        <a href="#" class="btn flat btn-danger btn-block">Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .dropdown-menu {
        background: #fff;
    }
    .datepicker {
        min-width: 233px;
        max-width: 270px;
    }
    </style>
@endsection
@section('js')
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#check_in, #check_out").datepicker({
                orientation: 'bottom',
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
    });
</script>
@endsection