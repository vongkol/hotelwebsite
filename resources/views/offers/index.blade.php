@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Offer List&nbsp;&nbsp;
                    <a href="{{url('/admin/offer/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block" style="padding: 0;">
                    <table class="table tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Featured Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Order</th>
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
                            @foreach($offers as $g)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <img src="{{asset('uploads/offers/'.$g->featured_image)}}" alt="" width="200">
                                    </td>
                                    <td>{{$g->title}}</td>
                                    <td>{!!$g->description!!}</td>
                                    <td>{{$g->order}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info"  href="{{url('/admin/offer/edit/'.$g->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                       <a class="btn btn-xs btn-danger"  href="{{url('/admin/offer/delete/'.$g->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection