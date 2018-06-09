@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9 col-sm-9">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Room&nbsp;&nbsp;
                    <a href="{{url('/admin/room')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    	action="{{url('/admin/room/save')}}" 
                    	class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"
                    >
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="name"> Name</label>
                                        <input type="text" required autofocus name="name" id="name" class="form-control" placeholder="Enter room name here">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="price"> Price <b class="text-danger">($)</b></label>
                                        <input type="number" step="0.1" required name="price" id="price" class="form-control" placeholder="$">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" rows="6" required class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <textarea name="description" id="description" rows="6" class="form-control ckeditor" style="width:100%;">
                                </textarea>
                            </div>
                        </div>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-lg-3">
           
            <div class="card">
                <div class="card-header">
                    Featured Image <span class="text-danger">(750x470)</span>
                </div>
                <div class="card-block">
                    <div style="margin-bottom: 3px;">
                        <input type="file" name="feature_image" id="feature_image" accept="image/*" class="form-control" onchange="loadFile(event)">
                    </div>
                    <div>
                        <img src="{{asset('uploads/default.png')}}" id="img" width="100%" alt="">
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <label for="short_description">Order</label>
                            <input type="number" name="order" class="form-control">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

</script> 
@endsection