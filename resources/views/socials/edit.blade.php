@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Social&nbsp;&nbsp;
                    <a href="{{url('/social')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif

                    <form 
                    	action="{{url('/social/update')}}" 
                    	class="form-horizontal" 
                    	method="post"
                    	enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$social->id}}">
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-1 col-sm-2">
                            	Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" 
                                    required 
                                    autofocus 
                                    name="name" 
                                    id="name" 
                                    class="form-control"
                                    value="{{$social->name}}" 
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-1 col-sm-2">URL</label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    name="url" 
                                    id="url" 
                                    class="form-control"
                                    value="{{$social->url}}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order_number" class="control-label col-lg-1 col-sm-2">Order &numero;</label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="number" 
                                    name="order_number" 
                                    id="order_number" 
                                    class="form-control"
                                    value="{{$social->order_number}}" 
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="control-label col-lg-1 col-sm-2">Icon <span class="text-danger">(40x40)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="icon" id="icon" accept="image/*" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="control-label col-lg-1 col-sm-2"></label>
                            <div class="col-lg-6 col-sm-8">
                                <img src="{{asset('uploads/socials/'.$social->icon)}}" width="40" id="img"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.width = 40;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection