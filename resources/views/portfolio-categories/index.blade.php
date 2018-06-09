@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Portfolio Category List&nbsp;&nbsp;
                    <a href="{{url('/portfolio-category/create')}}" class="btn btn-link btn-sm">New</a>
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
                            <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                $pagex = 1;
                                $i = 18 * ($pagex - 1) + 1;
                            ?>
                            @foreach($portfolio_categories as $cat)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->order_number}}</td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{url('/portfolio-category/edit/'.$cat->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a  class="btn btn-danger btn-xs"  href="{{url('/portfolio-category/delete/'.$cat->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{$portfolio_categories->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection