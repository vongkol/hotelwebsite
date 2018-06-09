@extends('layouts.app')
@section('content')
    <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
    <?php include(app_path()."/lang/". $lang); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> {{$lb_user_list}}&nbsp;&nbsp;
                    <a href="{{url('/user/create')}}" class="btn btn-link btn-sm">{{$lb_new}}</a>
                </div>
                <div class="card-block">
                    <table class="table table-condensed table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>{{$lb_name}}</th>
                            <th>{{$lb_email}}</th>
                            <th>{{$lb_language}}</th>
                            <th>{{$lb_role}}</th>
                            <th>{{$lb_action}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->language=='kh'?'ខ្មែរ':'English'}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>
                                    <a href="{{url('/user/update-password/'.$user->id)}}" title="{{$lb_reset_password}}"><i class="fa fa-shield"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/edit/'.$user->id)}}" title="{{$lb_edit}}"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/delete/'.$user->id)}}" onclick="return confirm('{{$lb_confirm_delete}}')" title="{{$lb_delete}}"><i class="fa fa-remove text-danger"></i></a>
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