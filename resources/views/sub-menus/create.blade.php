@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Main Menu&nbsp;&nbsp;
                    <a href="{{url('/sub-menu')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    	action="{{url('/sub-menu/save')}}" 
                    	class="form-horizontal" 
                    	method="post"
                    >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-1 col-sm-2">
                            	Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" required autofocus name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <?php $mainmenus = DB::table('main_menus')->orderBy('name', 'asc')->where('active',1)->get();?>
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-1 col-sm-2">
                            	Parent <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                            <select name="parent" id="parent" class="form-control">
                                @foreach($mainmenus as $m)
                                    <option value="{{$m->id}}">{{$m->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-1 col-sm-2">
                                URL
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="control-label col-lg-1 col-sm-2">
                                Order
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" name="order_number" id="order_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection