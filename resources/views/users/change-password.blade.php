@extends('layouts.app')
@section('content')
    <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
    <?php include(app_path()."/lang/". $lang); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> {{$lb_reset_password}}&nbsp;&nbsp;
                    <a href="{{url('/user')}}" class="btn btn-link btn-sm">{{$lb_back_to_list}}</a>
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
                    <form action="{{url('/user/save-password')}}" onsubmit="return confirm('{{$lb_confirm_update}}')"
                          class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <div class="form-group row">
                            <label for="new_password" class="control-label col-lg-2 col-sm-4">{{$lb_new_password}}</label>
                            <div class="col-lg-6 col-sm-7">
                                <input type="password" required  name="new_password" value="{{old('new_password')}}"
                                       id="new_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="control-label col-lg-2 col-sm-4">{{$lb_confirm_password}}</label>
                            <div class="col-lg-6 col-sm-7">
                                <input type="password" required  name="confirm_password" value="{{old('confirm_password')}}"
                                       id="confirm_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-4">&nbsp;</label>
                            <div class="col-lg-6 col-sm-7">
                                <button class="btn btn-primary" type="submit">{{$lb_save}}</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection