    @extends('layouts.app')
    @section('content')
        <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
        <?php include(app_path()."/lang/". $lang); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-bold">
                        <i class="fa fa-align-justify"></i> {{$lb_new_role}}&nbsp;&nbsp;
                        <a href="{{url('/role')}}" class="btn btn-link btn-sm">{{$lb_back_to_list}}</a>
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

                        <form action="{{url('/role/save')}}" class="form-horizontal" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="name" class="control-label col-lg-1 col-sm-2">{{$lb_name}}</label>
                                <div class="col-lg-6 col-sm-8">
                                    <input type="text" required autofocus name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                                <div class="col-lg-6 col-sm-8">
                                    <button class="btn btn-primary" type="submit">{{$lb_save}}</button>
                                    <button class="btn btn-danger" type="reset">{{$lb_cancel}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
    @endsection