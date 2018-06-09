@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Main Menu List&nbsp;&nbsp;
                    <a href="{{url('/sub-menu/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Parent</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($sub_menus as $m)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->url}}</td>
                                    <td>{{$m->parent}}</td>
                                    <td>{{$m->order_number}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="{{url('/sub-menu/edit/'.$m->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/sub-menu/delete/'.$m->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $sub_menus->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection