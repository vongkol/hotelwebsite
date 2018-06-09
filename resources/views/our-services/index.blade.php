@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Text Welcome List&nbsp;&nbsp;
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Title</th>
                                <th>Quote</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($our_services as $os)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$os->title}}</td>
                                    <td>{{$os->qoute}}</td>
                                    <td>{!!$os->description!!}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="{{url('/admin/text-welcome/edit/'.$os->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection