@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Slide&nbsp;&nbsp;
                    <a href="{{url('/slide')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    	action="{{url('/slide/update')}}" 
                    	class="form-horizontal" 
                    	method="post"
                    	enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$slide->id}}">
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-2 col-sm-2">
                            	Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                        
                                    <textarea name="name" id="name" class="form-control" rows="3" required="required">{{$slide->name}}</textarea>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                                <img src="{{URL::asset('front/slides/').'/'.$slide->photo}}" width="150" id="img"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-2 col-sm-2">
                            	URL 
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" value="{{$slide->url}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="control-label col-lg-2 col-sm-2">
                            	Order 
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" name="order" value="{{$slide->order}}" id="order" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label required col-lg-2 col-sm-2">Image  <span class="text-danger">(1280 x 550)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                            </div>

                        </div>   
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
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
        output.width = 150;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection