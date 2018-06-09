@extends('layouts.app')
@section('content')
    <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
    <?php include(app_path()."/lang/". $lang); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> {{$lb_role_list}}&nbsp;&nbsp;
                    <a href="{{url('/role/create')}}" class="btn btn-link btn-sm">{{$lb_new}}</a>
                </div>
                <div class="card-block">

                    <table class="table table-condensed table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>{{$lb_name}}</th>
                                <th>{{$lb_action}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{url('/role/permission/'.$role->id)}}" title="{{$lb_set_permission}}"><i class="fa fa-key"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/role/edit/'.$role->id)}}" title="{{$lb_edit}}"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/role/delete/'.$role->id)}}" onclick="return confirm('{{$lb_confirm_delete}}')" title="{{$lb_delete}}"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection