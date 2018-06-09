@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Portfolio List&nbsp;&nbsp;
                        <a href="{{url('/portfolio/create')}}" class="btn btn-link btn-sm">
                             New
                        </a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Order</th>
                                <th>Category</th>
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
                            @foreach($portfolios as $por)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{URL::asset('uploads/portfolios/small/'.$por->photo)}}" width="100"/></td>
                                    <td>{{$por->name}}</td>
                                    <td>{{$por->cname}}</td>
                                    <td>{{$por->order}}</td>
                                    <td>{{$por->cname}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{url('/portfolio/edit/'.$por->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a  class="btn btn-danger btn-xs"  href="{{url('/portfolio/delete/'.$por->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{$portfolios->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection