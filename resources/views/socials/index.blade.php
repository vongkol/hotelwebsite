@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Social List&nbsp;&nbsp;
                    <a href="{{url('/social/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Order &numero;</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($socials as $soc)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{URL::asset('uploads/socials/'.$soc->icon)}}" width="40"/></td>
                                    <td>{{$soc->name}}</td>
                                    <td>{{$soc->url}}</td> 
                                    <td>{{$soc->order_number}}</td>
                                    <td>
                                        <a href="{{url('/social/edit/'.$soc->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('/social/delete/'.$soc->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $socials->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection