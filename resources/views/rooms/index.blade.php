@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Room List&nbsp;&nbsp;
                    <a href="{{url('/admin/room/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block" style="padding: 0;">
                    <table class="table tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Featured Image</th>
                                <th>Name</th>
                                <th>Price ($)</th>
                                <th>Short Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                    $pagex = 1;
                                $i = 18 * ($pagex - 1) + 1;
                                ?>
                            @foreach($rooms as $r)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <img src="{{asset('uploads/rooms/'.$r->featured_image)}}" alt="" width="110">
                                    </td>
                                    <td><a href="{{url('/admin/room/view/'.$r->id)}}" title="Edit">{{$r->name}}</a></td>
                                    <td>{{$r->price}}</td>
                                    <td>{{$r->short_description}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info"  href="{{url('/admin/room/edit/'.$r->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                       <a class="btn btn-xs btn-danger"  href="{{url('/admin/room/delete/'.$r->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection