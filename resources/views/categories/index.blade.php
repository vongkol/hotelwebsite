@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Category List&nbsp;&nbsp;
                    <a href="{{url('/admin/category/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($categories as $cat)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->order}}</td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{url('/admin/category/edit/'.$cat->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{url('/admin/category/delete/'.$cat->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection