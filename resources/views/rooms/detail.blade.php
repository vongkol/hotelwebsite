@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Room Detail&nbsp;&nbsp;
                    <a href="{{url('/admin/room')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Title</aside>
                            <aside>{{$room->name}}</aside>
                        </label>
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Price ($)</aside>
                            <aside>{{$room->price}}</aside>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-12">
                            <aside class="text-primary">Short Description</aside>
                            <aside>{{$room->short_description}}</aside><br>
                        </label>
                        <div class="col-lg-6 col-sm-6">
                            <aside class="text-primary">Featured Image</aside>
                            <img src="{{asset('uploads/rooms/'.$room->featured_image)}}" width="200">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Description</p>
                            <p>{!!$room->description!!}</p>
                        </label>
                    </div>       
                </div>
            </div>
        </div>
    </div>
@endsection