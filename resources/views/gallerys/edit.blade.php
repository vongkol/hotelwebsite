@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Gallery&nbsp;&nbsp;
                    <a href="{{url('/admin/gallery')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    	action="{{url('/admin/gallery/update')}}" 
                    	class="form-horizontal" 
                    	method="post"
                    	enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$gallery->id}}">
                        <div class="form-group row">
                            <label for="title" class="control-label col-lg-2 col-sm-2">
                            	Title <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" value="{{$gallery->title}}" required>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-sm-2">Category</label>
                            <div class="col-lg-6 col-sm-8">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $c)
                                        <option value="{{$c->id}}" {{$c->id==$gallery->category_id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="control-label col-lg-2 col-sm-2">
                            	Order 
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" name="order" value="{{$gallery->order}}" id="order" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="featured_image" class="control-label required col-lg-2 col-sm-2">Image  <span class="text-danger">(960 x 620)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="loadFile(event)">
                                <p></p>
                                <p>
                                    <img src="{{URL::asset('uploads/gallerys/small/'.$gallery->featured_image)}}" width="150" id="img"/>
                                </p>
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