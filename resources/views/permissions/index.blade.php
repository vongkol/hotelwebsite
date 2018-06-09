@extends('layouts.app')
@section('content')
    <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
    <?php include(app_path()."/lang/". $lang); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> {{$lb_permission_for}}{{$role->name}}
                </div>
                <div class="card-block">
                    {{csrf_field()}}
                    <table class="table table-condensed table-responsive">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>{{$lb_name}}</th>
                            <th>{{$lb_view}}</th>
                            <th>{{$lb_insert}}</th>
                            <th>{{$lb_update}}</th>
                            <th>{{$lb_delete}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($per_role as $per)
                            <tr role-id="{{$role_id}}" permission-id="{{$per->permission_id}}" id="{{$per->id==''?'0':$per->id}}">
                                <td>{{$i++}}</td>
                                <td>{{$per->name}}</td>
                                <td>
                                    <label class="switch switch-3d switch-primary">
                                        <input type='checkbox' value="{{$per->list?'1':'0'}}" {{$per->list==1?'checked':''}} onchange="save(this)" class="switch-input">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>

                                </td>
                                <td>
                                    <label class="switch switch-3d switch-primary">
                                        <input type='checkbox' value="{{$per->insert?'1':'0'}}" {{$per->insert==1?'checked':''}} onchange="save(this)" class="switch-input">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>

                                </td>
                                <td>
                                    <label class="switch switch-3d switch-primary">
                                        <input type='checkbox' value="{{$per->update?'1':'0'}}" {{$per->update==1?'checked':''}} onchange="save(this)" class="switch-input">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>

                                </td>
                                <td>
                                    <label class="switch switch-3d switch-primary">
                                        <input type='checkbox' value="{{$per->delete?'1':'0'}}" {{$per->delete==1?'checked':''}} onchange="save(this)" class="switch-input">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>

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
@section('js')
    <script src="{{asset('js/role_permission.js')}}"></script>
@endsection